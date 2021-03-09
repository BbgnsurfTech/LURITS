<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySchoolClassRequest;
use App\Http\Requests\StoreSchoolClassRequest;
use App\Http\Requests\UpdateSchoolClassRequest;
use App\SchoolClass;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use App\DsArms;
use App\School;
use App\DsClassSector;
use App\Staff;
use Yajra\DataTables\Facades\DataTables;

class SchoolClassesController extends Controller
{
    public function index(Request $request)
    {
        // abort_if(Gate::denies('school_class_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::User()->is_headTeacher) {
            $school_id = $request->school;
        } else {
            $school_id = Auth::User()->school_id;
        }

        if ($request->ajax()) {
            $query = SchoolClass::where('school_id', $school_id)->with(["classTitle", "armTitle", "staffData"])->select(sprintf('%s.*', (new SchoolClass)->table));
            dd($query);
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'classroom_show';
                $editGate      = 'classroom_edit';
                $deleteGate    = 'classroom_delete';
                $crudRoutePart = 'school-classes';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->addColumn('class_id', function ($row) {
                return $row->ds_class_id ? $row->classTitle->title : '';
            });

            $table->addColumn('arm_id', function ($row) {
                return $row->ds_arm_id ? $row->armTitle->title : '';
            });

            $table->addColumn('staff_id', function ($row) {
                return $row->staff_id ? $row->staffData->lga_staff_id : '';
            });

            // $table->editColumn('class_title', function ($row) {
            //     return $row->class_title ? $row->class_title : "";
            // });
            // $table->editColumn('arm_title', function ($row) {
            //     return $row->arm_title ? $row->arm_title : "";
            // });
            // $table->editColumn('staff_data', function ($row) {
            //     return $row->staff_data ? $row->staff_data : "";
            // });
            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }
        

        return view('admin.schoolClasses.index');
        if (!Auth::User()->is_headTeacher) {
            $data = $request->all();
            
            if (empty($data)) {
                return view('admin.schoolClasses.adminPage');
            } else {
                // dd($data);
                if (empty($data['school'])) {
                    session()->flash('error','School field is required');
                    return redirect()->back();
                } else {
                    // dd($data['school']);
                    $school_id = $data['school'];
                    $school = School::find($school_id);
                    // dd($school->code_type_sector);
                    $ds_classes = DsClassSector::where('sector_id', $school->code_type_sector)->with(['dsClass'])->get();
                    $ds_arms = DsArms::all();
                    $school_class = SchoolClass::where('school_id', $school_id)->with(["classTitle", "armTitle", "staffData"])->latest()->get();

                    $staffs = Staff::where('school_id', $school_id)->get();

                    // dd($school_class);
                    return view('admin.schoolClasses.index', compact('ds_classes', 'ds_arms', 'school_class', 'staffs'));
                }
            }
            
        } else {
            $classes = DsClassSector::where('sector_id', Auth::User()->school->code_type_sector)->with(['dsClass'])->get();
            $subjects = DsSubjectSector::where('sector_id', Auth::User()->school->code_type_sector)->with(['subjectName'])->get();
            $data = Textbook::where('school_id', Auth::User()->school_id)->get();
            // dd($data);
            $user_textbook = DsUserTextbook::all();

            return view('admin.textbook.index', compact('classes', 'data', 'subjects', 'user_textbook'));
        }

        // $schoolClasses = SchoolClass::all();

        // return view('admin.schoolClasses.index', compact('schoolClasses'));
    }

    public function create()
    {
        abort_if(Gate::denies('school_class_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.schoolClasses.create');
    }

    public function store(StoreSchoolClassRequest $request)
    {
        $schoolClass = SchoolClass::create($request->all());

        return redirect()->route('admin.school-classes.index');
    }

    public function edit(SchoolClass $schoolClass)
    {
        abort_if(Gate::denies('school_class_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.schoolClasses.edit', compact('schoolClass'));
    }

    public function update(UpdateSchoolClassRequest $request, SchoolClass $schoolClass)
    {
        $schoolClass->update($request->all());

        return redirect()->route('admin.school-classes.index');
    }

    public function show(SchoolClass $schoolClass)
    {
        abort_if(Gate::denies('school_class_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $schoolClass->load('classLessons', 'classUsers');

        return view('admin.schoolClasses.show', compact('schoolClass'));
    }

    public function destroy(SchoolClass $schoolClass)
    {
        abort_if(Gate::denies('school_class_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $schoolClass->delete();

        return back();
    }

    public function massDestroy(MassDestroySchoolClassRequest $request)
    {
        SchoolClass::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
