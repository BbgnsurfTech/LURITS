<?php

namespace App\Http\Controllers\Admin\Staff;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff\Staff;
use App\Models\ClassSchedule;
use App\Models\ClassRoom;
use App\Models\Subject;
use App\Models\SchoolCategory;
use App\Models\Department;
use App\Services\TimeTableService;
use Carbon\Carbon;
use Redirect;
use Response;
use DataTables;




class ReportController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            
        }
        return view('admin.report.pages.managestaff', compact('staff'));
    }
 
    
    /**
     * Display Time Table.
     *
     */
    public function timetable(TimeTableService $timeTableService, Request $request){
        $timetable = array();

        if ($request->ajax()) {
            $week_days     = ClassSchedule::WEEK_DAYS;
            $time_table_data = $timeTableService->generateTimeTableData($week_days);
            $view = view('admin.pages.reports.load_timetable_data', compact('week_days', 'time_table_data'))->render();
            return Response::json(['html' => $view]);
        }

        return view('admin.pages.reports.timetable');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  /*  public function staff(Request $request)
    {
        $staff = Staff::latest()->get();
        $employees = array();

        if (request()->ajax()) {
            
            $staff = Staff::where("staff.school_id", $request->school_id)->get();

                return Datatables::of($staff)
                    ->addIndexColumn()
                    ->addColumn('photo', function ($row){
                        $logo = '<img src="../uploads/staff/'.$row->photo.'" class="img-thumbnail" width="50" height="35" />';
                         return $logo;
                    })
                    ->addColumn('name', function($row){
                        return Staff::find($row->id)->full_name?Staff::find($row->id)->full_name:"";
                    })                   
                    ->addColumn('state', function($row){
                        return Staff::find($row->id)->lga->state->name?Staff::find($row->id)->lga->state->name:"";
                    })                    
                    ->addColumn('lga', function($row){
                        return Staff::find($row->id)->lga->name?Staff::find($row->id)->lga->name:"";
                    })                     
                    ->addColumn('zeqa', function($row){
                        return Staff::find($row->id)->school->zone_lga->zone->name?Staff::find($row->id)->school->zone_lga->zone->name:"";
                    })                     
                    ->addColumn('slga', function($row){
                        return Staff::find($row->id)->school->zone_lga->lga->name?Staff::find($row->id)->school->zone_lga->lga->name:"";
                    })                     
                    ->addColumn('school', function($row){
                        return Staff::find($row->id)->school->name?Staff::find($row->id)->school->name:"";
                    }) 
                    ->rawColumns(['photo', 'name', 'state', 'lga', 'zeqa', 'slga', 'school'])
                    ->make(true);
                    //dd('salaam');
                   // return view('staff.pages.reports.load_staffreport_data', compact('staff'))->render();       

            }
            //dd($staff);
            //return view('staff.pages.managestaff', compact('staff'));
            return view('staff.pages.reports.staffreport', compact('staff'));


    }*/

    public function staff(Request $request){
        //dd($request);
        $staff = array();
        
        if (request()->ajax()) {
            //dd($request);
        $schoolid = $request->school_id;

        $arropts = [
         ];
        if ($schoolid != '%') {
            $arropts[] = ["staffs.school_id", "=", $schoolid];
        }

        $query = DB::table("staffs")
        ->leftJoin("schools", "staffs.school_id", "=", "schools.id");
        // ->join("lgas", "staff.lga_id", "=", "lgas.id")
        // ->leftJoin("states", "lgas.state_id", "=", "states.id")
        // ->leftJoin("schools", "staff.school_id", "=", "schools.id")
        // ->leftJoin("zone_lgas", "schools.zone_lga_id", "=", "zone_lgas.id")        
        // ->leftJoin("lgas as slga", "zone_lgas.lga_id", "=", "slga.id")        
        // ->leftJoin("zones", "zone_lgas.zone_id", "=", "zones.id");

        $columnsquery = $query->select(["staffs.id as id", 
            "staffs.first_name as firstname",
            "staffs.middle_name as middlename",
            "staffs.last_name as othername",
            "staffs.email as email",
            "staffs.phone_number as gsm",
            "schools.name as school"]);
        $columnsquery = $columnsquery->where($arropts);
        $columnsquery = $columnsquery->orderBy("staffs.first_name");
        $staff = $columnsquery->get();
          //dd($employees);
          return view('admin.pages.reports.load_staffreport_data', compact('staff'))->render();       
       }
       return view('admin.pages.reports.staffreport', compact('staff'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
