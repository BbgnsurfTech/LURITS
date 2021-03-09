<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyStudentAdmissionRequest;
use App\Http\Requests\StoreStudentAdmissionRequest;
use App\Http\Requests\UpdateStudentAdmissionRequest;
use App\Parents;
use App\Classroom;
use App\DsClass;
use App\Term;
use App\Session;
use App\AtlasLink;
use App\DsGender;
use App\DsReligion;
use App\DsBloodGroup;
use App\StudentAdmission;
use App\School;
use App\DsDisability;
use App\SchoolClass;
use Gate;
use App\DsEconomicStatus;
use App\SchoolAtlas;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use App\Atlas;
use App\DsMaritalStatus;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use App\DsParentalStatus;
use DB;
use App\DsYesNo;

class StudentAdmissionController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('student_admission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        if ($request->ajax()) {
            
            $query = StudentAdmission::where('school_enrolled_id', $request->school)->where('class_id', $request->classs)->select(sprintf('%s.*', (new StudentAdmission)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'student_admission_show';
                $editGate      = 'student_admission_edit';
                $deleteGate    = 'student_admission_delete';
                $crudRoutePart = 'student-admissions';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            
            $table->editColumn('child_name', function ($row) {
                return $row->child_name ? $row->child_name : "";
            });
            $table->editColumn('middle_name', function ($row) {
                return $row->middle_name ? $row->middle_name : "";
            });
            $table->editColumn('last_name', function ($row) {
                return $row->last_name ? $row->last_name : "";
            });
            $table->editColumn('admission', function ($row) {
                return $row->admission_number ? $row->admission_number : "";
            });
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $classroom = SchoolClass::with(["classTitle", "armTitle"])->where('school_id', Auth::User()->school_id)->get();


        return view('admin.studentAdmissions.index', compact('classroom'));
    }

    public function getAdmission(Request $request)
    {
        if ($request->ajax()) {
            $query = StudentAdmission::where('school_enrolled_id', Auth::User()->school_id)->where('class_id', $request->classss)->select(sprintf('%s.*', (new StudentAdmission)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'student_admission_show';
                $editGate      = 'student_admission_edit';
                $deleteGate    = 'student_admission_delete';
                $crudRoutePart = 'student-admissions';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            
            $table->editColumn('child_name', function ($row) {
                return $row->child_name ? $row->child_name : "";
            });
            $table->editColumn('middle_name', function ($row) {
                return $row->middle_name ? $row->middle_name : "";
            });
            $table->editColumn('last_name', function ($row) {
                return $row->last_name ? $row->last_name : "";
            });
            $table->editColumn('admission', function ($row) {
                return $row->admission ? $row->admission : "";
            });
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }
    }

    public function create()
    {
        abort_if(Gate::denies('student_admission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $school_enrolleds = School::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $classroom = SchoolClass::where('school_id', Auth::User()->school_id)->with(["classTitle", "armTitle"])->get();
        $genders = DsGender::all();
        $religions = DsReligion::all();
        $blood_groups = DsBloodGroup::all();
        $atlas = Atlas::all();
        $marital_status = DsMaritalStatus::all();
        $parent_guardians = Parents::where('school_id', Auth::User()->school_id)->get();
        $economic = DsEconomicStatus::all();
        $disabilities = DsDisability::all();
        $parental_statuses = DsParentalStatus::all();
        $ds_yes_no = DsYesNo::all();

        return view('admin.studentAdmissions.create', compact('school_enrolleds', 'classroom', 'parent_guardians', 'genders', 'religions', 'blood_groups', 'atlas', 'marital_status', 'economic', 'disabilities', 'parental_statuses', 'ds_yes_no'));
    }

    public function fetchParents($school)
    {
        $data = Parents::where('school_id', $school)->get();
        return json_encode($data);
    }

    public function fetchClass($school)
    {
        $data = SchoolClass::where('school_id', $school)->with(['classTitle', 'armTitle'])->get();
        return json_encode($data);
    }

    public function store(StoreStudentAdmissionRequest $request)
    {
        DB::beginTransaction();
        try {
            $session_id = Session::where('active_status', 1)->pluck('id')->first();
            $term_id = Term::where('active_status', 1)->pluck('id')->first();
            // dd($session_id);

            if (Auth::User()->is_headTeacher) {
                $school_id = Auth::User()->school_id;
                $r = Auth::User()->school->lga->code_atlas_entity;
            } else {
                $school_id = $request->school;
                $r = School::find($school_id)->lga->code_atlas_entity;
            }

            $rr = Atlas::where('code_atlas_entity', $r)->pluck('short_code')->first();
            $s = StudentAdmission::max('id') +1;
            $u = str_pad($rr.'-', 10, '0', STR_PAD_RIGHT).$s;
            // dd($u);

            $data_id = StudentAdmission::where('school_enrolled_id', $school_id)->max('id') + 1;

            if ($data_id == 1) {
                $model_id = str_pad($school_id, 15, "0", STR_PAD_RIGHT).$data_id;
            } else {
                $model_id = $data_id;
            }

            $data = new StudentAdmission();
            $data->id = $model_id;
            $data->child_name = $request->child_name;
            $data->middle_name = $request->middle_name;
            $data->last_name = $request->last_name;
            $data->date_of_birth = $request->date_of_birth;
            $data->parental_status_id = $request->parental_status;
            $data->date_of_admission = $request->date_of_admission;
            $data->eccd = $request->eccd;
            $data->comp_p6_yes_no = $request->comp_p6_yes_no;
            $data->admission_number = $u;
            $data->address = $request->address;
            $data->marital_status_id  = $request->marital_status;
            $data->disability = $request->disability;
            $data->hobby = $request->hubby;
            $data->religion_id = $request->religion;
            $data->gender_id = $request->gender;
            $data->blood_group_id = $request->blood_group;
            $data->state_of_origin_id = $request->state_origin;
            $data->nationality_id = 1;
            $data->lga_of_origin_id = $request->lga_origin;
            $data->class_id = $request->class_id;
            $data->parent_guardian_id = $request->parent_guardian_id;
            $data->term_id = $term_id;
            $data->session_id = $session_id;
            $data->school_enrolled_id = $school_id;
            //dd($data);
            $final = $data->save();

            if ($request->input('student_picture', false)) {
                $data->addMedia(storage_path('app/public/files/' . $request->input('student_picture')))->toMediaCollection('student_picture');
            }

            foreach ($request->input('student_document', []) as $file) {
                $data->addMedia(storage_path('app/public/files/' . $file))->toMediaCollection('student_document');
            }

            if ($media = $request->input('ck-media', false)) {
                Media::whereIn('id', $media)->update(['model_id' => $data->id]);
            }

            DB::commit();

            

            
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            session()->flash('error', 'Operation Failed');
            return redirect()->back();
        }

        if ($final) {
            session()->flash('message', 'Student data added Successfully');
            return redirect()->route('admin.student-admissions.index');
        } else {
            session()->flash('error', 'Operation Failed');
            return redirect()->back();
        }
    }

    public function edit(StudentAdmission $studentAdmission)
    {
        abort_if(Gate::denies('student_admission_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $school_enrolleds = School::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $classroom = SchoolClass::where('school_id', Auth::User()->school_id)->with(["classTitle", "armTitle"])->get();

        $parent_guardians = Parents::all()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $studentAdmission->load('school_enrolled', 'parent_guardian', 'school');

        $parent_guardians = Parents::where('school_id', Auth::User()->school_id)->get();
        $genders = DsGender::all()->pluck('title', 'id');
        $religions = DsReligion::all()->pluck('title', 'id');
        $blood_groups = DsBloodGroup::all()->pluck('title', 'id');
        $atlas = Atlas::all();
        $marital_status = DsMaritalStatus::all()->pluck('title', 'id');
        $disabilities = DsDisability::all()->pluck('title', 'id');
        $parental_statuses = DsParentalStatus::all()->pluck('title', 'id');
        $ds_yes_no = DsYesNo::all();

        return view('admin.studentAdmissions.edit', compact('school_enrolleds', 'classroom', 'parent_guardians', 'studentAdmission', 'genders', 'religions', 'blood_groups', 'atlas', 'marital_status', 'disabilities', 'parental_statuses', 'ds_yes_no'));
    }

    public function update(UpdateStudentAdmissionRequest $request, StudentAdmission $studentAdmission)
    {
        //$studentAdmission->update($request->all());

        $studentAdmission = StudentAdmission::find($studentAdmission->id);
        $studentAdmission->child_name = $request->child_name;
        $studentAdmission->middle_name = $request->middle_name;
        $studentAdmission->last_name = $request->last_name;
        $studentAdmission->date_of_birth = $request->date_of_birth;
        $data->parental_status_id = $request->parental_status;
        $data->eccd = $request->eccd;
        $data->comp_p6_yes_no = $request->comp_p6_yes_no;
        $data->date_of_admission = $request->date_of_admission;
        $studentAdmission->address = $request->address;
        $studentAdmission->hobby = $request->hubby;
        $studentAdmission->disability = $request->disability;
        $studentAdmission->religion_id = $request->religion;
        $studentAdmission->gender_id = $request->gender;
        $studentAdmission->blood_group_id = $request->blood_group;
        $studentAdmission->state_of_origin_id = $request->state_origin;
        $studentAdmission->lga_of_origin_id = $request->lga_origin;
        $studentAdmission->class_id = $request->class_id;
        $studentAdmission->parent_guardian_id = $request->parent_guardian_id;
        $studentAdmission->update();

        if ($request->input('student_picture', false)) {
            if (!$studentAdmission->student_picture || $request->input('student_picture') !== $studentAdmission->student_picture->file_name) {
                $studentAdmission->addMedia(storage_path('app/public/files/' . $request->input('student_picture')))->toMediaCollection('student_picture');
            }
        } elseif ($studentAdmission->student_picture) {
            $studentAdmission->student_picture->delete();
        }

        if (count($studentAdmission->student_document) > 0) {
            foreach ($studentAdmission->student_document as $media) {
                if (!in_array($media->file_name, $request->input('student_document', []))) {
                    $media->delete();
                }
            }
        }

        $media = $studentAdmission->student_document->pluck('file_name')->toArray();

        foreach ($request->input('student_document', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $studentAdmission->addMedia(storage_path('app/public/files/' . $file))->toMediaCollection('student_document');
            }
        }

        session()->flash('message', 'Student Data Updated Successfully');
        return redirect()->route('admin.student-admissions.index');
    }

    public function show(StudentAdmission $studentAdmission)
    {
        abort_if(Gate::denies('student_admission_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentAdmission->load('school_enrolled', 'parent_guardian', 'school', 'admissionAttendances');

        $classroom = Classroom::all()->pluck('class', 'id');

        return view('admin.studentAdmissions.show', compact('studentAdmission', 'classroom'));
    }

    public function destroy(StudentAdmission $studentAdmission)
    {
        abort_if(Gate::denies('student_admission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentAdmission->delete();

        return back();
    }

    public function massDestroy(MassDestroyStudentAdmissionRequest $request)
    {
        StudentAdmission::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('student_admission_create') && Gate::denies('student_admission_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new StudentAdmission();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media', 'public');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
