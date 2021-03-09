<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyParentGuardianregisterRequest;
use App\Http\Requests\StoreParentGuardianregisterRequest;
use App\Http\Requests\UpdateParentGuardianregisterRequest;
use App\ParentGuardianregister;
use App\School;
use App\DsEconomicStatus;
use Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use App\DsGender;
use Carbon\Carbon;

class ParentGuardianregisterController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = ParentGuardianregister::where('school_id', $request->school)->select(sprintf('%s.*', (new ParentGuardianregister)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'parent_guardianregister_show';
                $editGate      = 'parent_guardianregister_edit';
                $deleteGate    = 'parent_guardianregister_delete';
                $crudRoutePart = 'parents';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('first_name', function ($row) {
                return $row->first_name ? $row->first_name : "";
            });
            $table->editColumn('middle_name', function ($row) {
                return $row->middle_name ? $row->middle_name : "";
            });
            $table->editColumn('last_name', function ($row) {
                return $row->last_name ? $row->last_name : "";
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : "";
            });
            $table->editColumn('phone_number', function ($row) {
                return $row->phone_number ? $row->phone_number : "";
            });

            // $table->editColumn('team', function ($row) {
            //     $labels = [];

            //     foreach ($row->teams as $team) {
            //         $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $team->name);
            //     }

            //     return implode(' ', $labels);
            // });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.parentGuardianregisters.index');
    }

    public function create()
    {
        abort_if(Gate::denies('parent_guardianregister_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $status = DsEconomicStatus::all();
        $gender = DsGender::all();

        return view('admin.parentGuardianregisters.create', compact('status', 'gender'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'profession' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        if (Auth::User()->is_headTeacher) {
            $school = Auth::User()->school_id;
        } else {
            $request->validate([
                'school' => "required",
            ]);
            $school = $request->school;
        }

        if ($files = $request->file('photo')) {

            //delete old file
            File::delete('uploads/parents/'.$request->hidden_image);

            //insert new file
            $destinationPath = 'storage/images/parents/'; // upload path
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
         }
         //Carbon::parse($request->dateofbirth)->format('YYYY-mm-dd')
        $profileImage=isset($profileImage)?$profileImage:$request->hidden_image;
        $parent_id = $request->parent_id;
        // dd($parent_id);
        // Parents::updateOrCreate(['id' => $parent_id],['first_name' => $request->firstName, 'middle_name' => $request->middleName, 'last_name' => $request->lastName, 'email' => $request->email, 'gender_id' => $request->gender, 'date_of_birth' => $request->dateofbirth, 'phone_number' => $request->phoneNumber, 'address' => $request->address, 'profession' => $request->profession, 'school_id' => Auth::User()->school_id, 'income' => $request->income,
        // 'photo' => $profileImage]);

        $data_id = ParentGuardianregister::where('school_id', $school)->max('id') + 1;
        // dd($data_id);
        if ($data_id == 1) {
            $model_id = str_pad($school, 15, "0", STR_PAD_RIGHT).$data_id;
        } else {
            $model_id = $data_id;
        }

        if(empty($request->parent_id)){
            $parent = new ParentGuardianregister();
            $parent->id = $model_id;
            $parent->first_name = $request->first_name;
            $parent->middle_name = $request->middle_name;
            $parent->last_name = $request->last_name;
            $parent->email = $request->email;
            $parent->income = $request->income;
            $parent->gender_id = $request->gender;
            // if(!empty($request->dateofbirth)){
            //     $parent->date_of_birth = Carbon::createFromFormat('d/m/Y', $request->dateofbirth);
            // }
            $parent->phone_number = $request->phone_number;
            $parent->address = $request->address;
            $parent->profession = $request->profession;
            $parent->photo = $profileImage;
            $parent->school_id = $school;
            $result = $parent->save();
        }else{
            $parent = ParentGuardianregister::find($parent_id);
            $parent->first_name = $request->first_name;
            $parent->middle_name = $request->middle_name;
            $parent->last_name = $request->last_name;
            $parent->email = $request->email;
            $parent->income = $request->income;
            $parent->gender_id = $request->gender;
            if(!empty($request->dateofbirth)){
                $parent->date_of_birth = Carbon::createFromFormat('d/m/Y', $request->dateofbirth);
            }
            $parent->phone_number = $request->phone_number;
            $parent->address = $request->address;
            $parent->profession = $request->profession;
            $parent->photo = $profileImage;
            $parent->school_id = $school;
            // dd($parent);
            $result = $parent->update();
        }

        if ($result) {
            if(empty($request->parent_id)){
                session()->flash('message', 'Parent Data Inserted Successfully');
            } else {
                session()->flash('message', 'Parent Data Updated Successfully');
            }
            return redirect()->route('admin.parents.index');
        } else {
            session()->flash('error', 'Operation Failed');
            return redirect()->back();
        }
        
    }

    public function edit($parentGuardianregister)
    {
        $parentGuardianregister = ParentGuardianregister::find($parentGuardianregister);
        // dd($parentGuardianregister);
        abort_if(Gate::denies('parent_guardianregister_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $status = DsEconomicStatus::all();
        $gender = DsGender::all();

        return view('admin.parentGuardianregisters.create', compact('status', 'parentGuardianregister', 'gender'));
    }

    // public function update(UpdateParentGuardianregisterRequest $request, ParentGuardianregister $parentGuardianregister)
    // {
    //     $parentGuardianregister->update($request->all());
    //     $parentGuardianregister->teams()->sync($request->input('teams', []));

    //     return redirect()->route('admin.parents.index');
    // }

    public function show(ParentGuardianregister $parentGuardianregister)
    {
        abort_if(Gate::denies('parent_guardianregister_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parentGuardianregister->load('teams', 'parentGuardianStudentAdmissions');

        return view('admin.parentGuardianregisters.show', compact('parentGuardianregister'));
    }

    public function destroy($parentGuardianregister)
    {
        abort_if(Gate::denies('parent_guardianregister_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // dd($parentGuardianregister);
        $parentGuardianregister = ParentGuardianregister::find($parentGuardianregister);
        // dd($parentGuardianregister);
        $parentGuardianregister->delete();

        session()->flash('message', 'Parent Data Deleted Successfully');
        return redirect()->back();
    }

    public function massDestroy(MassDestroyParentGuardianregisterRequest $request)
    {
        ParentGuardianregister::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
