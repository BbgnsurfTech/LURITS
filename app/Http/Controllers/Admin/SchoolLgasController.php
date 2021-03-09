<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\School;
Use App\Atlas;
Use App\AtlasLink;
use App\DsClass;
Use App\SchoolAtlas;
use App\StudentAdmission;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Teacher;
use App\DsSubject;
use Yajra\DataTables\Facades\DataTables;
use App\DsSector;
use Gate;

class SchoolLgasController extends Controller
{
    
    public function index()
    {
        return view('admin.lga.index');
    }

    public function fetchSectors()
    {
        $sectors = DsSector::select('id', 'title')->get();
        return json_encode($sectors);
    }

    public function fetchStudent($classs)
    {
        $data = StudentAdmission::where('class_id', $classs)->get();
        return json_encode($data);
    }

    public function fetchClasss($classs)
    {
        //$schoolClass = School::where('school_id', $classs)->pluck('id');
        // $lga = Classroom::where('school_id', $classs)->pluck('class', 'id')->prepend(trans('global.pleaseSelect'), '0');
        $classs = DsClass::select('id', 'title')->get();
        return json_encode($classs);
    }

    public function fetchLgas($state)
    {
        $stateLGA = AtlasLink::where('code_atlas_link', $state)->pluck('code_atlas_entity');
        $lga = Atlas::whereIn('code_atlas_entity', $stateLGA)->pluck('name_atlas_entity', 'code_atlas_entity');
        return json_encode($lga);
    }

    public function fetchZones($zone)
    {
        $stateLGA = AtlasLink::where('code_atlas_link', $zone)->pluck('code_atlas_entity');
        $lga = Atlas::whereIn('code_atlas_entity', $stateLGA)->pluck('name_atlas_entity', 'code_atlas_entity')->prepend(trans('global.pleaseSelect'), '0');
        return json_encode($lga);
    }

    public function fetchStates($country)
    {
        $countryState = AtlasLink::where('code_atlas_link', $country)->pluck('code_atlas_entity');
        $state = Atlas::whereIn('code_atlas_entity', $countryState)->pluck('name_atlas_entity','code_atlas_entity')->prepend(trans('global.pleaseSelect'), '0');
        //dd($state);
        return json_encode($state);
        
    }
    public function fetchSchools(Request $request)
    {
        
        //$allSchools = School::pluck('name','id');
        $schoolLGA = SchoolAtlas::where('code_atlas_entity', $request->lga)->pluck('school_id');
        $finalschools = School::whereIn('id', $schoolLGA)->where('code_type_sector', $request->sector)->pluck('name','id')->prepend(trans('global.pleaseSelect'), '0');
        
        //dd($schools);
        return json_encode($finalschools);
        
    }

    public function getSchools(Request $request)
    {
        abort_if(Gate::denies('school_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $schoolLGA = SchoolAtlas::where('code_atlas_entity', $request->lga)->pluck('school_id');
            $query = School::whereIn('id', $schoolLGA)->where('code_type_sector', $request->sector)->select(sprintf('%s.*', (new School)->table));
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

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
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
    }

    public function fetchData($school)
    {
        
        
        $teacherData = Teacher::select('id', 'date_of_birth', 'first_name', 'last_name', 'phone_number')->where('school_id', $school)->get();
        
        //dd($schools);
        return json_encode($teacherData);
        
    }
}
