<?php

namespace App\Http\Controllers\Admin;

use App\Asset;
use App\Atlas;
use App\AssetCategory;
use App\AssetStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAssetRequest;
use App\Http\Requests\StoreAssetRequest;
use App\Http\Requests\UpdateAssetRequest;
use App\User;
use App\Term;
use App\SchoolAtlas;
use App\School;
use App\Session;
use App\AtlasLink;
use Gate;
use App\Staff;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Auth;

class AssetController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('asset_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {

            $query = Asset::where('school_id', $request->school)->select(sprintf('%s.*', (new Asset)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'asset_show';
                $editGate      = 'asset_edit';
                $deleteGate    = 'asset_delete';
                $crudRoutePart = 'assets';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('serial_number', function ($row) {
                return $row->serial_number ? $row->serial_number : "";
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('notes', function ($row) {
                return $row->notes ? $row->notes : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
            
        }
        
        return view('admin.assets.index');
    }

    public function notAdmin(Request $request)
    {
        $school_id = Auth::User()->school_id;
        if ($request->ajax()) {
            $query = Asset::where('school_id', $school_id)->select(sprintf('%s.*', (new Asset)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'asset_show';
                $editGate      = 'asset_edit';
                $deleteGate    = 'asset_delete';
                $crudRoutePart = 'assets';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('serial_number', function ($row) {
                return $row->serial_number ? $row->serial_number : "";
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('notes', function ($row) {
                return $row->notes ? $row->notes : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
            
        }
    }

    public function create()
    {
        abort_if(Gate::denies('asset_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = AssetCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = AssetStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        if (Auth::User()->is_headTeacher) {
            $assigned_tos = Staff::where('school_id', Auth::User()->school_id)->get();
        } else {
            $assigned_tos = null;
        }

        return view('admin.assets.create', compact('categories', 'statuses', 'assigned_tos'));
    }

    public function store(StoreAssetRequest $request)
    {
        //$asset = Asset::create($request->all());

        if (!Auth::User()->is_headTeacher) {
            $school = $request->school;
        } else {
            $school = Auth::User()->school_id;
        }

        $term_id = Term::where('active_status', 1)->select('id')->get();
        $session_id = Session::where('active_status', 1)->select('id')->get();

        $data_id = Asset::where('school_id', $school)->max('id') + 1;
        // dd($data_id);
        if ($data_id == 1) {
            $model_id = str_pad($school, 15, "0", STR_PAD_RIGHT).$data_id;
        } else {
            $model_id = $data_id;
        }
        // dd($id);

        $data = new Asset();
        $data->id = $model_id;
        $data->serial_number = $request->serial_number;
        $data->category_id = $request->category_id;
        $data->name = $request->name;
        $data->status_id = $request->status_id;
        $data->notes = $request->notes;
        $data->assigned_to_id = $request->assigned_to_id;
        $data->term_id = $term_id[0]->id;
        $data->session_id = $session_id[0]->id;
        $data->school_id = $school; 
        $final = $data->save();

        foreach ($request->input('photos', []) as $file) {
            $data->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('photos');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $data->id]);
        }

        if ($final) {
            $notification = array(
                    'message' => 'Asset Added Successfully'
                );
            return redirect()->route('admin.assets.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Operation Failed'
                );
            return redirect()->back()->with($notification);
        }

        

        //return redirect()->route('admin.assets.index');
    }

    public function edit(Asset $asset)
    {
        abort_if(Gate::denies('asset_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = AssetCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = AssetStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_tos = Staff::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $asset->load('category', 'status', 'assigned_to', 'school');

        return view('admin.assets.edit', compact('categories', 'statuses', 'assigned_tos', 'asset'));
    }

    public function update(UpdateAssetRequest $request, Asset $asset)
    {
        $asset->serial_number = $request->serial_number;
        $asset->category_id = $request->category_id;
        $asset->name = $request->name;
        $asset->status_id = $request->status_id;
        $asset->notes = $request->notes;
        $asset->assigned_to_id = $request->assigned_to_id;
        //dd($asset);
        $final = $asset->update();

        if (count($asset->photos) > 0) {
            foreach ($asset->photos as $media) {
                if (!in_array($media->file_name, $request->input('photos', []))) {
                    $media->delete();
                }
            }
        }

        $media = $asset->photos->pluck('file_name')->toArray();

        foreach ($request->input('photos', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $asset->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('photos');
            }
        }

        if ($final) {
            $notification = array(
                    'message' => 'Asset Updated Successfully'
                );
            return redirect()->route('admin.assets.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Operation Failed'
                );
            return redirect()->back()->with($notification);
        }

       // return redirect()->route('admin.assets.index');
    }

    public function show(Asset $asset)
    {
        abort_if(Gate::denies('asset_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $asset->load('category', 'status', 'assigned_to', 'school', 'assetAssetsHistories');

        return view('admin.assets.show', compact('asset'));
    }

    public function destroy(Asset $asset)
    {
        abort_if(Gate::denies('asset_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $asset->delete();

        session()->flash('message', 'Asset Deleted Successfully');
        return back();
    }

    public function massDestroy(MassDestroyAssetRequest $request)
    {
        Asset::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('asset_create') && Gate::denies('asset_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Asset();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media', 'public');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
