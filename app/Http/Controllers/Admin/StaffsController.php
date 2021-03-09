<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use Spatie\MediaLibrary\Models\Media;
use App\Http\Requests\MassDestroyStaffRequest;
use App\Http\Requests\StoreStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use Validator;
use Storage;
use App\DsTypeStaffSector;
use App\SchoolAtlas;
use App\Staff;
use App\Term;
use App\DsRank;
use App\AtlasLink;
use App\Session;
use App\DsPresentStatus;
use App\DsDisability;
use App\DsTeachingTypePartTime;
use App\DsSalarySource;
use App\DsGender;
use App\DsAcademicQualification;
use App\DsTeachingType;
use App\DsTypeStaff;
use App\DsSector;
use App\DsMaritalStatus;
use App\DsTeachingQualification;
use App\DsYesNo;
use App\DsSubject;
use App\School;
use App\Atlas;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class StaffsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('staff_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            
            $query = Staff::where('school_id', $request->school)->with(['school'])->select(sprintf('%s.*', (new Staff)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'staff_show';
                $editGate      = 'staff_edit';
                $deleteGate    = 'staff_delete';
                $crudRoutePart = 'staffs';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('lga_staff_id', function ($row) {
                return $row->lga_staff_id ? $row->lga_staff_id : "";
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

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.staffs.index');
    }

    public function fetchSector($sector)
    {
        $a = School::where('id', $sector)->pluck('code_type_sector');
        $b = DsTypeStaffSector::where('sector_id', $a)->pluck('type_staff_id');
        //dd($b);

        $data = DsTypeStaff::whereIn('id', $b)->get();
        return json_encode($data);
    }

    public function getStaff(Request $request)
    {
        $school_id = Auth::User()->school_id;
        if ($request->ajax()) {
            
            $query = Staff::where('school_id', $school_id)->with(['school'])->select(sprintf('%s.*', (new Staff)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'staff_show';
                $editGate      = 'staff_edit';
                $deleteGate    = 'staff_delete';
                $crudRoutePart = 'staffs';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('staff_id', function ($row) {
                return $row->staff_id ? $row->staff_id : "";
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

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }
    }

    public function create()
    {
        abort_if(Gate::denies('staff_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subjects = DsSubject::all();
        $genders = DsGender::all();
        $schools = School::all();
        $present_status = DsPresentStatus::all();
        $salary_source = DsSalarySource::all();
        $academic_qualification = DsAcademicQualification::all();
        $teaching_type = DsTeachingType::all();
        if (Auth::User()->is_headTeacher) {
            $b = DsTypeStaffSector::where('sector_id', Auth::User()->school->code_type_sector)->pluck('type_staff_id');

            $type_staff = DsTypeStaff::whereIn('id', $b)->get();
               
        } else {
            $type_staff = DsTypeStaff::all();
        }
        $disabilities = DsDisability::all();
        $teaching_qualification = DsTeachingQualification::all();
        $seminar_workshop = DsYesNo::all();
        $atlas = Atlas::all();
        $ranks = DsRank::all();

        $marital_status = DsMaritalStatus::all();
        $teaching_type_part_time = DsTeachingTypePartTime::all();

        return view('admin.staffs.create', compact('marital_status' ,'subjects', 'genders', 'schools', 'present_status', 'salary_source', 'academic_qualification', 'teaching_type', 'type_staff', 'teaching_qualification', 'seminar_workshop', 'atlas', 'teaching_type_part_time', 'ranks', 'disabilities'));
    }

    public function face(Request $request)
    {
        if ($request->ajax()) {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.luxand.cloud/photo/search",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => [ "photo" => curl_file_create($request->photo)], 
                // or use URL
                // CURLOPT_POSTFIELDS => [ "photo" => "https://dashboard.luxand.cloud/img/brad.jpg" ], 
                CURLOPT_HTTPHEADER => array(
                    "token: 631dc0a781be4335997fb893b1d3de55"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            $json = json_decode($response, true);
            // $d = $json[0]["id"];
            // dd($response, $err);
            curl_close($curl);
            // return $json->id;
            if ($err) {
                return (419);
            } else {
                if (isset($json[0]['id'])) {

                    $data = Staff::where('api_id', $json[0]['id'])->with(["teaching_type_part_time", "type_staff", "maritalstatus", "disability", "salary_source", "present_status", "academic_qualification", "teaching_qualification", "subject_of_qualification", "subject_taught", "area_of_specialization", "teaching_type", "seminar_workshop", "school", "gender", "state_origin", "lga_origin", "rank"])->first();
                    
                    return (["success" => true, "data" => $data]);
                    
                } else {
                    return (404);
                }
            }
        }
    }

    public function store(StoreStaffRequest $request)
    {
        //dd($request->all());
        if (Auth::User()->is_headTeacher) {
            $staff_school = Auth::User()->school_id;
        } else {
            $request->validate([
                'school' => "required",
            ]);
            $staff_school = $request->school;
        }

        if ($request->staff_picture !== null) {
            $name = $request->first_name. ' ' .$request->last_name;
            $image = 'storage/files/'.$request->input('staff_picture');
            $file = Storage::url($image);
            $url = config("app.url");
            $b = asset($url.'/'.$image);
            // dd($image);

            $imagee = base64_encode(file_get_contents($image));
            // dd($imagee);
        }

        $term_id = Term::where('active_status', 1)->select('id')->get();
        $session_id = Session::where('active_status', 1)->select('id')->get();
        
        if ($request->academic_qualification !== "1") {
            $request->validate([
                'teaching_qualification' => "required",
                'area_of_specialization' => "required",
                'subject_of_qualification' => "required",
                'subject_taught' => "required",
                'seminar_workshop' => "required",
                'rank' => "required",
            ]);
        }


        $aa = Staff::where('school_id', $staff_school)->where('type_staff_id', $request->type_of_staff)->get();
        foreach ($aa as $staff) {
            if ($staff->type_staff_id == 1 || $staff->type_staff_id == 2 || $staff->type_staff_id == 7 || $staff->type_staff_id == 8) {
                    $request->validate([
                'type_staff_id' => "required",['type_staff_id-required' => "my mesage"]
            ]);
                }    
        }

        if ($request->lga_origin == 0) {
            session()->flash('error', 'Operation Failed. You didn\'t select LGA of Origin');
            return redirect()->back();
        }

        if ($staff_school == 0) {
            session()->flash('error', 'Operation Failed. You didn\'t select School');
            return redirect()->back();
        }

        if ($request->teaching_type == 2 && $request->teaching_type_part_time == null) {
            session()->flash('error', 'Operation Failed. You selected PART TIME for staff teaching type, but didn\'t specify the staff\'s teaching type');
            return redirect()->back();
        }

        //Finding School LGA
        $school_atlas_entity = School::find($staff_school)->lga->code_atlas_entity;
        $lga_short_code = Atlas::where('code_atlas_entity', $school_atlas_entity)->pluck('short_code')->first();
        //Finding the last staff of an LGA
        if(Staff::count() == 0){
            $lga_staff_id = str_pad($lga_short_code.'-', 10, '0', STR_PAD_RIGHT). 1;
        } else {
            $lga_schools = School::with('lga')->get();
            $lga_schools_code = $lga_schools->where('lga.code_atlas_entity', $school_atlas_entity)->pluck('id');
            $last_lga_staff_id = Staff::whereIn('school_id', $lga_schools_code)->max('lga_staff_id');
            $split_last_lga_staff_id = explode('-', $last_lga_staff_id);
            $split_code = $split_last_lga_staff_id[1] + 1;
            $first_code = $lga_short_code.'-';
            $lga_staff_id = str_pad($first_code, 10, '0', STR_PAD_RIGHT).$split_code;
        }
        // dd($lga_staff_id);

        if ($request->type_of_staff == 1 || $request->type_of_staff == 2 || $request->type_of_staff == 3 || $request->type_of_staff == 4 || $request->type_of_staff == 5) {
            $role = 5;
        } elseif ($request->type_of_staff == 6 || $request->type_of_staff == 7) {
            $role = 6;
        } else {
            $role = null;
        }
        //dd($role);
        DB::beginTransaction();
        try {
            
            if ($request->staff_picture !== null) {
                // Start Api Create 

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.luxand.cloud/subject",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => [ "name" => $name], 
                    CURLOPT_HTTPHEADER => array(
                        "token: 631dc0a781be4335997fb893b1d3de55"
                    ),
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);

                if ($err) {
                    session()->flash('error', 'Something went wrong while registering user api ID');
                    return redirect()->back();
                } else {
                    $data = json_decode($response);
                    $api_id = $data->id;
                }

                // End Api Create
                
                // Start Api Face

                $curl = curl_init();
                $link = "https://api.luxand.cloud/subject/".$api_id;
                curl_setopt_array($curl, array(
                    CURLOPT_URL => $link,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    //CURLOPT_POSTFIELDS => [ "store" => "1", "photo" => curl_file_create($b)], 
                    // or use URL
                    CURLOPT_POSTFIELDS => [ "photo" => $imagee ], 
                    CURLOPT_HTTPHEADER => array(
                        "token: 631dc0a781be4335997fb893b1d3de55"
                    ),
                ));

                $response = curl_exec($curl);
                $errr = curl_error($curl);

                curl_close($curl);

                if ($errr) {
                    dd($errr);
                    session()->flash('error', 'Something went wrong while registering user api FACE');
                    return redirect()->back();
                } else {
                    $res = json_decode($response);
                }

                // End Api Face
            }

            $user = new User();
            $user->name = $request->first_name. ' ' .$request->middle_name. ' ' .$request->last_name;
            if ($request->email !== null) {
                $user->email = $request->email;
            } else {
                $user->username = 'custom_username';
            }
            $user->password = Hash::make(12345678);
            $user->school_id = $staff_school;
            $user->save();
            $user->toArray();
            if ($role !== null) {
                $user->roles()->sync($role);
            }
            
            $data_id = Staff::where('school_id', $staff_school)->max('id') + 1;
            // dd($data_id);
            if ($data_id == 1) {
                $model_id = str_pad($staff_school, 15, "0", STR_PAD_RIGHT).$data_id;
            } else {
                $model_id = $data_id;
            }

            $data = new Staff();
            $data->id = $model_id;
            if ($request->staff_picture !== null) {
                $data->api_id = $api_id;
            }
            $data->lga_staff_id = $lga_staff_id;
            $data->user_id = $user->id;
            $data->first_name = $request->first_name;
            $data->middle_name = $request->middle_name;
            $data->last_name = $request->last_name;
            $data->email = $request->email;
            $data->address = $request->address;
            $data->phone_number = $request->phone_number;
            $data->date_of_birth = $request->date_of_birth;
            $data->state_of_origin_id = $request->state_origin;
            $data->lga_of_origin_id = $request->lga_origin;
            $data->marital_status_id = $request->marital_status;
            $data->disability_id = $request->disability;
            $data->grade_level = $request->grade_level;
            $data->grade_step = $request->grade_step;
            $data->gender_id = $request->gender;
            $data->type_staff_id = $request->type_of_staff;
            $data->other_qualification = $request->other_qualification;
            $data->other_salary_source = $request->other_salary_source;
            $data->present_status_id = $request->present;
            $data->academic_qualification_id = $request->academic_qualification;
            $data->teaching_type_id = $request->teaching_type;
            $data->salary_source_id = $request->source_of_salary;
            $data->year_first_appointment = $request->first_appointment;
            $data->year_present_appointment = $request->present_appointment;
            $data->year_posting_to_school = $request->posting_to_school;
            if ($request->teaching_type == 2){
                $data->teaching_type_part_time = $request->teaching_type_part_time;
            }
            $data->term_id = $term_id[0]->id;
            $data->session_id = $session_id[0]->id;
            $data->school_id = $staff_school;
            if ($request->academic_qualification !== "1") {
                $data->rank_id = $request->rank;
                $data->teaching_qualification_id = $request->teaching_qualification;
                $data->area_of_specialization_id = $request->area_of_specialization;
                $data->subject_of_qualification_id = $request->subject_of_qualification;
                $data->main_subject_taught_id = $request->subject_taught;
                $data->seminar_workshop_id = $request->seminar_workshop;
                $data->other_area_of_specialization = $request->other_area_of_specialization;
                $data->other_subject_of_qualification = $request->other_subject_of_qualification;
                $data->other_main_subject_taught = $request->other_main_subject_taught;
            }
            //dd($data);
            $results = $data->save();

            if ($request->input('staff_picture', false)) {
                $data->addMedia(storage_path('app/public/files/' . $request->input('staff_picture')))->toMediaCollection('staff_picture');
            }

            foreach ($request->input('staff_document', []) as $file) {
                $data->addMedia(storage_path('app/public/files/' . $file))->toMediaCollection('staff_document');
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

        if ($results) {
            $message = 'Staff Data Added Successfully'.' STAFF ID: '.$u;
            session()->flash('message', $message);
            return redirect()->route('admin.staffs.index');
        }        

        return redirect()->route('admin.staffs.index');
    }

    public function edit(Staff $staff)
    {
        abort_if(Gate::denies('staff_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staff->load('school');
        $subjects = DsSubject::all()->pluck('ds_subject_title', 'id');
        $genders = DsGender::all()->pluck('title', 'id');
        $schools = School::all();
        $present_status = DsPresentStatus::all()->pluck('title', 'id');
        $salary_source = DsSalarySource::all()->pluck('title', 'id');
        $academic_qualification = DsAcademicQualification::all()->pluck('title', 'id');
        $teaching_type = DsTeachingType::all()->pluck('title', 'id');
        $type_staff = DsTypeStaff::all()->pluck('title', 'id');
        $teaching_qualification = DsTeachingQualification::all()->pluck('title', 'id');
        $seminar_workshop = DsYesNo::all()->pluck('title', 'id');
        $atlas = Atlas::all();
        $disabilities = DsDisability::all()->pluck('title', 'id');
        $marital_status = DsMaritalStatus::all()->pluck('title', 'id');
        $ranks = DsRank::all()->pluck('title', 'id');      
        if (Auth::User()->is_zeqa) {
            $a = Auth::User()->atlas;
            $stateLGA = AtlasLink::where('code_atlas_link', $a->atlas_id)->pluck('code_atlas_entity');
            $lga = Atlas::whereIn('code_atlas_entity', $stateLGA)->get();
        } else {
            $lga = null;
        }

        if (Auth::User()->is_lgea) {
            $a = Auth::User()->atlas;
            $b = $a->atlas_id;
            $schooll = SchoolAtlas::where('code_atlas_entity', $b)->pluck('school_id');
            $lgea = School::whereIn('id', $schooll)->where('code_type_sector', 1)->get();
        } else {
            $lgea = null;
        }

        $teaching_type_part_time = DsTeachingTypePartTime::all()->pluck('title', 'id');

        return view('admin.staffs.edit', compact('staff', 'subjects', 'genders', 'schools', 'present_status', 'salary_source', 'academic_qualification', 'teaching_type', 'type_staff', 'teaching_qualification', 'seminar_workshop', 'atlas', 'marital_status', 'disabilities', 'teaching_type_part_time', 'lga', 'lgea', 'ranks'));
    }

    public function update(UpdateStaffRequest $request, Staff $staff)
    {
        // $name = $request->first_name. ' ' .$request->last_name;
        // $image = 'public/files/'.$request->input('staff_picture');
        // $file = Storage::get($image);
        // $b = base64_encode($file);
        //dd($b);
        //dd($image);

        if (!Auth::User()->is_headTeacher) {
            if ($request->lga_origin == 0 || $request->school == 0) {
                session()->flash('error', 'Operation Failed. You did\'nt select LGA of Origin or School');
                return redirect()->back();
            }
        } else {
            if ($request->lga_origin == 0) {
                session()->flash('error', 'Operation Failed. You did\'nt select LGA of Origin');
                return redirect()->back();
            }
        }

        if ($request->teaching_type == 2 && $request->teaching_type_part_time == null) {
            session()->flash('error', 'Operation Failed. You selected PART TIME for staff teaching type, but didn\'t specify the staff\'s teaching type');
            return redirect()->back();
        }

        if ($staff->type_staff_id !== (int)$request->type_of_staff) {
            $change = 1;
        }else{
            $change = 0;
        }
        //dd($change);
        
        if ($change == 1) {
            $aa = Staff::where('school_id', $request->school)->where('type_staff_id', $request->type_of_staff)->get();
            foreach ($aa as $staff) {
                if ($staff->type_staff_id == 1 || $staff->type_staff_id == 2 || $staff->type_staff_id == 3 || $staff->type_staff_id == 4 || $staff->type_staff_id == 5) {
                        session()->flash('error', 'The selected type already exist for this school.');
                        return redirect()->back();
                    }    
            }
        }

        $term_id = Term::where('active_status', 1)->select('id')->get();
        $session_id = Session::where('active_status', 1)->select('id')->get();

        if ($request->academic_qualification !== "1") {
            $request->validate([
                'teaching_qualification' => "required",
                'area_of_specialization' => "required",
                'subject_of_qualification' => "required",
                'subject_taught' => "required",
                'seminar_workshop' => "required",
                'rank' => "required",
            ]);
        }

        if ($staff->email !== $request->email) {
            $request->validate([
                'email' => "unique:staffs",
            ]);
        }

        if ($staff->phone_number !== $request->phone_number) {
            $request->validate([
                'phone_number' => "unique:staffs",
            ]);
        }

        $data = Staff::findOrFail($staff->id);
        $data->first_name = $request->first_name;
        $data->middle_name = $request->middle_name;
        $data->last_name = $request->last_name;
        if ($staff->email !== $request->email) {
            $data->email = $request->email;
        }
        if ($staff->phone_number !== $request->phone_number) {
            $data->phone_number = $request->phone_number;
        }
        $data->address = $request->address;
        $data->date_of_birth = $request->date_of_birth;
        $data->state_of_origin_id = $request->state_origin;
        $data->lga_of_origin_id = $request->lga_origin;
        $data->marital_status_id = $request->marital_status;
        $data->disability_id = $request->disability;
        $data->grade_level = $request->grade_level;
        $data->grade_step = $request->grade_step;
        $data->gender_id = $request->gender;
        if ($change == 1) {
            $data->type_staff_id = $request->type_of_staff;
        }
        $data->present_status_id = $request->present;
        $data->academic_qualification_id = $request->academic_qualification;
        $data->teaching_type_id = $request->teaching_type;
        $data->salary_source_id = $request->source_of_salary;
        $data->year_first_appointment = $request->first_appointment;
        $data->year_present_appointment = $request->present_appointment;
        $data->year_posting_to_school = $request->posting_to_school;
        $data->other_qualification = $request->other_qualification;
        $data->other_salary_source = $request->other_salary_source;
        if ($request->teaching_type == 2){
            $data->teaching_type_part_time = $request->teaching_type_part_time;
        }
        if (!Auth::User()->is_headTeacher) {
            $data->school_id = $request->school_id;
        }
        if ($request->academic_qualification !== "1") {
            $data->rank_id = $request->rank;
            $data->teaching_qualification_id = $request->teaching_qualification;
            $data->area_of_specialization_id = $request->area_of_specialization;
            $data->subject_of_qualification_id = $request->subject_of_qualification;
            $data->main_subject_taught_id = $request->subject_taught;
            $data->seminar_workshop_id = $request->seminar_workshop;
            $data->other_area_of_specialization = $request->other_area_of_specialization;
            $data->other_subject_of_qualification = $request->other_subject_of_qualification;
            $data->other_main_subject_taught = $request->other_main_subject_taught;
        }
        //dd($data);
        $results = $data->update();

        if ($request->input('staff_picture', false)) {
            if (!$data->staff_picture || $request->input('staff_picture') !== $data->staff_picture->file_name) {
                $data->addMedia(storage_path('app/public/files/' . $request->input('staff_picture')))->toMediaCollection('staff_picture');
            }
        } elseif ($data->staff_picture) {
            $data->staff_picture->delete();
        }

        if (count($data->staff_document) > 0) {
            foreach ($data->staff_document as $media) {
                if (!in_array($media->file_name, $request->input('staff_document', []))) {
                    $media->delete();
                }
            }
        }

        $media = $data->staff_document->pluck('file_name')->toArray();

        foreach ($request->input('staff_document', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $data->addMedia(storage_path('app/public/files/' . $file))->toMediaCollection('staff_document');
            }
        }
        

        if ($results) {
            session()->flash('message', 'Staff Data Updated Successfully');
            return redirect()->route('admin.staffs.index');
        } else {
            session()->flash('error', 'Operation Successful');
            return redirect()->back();
        }
        
    }

    public function show(Staff $staff)
    {
        abort_if(Gate::denies('staff_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staff->load('school');

        return view('admin.staffs.show', compact('staff'));
    }

    public function destroy(Staff $staff)
    {
        abort_if(Gate::denies('staff_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staff->delete();

        session()->flash('message', 'Staff Data Deleted Successfully');
        return redirect()->route('admin.staffs.index');
    }

    public function massDestroy(MassDestroyStaffRequest $request)
    {
        Staff::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('staff_create') && Gate::denies('staff_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Staff();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media', 'public');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
