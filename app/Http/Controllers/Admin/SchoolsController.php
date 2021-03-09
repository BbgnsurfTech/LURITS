<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroySchoolRequest;
use App\Http\Requests\StoreSchoolRequest;
use App\Http\Requests\UpdateSchoolRequest;
use App\School;
use Gate;
use App\DsSector;
use App\DsClass;
use App\DsArms;
use App\Atlas;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use App\SchoolAtlas;
use App\SchoolBackground;
use App\DsSchoolLocation;
use App\DsSchoolType;
use App\DsYesNo;
use App\DsAuthority;
use App\DsSchoolOwnership;
use App\DsWaterSource;
use App\DsElectricitySource;
use App\DsHealthFacilities;
use DB;
use App\DsFacility;
use App\DsPlayRoom;
use App\DsPlayFacility;
use App\DsLearningMaterial;
use App\SchoolLearningMaterial;
use App\SchoolPlayFacility;
use App\SchoolSharedFacility;

class SchoolsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('school_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = School::with(['school'])->select(sprintf('%s.*', (new School)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'school_show';
                $editGate      = 'school_edit';
                $deleteGate    = 'school_delete';
                $crudRoutePart = 'schools';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('pseudo_code', function ($row) {
                return $row->pseudo_code ? $row->pseudo_code : "";
            });
            $table->editColumn('nemis_code', function ($row) {
                return $row->nemis_code ? $row->nemis_code : "";
            });
            $table->editColumn('school_community', function ($row) {
                return $row->school_community ? $row->school_community : "";
            });
            $table->editColumn('village_town', function ($row) {
                return $row->village_town ? $row->village_town : "";
            });
            $table->editColumn('code_type_sector', function ($row) {
                return $row->code_type_sector ? School::CODE_TYPE_SECTOR_SELECT[$row->code_type_sector] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.schools.index');
    }

    public function getSchools(Request $request)
    {
        abort_if(Gate::denies('school_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $a = Auth::User()->atlas;
            $b = $a->atlas_id;
            $schooll = SchoolAtlas::where('code_atlas_entity', $b)->pluck('school_id');

            $query = School::whereIn('id', $schooll)->where('code_type_sector', 1)->select(sprintf('%s.*', (new School)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'school_show';
                $editGate      = 'school_edit';
                $deleteGate    = 'school_delete';
                $crudRoutePart = 'schools';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('pseudo_code', function ($row) {
                return $row->pseudo_code ? $row->pseudo_code : "";
            });
            $table->editColumn('nemis_code', function ($row) {
                return $row->nemis_code ? $row->nemis_code : "";
            });
            $table->editColumn('school_community', function ($row) {
                return $row->school_community ? $row->school_community : "";
            });
            $table->editColumn('village_town', function ($row) {
                return $row->village_town ? $row->village_town : "";
            });
            $table->editColumn('code_type_sector', function ($row) {
                return $row->code_type_sector ? School::CODE_TYPE_SECTOR_SELECT[$row->code_type_sector] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.schools.index');
    }

    public function create()
    {
        abort_if(Gate::denies('school_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sectors = DsSector::all();

        return view('admin.schools.create', compact('sectors'));
    }

    public function classrooms()
    {
        //if (Auth::User()->is_admin) {
        //    $classes = DsClass::all();
        //} else {
            $classes = Auth::User()->school;
        //}
        $schools = School::all();
        $arms = DsArms::all();
        return view('admin.classroom.school-class', compact('classes', 'schools', 'arms'));
    }

    public function store_class(Request $request)
    {
        $class = new DsClass();
        $class->name = $request->classs;
        $class->arm_id = $request->arm;
        $class->school_id  = Auth::User()->school_id;
        $final = $class->save();

        if ($final) {
            session()->flash('message', 'Operation Successful');
            return redirect()->back();
        } else {
            session()->flash('error', 'Operation Failed');
            return redirect()->back();
        }
        
    }

    public function store(StoreSchoolRequest $request)
    {
        $school = new School();
        $school->name = $request->name;
        $school->pseudo_code = $request->pseudo_code;
        $school->nemis_code = $request->nemis_code;
        $school->number_and_street = $request->number_and_street;
        $school->school_community = $request->school_community;
        $school->village_town = $request->village_town;
        $school->email_address = $request->email_address;
        $school->school_telephone = $request->school_telephone;
        $school->code_type_sector = $request->code_type_sector;
        $school->latitude_north = $request->latitude_north;
        $school->longitude_east = $request->longitude_east;
        $school->nearby_name_school = $request->nearby_name_school;
        $school->save();

        $data=[
            "school_id" => $school->id,
            "code_atlas_entity" => $request->lga,
        ];

        $lgaa = SchoolAtlas::insert($data);

        session()->flash('message', 'Operation Successful');
        return redirect()->route('admin.schools.index');
    }

    public function background()
    {
        if (Auth::User()->is_headTeacher) {
            $find = SchoolBackground::where('school_id', Auth::User()->school_id)->first();
            // dd($find);
            if ($find == null) {
                $sch = new SchoolBackground();
                $sch->school_id = Auth::User()->school_id;
                $sch->save();

                $locations = DsSchoolLocation::all()->pluck('title', 'id');
                $school_type = DsSchoolType::all()->pluck('title', 'id');
                $yes_no = DsYesNo::all()->pluck('title', 'id');
                $authority = DsAuthority::all()->pluck('title', 'id');
                $ownership = DsSchoolOwnership::all()->pluck('title', 'id');
                $water_source = DsWaterSource::all()->pluck('title', 'id');
                $electricity_source = DsElectricitySource::all()->pluck('title', 'id');
                $health_facilities = DsHealthFacilities::all()->pluck('title', 'id');
                $facilities = DsFacility::all()->pluck('title', 'id');
                $play_rooms = DsPlayRoom::all()->pluck('title', 'id');
                $play_facilities = DsPlayFacility::all()->pluck('title', 'id');
                $learning_materials = DsLearningMaterial::all()->pluck('title', 'id');
                $shared_facilities = Auth::User()->school->load('sharedFacilities');
                $school_learning_materials = SchoolLearningMaterial::where('school_id', Auth::User()->school_id)->pluck('ds_learning_material_id');
                $school_play_facilities = SchoolPlayFacility::where('school_id', Auth::User()->school_id)->pluck('ds_play_facility_id');
                $school_shared_facilities = SchoolSharedFacility::where('school_id', Auth::User()->school_id)->pluck('ds_facility_id');

                $data = $sch;
                $schoolData = Auth::User()->school;

                return view('admin.schools.background', compact('data', 'locations', 'school_type', 'yes_no', 'authority', 'ownership', 'water_source', 'electricity_source', 'health_facilities', 'schoolData', 'facilities', 'play_rooms', 'play_facilities', 'learning_materials', 'school_play_facilities', 'school_learning_materials', 'school_shared_facilities'));
            } else {
                $locations = DsSchoolLocation::all()->pluck('title', 'id');
                $school_type = DsSchoolType::all()->pluck('title', 'id');
                $yes_no = DsYesNo::all()->pluck('title', 'id');
                $authority = DsAuthority::all()->pluck('title', 'id');
                $ownership = DsSchoolOwnership::all()->pluck('title', 'id');
                $water_source = DsWaterSource::all()->pluck('title', 'id');
                $electricity_source = DsElectricitySource::all()->pluck('title', 'id');
                $health_facilities = DsHealthFacilities::all()->pluck('title', 'id');
                $facilities = DsFacility::all()->pluck('ds_facility_title', 'id');
                $play_rooms = DsPlayRoom::all()->pluck('ds_play_room_title', 'id');
                $play_facilities = DsPlayFacility::all()->pluck('ds_play_facility_title', 'id');
                $learning_materials = DsLearningMaterial::all()->pluck('ds_learning_material_title', 'id');
                $school_learning_materials = SchoolLearningMaterial::where('school_id', Auth::User()->school_id)->pluck('ds_learning_material_id');
                $school_play_facilities = SchoolPlayFacility::where('school_id', Auth::User()->school_id)->pluck('ds_play_facility_id');
                $school_shared_facilities = SchoolSharedFacility::where('school_id', Auth::User()->school_id)->pluck('ds_facility_id');
                // dd($school_shared_facilities[0]);

                $data = $find;
                $schoolData = Auth::User()->school;

                return view('admin.schools.background', compact('data', 'locations', 'school_type', 'yes_no', 'authority', 'ownership', 'water_source', 'electricity_source', 'health_facilities', 'schoolData', 'facilities', 'play_rooms', 'play_facilities', 'learning_materials', 'school_play_facilities', 'school_learning_materials', 'school_shared_facilities'));
            }
        } else {
            abort(404);
        }
    }

    public function storeBackground(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $data = SchoolBackground::where('school_id', Auth::User()->school_id)->first();
            $data->update($request->all());

            $school_shared_facilities = SchoolSharedFacility::where('school_id', Auth::User()->school_id)->get();

            if ($school_shared_facilities->isEmpty()) {
                if ($request->school_shared_facilities != null) {
                    foreach ($request->school_shared_facilities as $facility) {
                        $facilityData = new SchoolSharedFacility;
                        $facilityData->school_id = Auth::User()->school_id;
                        $facilityData->ds_facility_id = $facility;
                        // dd($facilityData);
                        $facilityData->save();
                    }
                }
            } else {
                foreach ($school_shared_facilities as $facility) {
                    SchoolSharedFacility::where('school_id', Auth::User()->school_id)->delete();
                }
                if ($request->school_shared_facilities != null) {
                   foreach ($request->school_shared_facilities as $facility) {
                        $facilityData = new SchoolSharedFacility;
                        $facilityData->school_id = Auth::User()->school_id;
                        $facilityData->ds_facility_id = $facility;
                        $facilityData->save();
                    }
                }
            }

            $eccd_play_facilities = SchoolPlayFacility::where('school_id', Auth::User()->school_id)->get();
            
            if ($eccd_play_facilities->isEmpty()) {
                if ($request->school_shared_facilities != null) {
                    foreach ($request->eccd_play_facilities as $facility) {
                        $facilityData = new SchoolPlayFacility;
                        $facilityData->school_id = Auth::User()->school_id;
                        $facilityData->ds_play_facility_id = $facility;
                        // dd($facilityData);
                        $facilityData->save();
                    }
                }
            } else {
                foreach ($eccd_play_facilities as $facility) {
                    SchoolPlayFacility::where('school_id', Auth::User()->school_id)->delete();
                }
                if ($request->eccd_play_facilities != null) {
                   foreach ($request->eccd_play_facilities as $facility) {
                        $facilityData = new SchoolPlayFacility;
                        $facilityData->school_id = Auth::User()->school_id;
                        $facilityData->ds_play_facility_id = $facility;
                        $facilityData->save();
                    }
                }
            }

            $eccd_learning_materials = SchoolLearningMaterial::where('school_id', Auth::User()->school_id)->get();
            
            if ($eccd_learning_materials->isEmpty()) {
                if ($request->school_shared_facilities != null) {
                    foreach ($request->eccd_learning_materials as $facility) {
                        $facilityData = new SchoolLearningMaterial;
                        $facilityData->school_id = Auth::User()->school_id;
                        $facilityData->ds_learning_material_id = $facility;
                        // dd($facilityData);
                        $facilityData->save();
                    }
                }
            } else {
                foreach ($eccd_learning_materials as $facility) {
                    SchoolLearningMaterial::where('school_id', Auth::User()->school_id)->delete();
                }
                if ($request->eccd_learning_materials != null) {
                   foreach ($request->eccd_learning_materials as $facility) {
                        $facilityData = new SchoolLearningMaterial;
                        $facilityData->school_id = Auth::User()->school_id;
                        $facilityData->ds_learning_material_id = $facility;
                        $facilityData->save();
                    }
                }
            }

            // dd($request->school_shared_facilities);
            // dd($request->eccd_play_facilities);
            // dd($request->eccd_learning_materials);

            $schoolData = Auth::User()->school;
            $schoolData->latitude_north = $request->latitude_north;
            $schoolData->longitude_east = $request->longitude_east;
            $schoolData->number_and_street = $request->number_and_street;
            $schoolData->school_community = $request->school_community;
            $schoolData->village_town = $request->village_town;
            $schoolData->email_address = $request->email_address;
            $schoolData->school_telephone = $request->school_telephone;
            $schoolData->ward = $request->ward;
            $schoolData->update();
            // dd($schoolData);

            DB::commit();
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            session()->flash('error', 'Operation Failed');
            return redirect()->back();
        }
        

        session()->flash('message', 'School background updated successful');
        return redirect()->back();
    }

    public function edit(School $school)
    {
        abort_if(Gate::denies('school_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sectors = DsSector::all()->pluck('title', 'id');

        return view('admin.schools.edit', compact('school', 'sectors'));
    }

    public function update(UpdateSchoolRequest $request, School $school)
    {
        // $School->update($request->all());

        $data = School::find($school->id);
        $data->name = $request->name;
        $data->pseudo_code = $request->pseudo_code;
        $data->nemis_code = $request->nemis_code;
        $data->number_and_street = $request->number_and_street;
        $data->school_community = $request->school_community;
        $data->village_town = $request->village_town;
        $data->email_address = $request->email_address;
        $data->school_telephone = $request->school_telephone;
        $data->code_type_sector = $request->code_type_sector;
        $data->latitude_north = $request->latitude_north;
        $data->longitude_east = $request->longitude_east;
        $data->ward = $request->ward;
        $data->nearby_name_school = $request->nearby_name_school;
        $data->update();

        return redirect()->route('admin.schools.index');
    }

    public function show(School $school)
    {
        abort_if(Gate::denies('school_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        

        return view('admin.schools.show', compact('school'));
    }

    public function destroy(School $school)
    {
        abort_if(Gate::denies('school_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $School->delete();

        return back();
    }

    public function massDestroy(MassDestroySchoolRequest $request)
    {
        School::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
