<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Role;
use App\School;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use App\Atlas;
use App\AtlasUser;
use DB;

class UsersController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::all()->pluck('title', 'id');

        return view('admin.users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $user = User::create($request->all());
            $user->roles()->sync($request->input('roles'));
            $user->toArray();

            if ($request->roles == 3) {
                $request->validate([
                    "zone" => "required",
                ]);

                $data=[
                    "user_id" => $user->id,
                    "atlas_id" => $request->zone,
                ];

                $zonee = AtlasUser::insert($data);

            }

            if ($request->roles == 4) {
                $request->validate([
                    "lga" => "required",
                ]);

                $data=[
                    "user_id" => $user->id,
                    "atlas_id" => $request->lga,
                ];
                
                $lgaa = AtlasUser::insert($data);

            }

            if ($request->roles == 5 || $request->roles == 6) {
                $request->validate([
                    "school" => "required",
                ]);

                if ($request->school == 0) {
                    session()->flash('error', 'The school field is required');
                    return redirect()->back();
                }

                $users = User::where('school_id', $request->school)->get();
                // dd($users);
                if (!$users->isEmpty()) {
                    session()->flash('error', 'User already exists for this school');
                    return redirect()->back();
                }


                $user->school_id = $request->school;
                $user->update();

            }

            DB::commit();
        } catch (Exception $e) {
            // dd($e);
            session()->flash('error', 'Something went wrong. Contact Administrator');
            return redirect()->back();
        }

        if ($request->input('profile_img', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . $request->input('profile_img')))->toMediaCollection('profile_img');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $user->id]);
        }

        session()->flash('message', 'User added successfully');
        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::all()->pluck('title', 'id');

        $user->load('roles');

        return view('admin.users.edit', compact('roles', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));

        if ($request->input('profile_img', false)) {
            if (!$user->profile_img || $request->input('profile_img') !== $user->profile_img->file_name) {
                $user->addMedia(storage_path('tmp/uploads/' . $request->input('profile_img')))->toMediaCollection('profile_img');
            }
        } elseif ($user->profile_img) {
            $user->profile_img->delete();
        }

        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles', 'school', 'assignedToTasks', 'assignedToAssets', 'assignedUserAssetsHistories');

        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('user_create') && Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new User();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media', 'public');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function user()
    {
        $users = User::all();
        $schools = School::all();
        return view('admin.users.user', compact('users', 'schools'));
    }

    public function storeUser(Request $request)
    {
        $user = User::find($request->user_id);
        $user->schools()->attach($request->input('schools', []));

        return("success");
    }
}
