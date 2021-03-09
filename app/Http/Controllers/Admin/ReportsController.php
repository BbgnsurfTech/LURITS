<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DsClass;
use App\Atlas;
use App\AtlasLink;
use App\SchoolAtlas;
use App\StudentAdmission;
use App\SchoolClass;
use App\Classroom;
use App\Toilet;
use DB;
use App\DsSector;
use App\School;
use App\SchoolBackground;
use Auth;
use Carbon\Carbon;
use App\Staff;
use App\DsTypeStaff;
use App\DsAcademicQualification;
use App\DsTeachingQualification;
use App\DsTypeStaffSector;

class ReportsController extends Controller
{
    public function index()
    {   
        return view('admin.reports.index');
    }


    public function generate(Request $request)
    {
        // dd($request->all());
        //GENERAL VARIABLES
        $country = $request->country;
        $state = $request->state;
        $zone = $request->zone;
        $lga = $request->lga;
        $sector = $request->school_sector;
        $school = $request->school;
        $report = $request->report;

        if ($school > '0'  && $report == 'school1') {
            return ("not available");
        } else {
            //GENERAL VARIABLES
            $countryReport = false;
            $stateReport = false;
            $zoneReport = false;
            $lgaReport = false;
            $sectorReport = false;
            $schoolReport = false;
            $zoneName = Atlas::where('code_atlas_entity', $zone)->pluck('name_atlas_entity')->first();
            $lgaName = Atlas::where('code_atlas_entity', $lga)->pluck('name_atlas_entity')->first();
            $sectorName = DsSector::where('id', $sector)->pluck('title')->first();
            $schoolName = School::where('id', $school)->with(['background.schoolType','background.schoolLocation'])->first();
            

            if ($lga == null && $sector == null && $school <= '0') {
                // return("country report", "state report" &"zone report" );
                $countryReport = true;
                $stateReport = true;
                $zoneReport = true;
            } elseif ($sector == null && $school <= '0') {
                // return("lga report");
                $lgaReport = true;
            } elseif ($school <= "0") {
                // return("sector report");
                $sectorReport = true;
            } elseif ($school > '0') {
                // return("school report");
                $schoolReport = true;
            }


            ////////////////////////////////////////////////////ZONE REPORT
            if ($zoneReport & $stateReport) {
                //Number of Schools
                if ($report == 'school1') {
                    //Get schools under the zone
                    if ($zone){
                        $lgas =  AtlasLink::where('code_atlas_link', $zone)->pluck('code_atlas_entity');
                    } else {
                      $lgas =  AtlasLink::where('code_atlas_link', $state)->pluck('code_atlas_entity');  
                    }
                    // $lgas =  AtlasLink::where('code_atlas_link', $state)->pluck('code_atlas_entity');
                    $lgaName = Atlas::whereIn('code_atlas_entity', $lgas)->pluck('name_atlas_entity');
                    $schoolLGAS = SchoolAtlas::whereIn('code_atlas_entity', $lgas)->pluck('school_id');
                    $schoolSector = School::whereIn('id', $schoolLGAS)
                    ->select('id', 'code_type_sector')
                    ->with('atlas.atlas')
                    ->get();
                    $sectors = DsSector::all();
                    // dd($lgas);

                    return view('admin.reports.report-page', compact('zoneReport', 'lgaReport', 'sectorReport', 'schoolReport', 'report', 'sectors', 'zoneName', 'lgaName', 'schoolLGAS', 'schoolSector'));
                }
                //Enrolment by class report
                if ($report == 'enrolment1') {
                    //Get schools under the zone
                     if ($zone){
                        $lgas =  AtlasLink::where('code_atlas_link', $zone)->pluck('code_atlas_entity');
                    } else {
                      $lgas =  AtlasLink::where('code_atlas_link', $state)->pluck('code_atlas_entity');  
                    }
                    $lgaName = Atlas::whereIn('code_atlas_entity', $lgas)->pluck('name_atlas_entity');
                   // dd($lgaName);
                    $schoolLGAS = SchoolAtlas::whereIn('code_atlas_entity', $lgas)->pluck('school_id');
                    //Get classes names
                    $student_class = StudentAdmission::whereIn('school_enrolled_id', $schoolLGAS)->pluck('class_id');
                    $classes = DsClass::all();
                    //Get students of these schools
                    $total = StudentAdmission::whereIn('school_enrolled_id', $schoolLGAS)
                    ->join('school_atlas_entity', 'student_admissions.school_enrolled_id', '=', 'school_atlas_entity.school_id')
                    ->join('atlas_entity', 'school_atlas_entity.code_atlas_entity', '=', 'atlas_entity.code_atlas_entity')
                    ->select('gender_id', 'class_id', 'name_atlas_entity')
                    ->with(["classs.classTitle"])
                    ->get();
                    //dd($total);

                    return view('admin.reports.report-page', compact('zoneReport', 'lgaReport', 'sectorReport', 'schoolReport', 'report', 'classes', 'zoneName', 'total', 'student_class', 'lgaName'));
                }
                // Enrolment by age report
                if ($report == 'enrolment2') {
                    //Get schools under the zone
                     if ($zone){
                        $lgas =  AtlasLink::where('code_atlas_link', $zone)->pluck('code_atlas_entity');
                    } else {
                      $lgas =  AtlasLink::where('code_atlas_link', $state)->pluck('code_atlas_entity');  
                    }
                    $lgaName = Atlas::whereIn('code_atlas_entity', $lgas)->pluck('name_atlas_entity');
                    $schoolLGAS = SchoolAtlas::whereIn('code_atlas_entity', $lgas)->pluck('school_id');
                    //Get students of these schools
                    $total = StudentAdmission::whereIn('school_enrolled_id', $schoolLGAS)
                    ->join('school_atlas_entity', 'student_admissions.school_enrolled_id', '=', 'school_atlas_entity.school_id')
                    ->join('atlas_entity', 'school_atlas_entity.code_atlas_entity', '=', 'atlas_entity.code_atlas_entity')
                    ->select('gender_id', 'class_id', 'name_atlas_entity', 'date_of_birth')
                    ->with(["classs.classTitle"])
                    ->get();

                    $now = Carbon::now()->format('Y-m-d');
                    $bSix = Carbon::now()->subYears(6)->subDays(-1)->format('Y-m-d');
                    $six = Carbon::now()->subYears(7)->format('Y-m-d');
                    $seven = Carbon::now()->subYears(8)->format('Y-m-d');
                    $eight = Carbon::now()->subYears(9)->format('Y-m-d');
                    $nine = Carbon::now()->subYears(10)->format('Y-m-d');
                    $ten = Carbon::now()->subYears(11)->format('Y-m-d');
                    $eleven = Carbon::now()->subYears(12)->format('Y-m-d');
                    $aEleven = Carbon::now()->subYears(30)->subDays(1)->format('Y-m-d');
                    $max = Carbon::now()->subYears(13)->subDays(-1)->format('Y-m-d');

                    $bSixYears = $total->whereBetween('date_of_birth', [$bSix, $now]);
                    $sixYears = $total->whereBetween('date_of_birth', [$six, $bSix]);
                    $sevenYears = $total->whereBetween('date_of_birth', [$seven, $six]);
                    $eightYears = $total->whereBetween('date_of_birth', [$eight, $seven]);
                    $nineYears = $total->whereBetween('date_of_birth', [$nine, $eight]);
                    $tenYears = $total->whereBetween('date_of_birth', [$ten, $nine]);
                    $elevenYears = $total->whereBetween('date_of_birth', [$eleven, $ten]);
                    $aElevenYears = $total->whereBetween('date_of_birth', [$aEleven, $max]);

                    $ages = ['Below 6 Years', '6 Years', '7 Years', '8 Years', '9 Years', '10 Years', '11 Years', 'Above 11 Years'];
                    return view('admin.reports.report-page', compact('lgaName','zoneReport', 'lgaReport', 'sectorReport', 'schoolReport', 'report', 'zoneName', 'total', 'bSixYears', 'sixYears', 'sevenYears', 'eightYears', 'nineYears', 'tenYears', 'elevenYears', 'aElevenYears', 'ages'));
                }

                if ($report == 'disabilities') {
                    //Get schools under the zone
                    if ($zone){
                        $lgas =  AtlasLink::where('code_atlas_link', $zone)->pluck('code_atlas_entity');
                    } else {
                      $lgas =  AtlasLink::where('code_atlas_link', $state)->pluck('code_atlas_entity');  
                    }
                    $lgaName = Atlas::whereIn('code_atlas_entity', $lgas)->pluck('name_atlas_entity');
                   // dd($lgaName);
                    $schoolLGAS = SchoolAtlas::whereIn('code_atlas_entity', $lgas)->pluck('school_id');
                    //Get classes names
                    $student_class = StudentAdmission::whereIn('school_enrolled_id', $schoolLGAS)->pluck('class_id');
                    $classes = DsClass::all();
                    //Get students of these schools
                    $total = StudentAdmission::whereIn('school_enrolled_id', $schoolLGAS)
                    ->join('school_atlas_entity', 'student_admissions.school_enrolled_id', '=', 'school_atlas_entity.school_id')
                    ->join('atlas_entity', 'school_atlas_entity.code_atlas_entity', '=', 'atlas_entity.code_atlas_entity')
                    ->select('gender_id', 'class_id', 'name_atlas_entity', 'disability')
                    ->with(["classs.classTitle"])
                    ->get();
                    
                    // dd($total->where('disability', 1)->where('gender_id', 2)->count());

                    return view('admin.reports.report-page', compact('zoneReport', 'lgaReport', 'sectorReport', 'schoolReport', 'report', 'classes', 'zoneName', 'total', 'student_class', 'lgaName'));
                }

                if ($report == 'staff1'  || $report ==  'staff2' || $report ==  'staff3') {
                    //Get schools under the zone
                     if ($zone){
                        $lgas =  AtlasLink::where('code_atlas_link', $zone)->pluck('code_atlas_entity');
                    } else {
                      $lgas =  AtlasLink::where('code_atlas_link', $state)->pluck('code_atlas_entity');  
                    }
                    $lgaName = Atlas::whereIn('code_atlas_entity', $lgas)->pluck('name_atlas_entity');
                    // dd($lgaName);
                    $schoolLGAS = SchoolAtlas::whereIn('code_atlas_entity', $lgas)->pluck('school_id');
                    //Get staffs of these schools
                    if ($report == 'staff1') {
                        $parameters = DsTypeStaff::all();
                        $total = Staff::whereIn('school_id', $schoolLGAS)
                        ->with(["type_staff", "school.lga.atlas"])
                        ->select('gender_id', 'type_staff_id', 'school_id')
                        ->get();
                        // dd($total);
                    } elseif ($report == 'staff2') {
                        $parameters = DsAcademicQualification::all();
                        $total = Staff::whereIn('school_id', $schoolLGAS)
                        ->with(["academic_qualification", "school.lga.atlas"])
                        ->select('gender_id', 'academic_qualification_id', 'school_id')
                        ->get();
                        // dd($total);
                    } elseif ($report == 'staff3') {
                        $parameters = DsTeachingQualification::all();
                        $total = Staff::whereIn('school_id', $schoolLGAS)
                        ->with(["teaching_qualification", "school.lga.atlas"])
                        ->select('gender_id', 'teaching_qualification_id', 'school_id')
                        ->get();
                        // dd($total);
                    }
                    

                    return view('admin.reports.report-page', compact('zoneReport', 'lgaReport', 'sectorReport', 'schoolReport', 'report', 'zoneName', 'total', 'lgaName', 'parameters'));
                }
            }
            ////////////////////////////////////////////////////LGA REPORT
            if ($lgaReport) {
                //Number of Schools
                if ($report == 'school1') {
                    $schoolLGAS = SchoolAtlas::where('code_atlas_entity', $lga)->pluck('school_id');
                    $schoolSector = School::whereIn('id', $schoolLGAS)
                    ->select('id', 'code_type_sector')
                    ->get();
                    $sectors = DsSector::all();
                    // dd($schoolSector[0]);

                    return view('admin.reports.report-page', compact('zoneReport', 'lgaReport', 'sectorReport', 'schoolReport', 'report', 'sectors', 'zoneName', 'schoolLGAS', 'schoolSector', 'lgaName'));
                }

                //Enrolment by class Report
                if ($report == 'enrolment1') {
                    //Enrolment Report
                    //Get schools under the lga
                    $schoolLGAS = SchoolAtlas::where('code_atlas_entity', $lga)->pluck('school_id');
                    //Get classes names
                    $student_class = StudentAdmission::whereIn('school_enrolled_id', $schoolLGAS)->pluck('class_id');
                    $classes = DsClass::all();
                    //Get students of these schools
                    $total = StudentAdmission::whereIn('school_enrolled_id', $schoolLGAS)
                    ->select('gender_id', 'class_id')
                    ->with(["classs.classTitle"])
                    ->get();

                    return view('admin.reports.report-page', compact('zoneReport', 'lgaReport', 'sectorReport', 'schoolReport', 'report', 'classes', 'zoneName', 'total', 'student_class', 'lgaName'));
                }
                //Enrolment by age report
                if ($report == 'enrolment2') {
                    //Get schools under the lga
                    $schoolLGAS = SchoolAtlas::where('code_atlas_entity', $lga)->pluck('school_id');
                    //Get classes names
                    $student_class = StudentAdmission::whereIn('school_enrolled_id', $schoolLGAS)->pluck('class_id');
                    $classes = DsClass::all();
                    //Get students of these schools
                    $total = StudentAdmission::whereIn('school_enrolled_id', $schoolLGAS)
                    ->join('school_atlas_entity', 'student_admissions.school_enrolled_id', '=', 'school_atlas_entity.school_id')
                    ->join('atlas_entity', 'school_atlas_entity.code_atlas_entity', '=', 'atlas_entity.code_atlas_entity')
                    ->select('gender_id', 'class_id', 'name_atlas_entity', 'date_of_birth')
                    ->with(["classs.classTitle"])
                    ->get();

                    $now = Carbon::now()->format('Y-m-d');
                    $bSix = Carbon::now()->subYears(6)->subDays(-1)->format('Y-m-d');
                    $six = Carbon::now()->subYears(7)->format('Y-m-d');
                    $seven = Carbon::now()->subYears(8)->format('Y-m-d');
                    $eight = Carbon::now()->subYears(9)->format('Y-m-d');
                    $nine = Carbon::now()->subYears(10)->format('Y-m-d');
                    $ten = Carbon::now()->subYears(11)->format('Y-m-d');
                    $eleven = Carbon::now()->subYears(12)->format('Y-m-d');
                    $aEleven = Carbon::now()->subYears(30)->subDays(1)->format('Y-m-d');
                    $max = Carbon::now()->subYears(13)->subDays(-1)->format('Y-m-d');

                    $bSixYears = $total->whereBetween('date_of_birth', [$bSix, $now]);
                    $sixYears = $total->whereBetween('date_of_birth', [$six, $bSix]);
                    $sevenYears = $total->whereBetween('date_of_birth', [$seven, $six]);
                    $eightYears = $total->whereBetween('date_of_birth', [$eight, $seven]);
                    $nineYears = $total->whereBetween('date_of_birth', [$nine, $eight]);
                    $tenYears = $total->whereBetween('date_of_birth', [$ten, $nine]);
                    $elevenYears = $total->whereBetween('date_of_birth', [$eleven, $ten]);
                    $aElevenYears = $total->whereBetween('date_of_birth', [$aEleven, $max]);


                    $ages = ['Below 6 Years', '6 Years', '7 Years', '8 Years', '9 Years', '10 Years', '11 Years', 'Above 11 Years'];
                    return view('admin.reports.report-page', compact('zoneReport', 'lgaReport', 'sectorReport', 'schoolReport', 'report', 'zoneName', 'total', 'bSixYears', 'sixYears', 'sevenYears', 'eightYears', 'nineYears', 'tenYears', 'elevenYears', 'aElevenYears', 'lgaName', 'ages'));
                }

                if ($report == 'staff1'  || $report ==  'staff2' || $report ==  'staff3') {
                    //Get schools under the lga
                    $schoolLGAS = SchoolAtlas::where('code_atlas_entity', $lga)->pluck('school_id');
                    //Get staffs of these schools
                    if ($report == 'staff1') {
                        $parameters = DsTypeStaff::all();
                        $total = Staff::whereIn('school_id', $schoolLGAS)
                        ->with(["school.lga.atlas"])
                        ->select('gender_id', 'type_staff_id', 'school_id')
                        ->get();
                    } elseif ($report == 'staff2') {
                        $parameters = DsAcademicQualification::all();
                        $total = Staff::whereIn('school_id', $schoolLGAS)
                        ->with(["school.lga.atlas"])
                        ->select('gender_id', 'academic_qualification_id', 'school_id')
                        ->get();
                    } elseif ($report == 'staff3') {
                        $parameters = DsTeachingQualification::all();
                        $total = Staff::whereIn('school_id', $schoolLGAS)
                        ->with(["school.lga.atlas"])
                        ->select('gender_id', 'teaching_qualification_id', 'school_id')
                        ->get();
                    }
                    

                    return view('admin.reports.report-page', compact('zoneReport', 'lgaReport', 'sectorReport', 'schoolReport', 'report', 'zoneName', 'total', 'lgaName', 'parameters'));
                }
            }
            ////////////////////////////////////////////////////SECTOR REPORT
            if ($sectorReport) {
                //Number of Schools
                if ($report == 'school1') {
                    $schoolLGAS = SchoolAtlas::where('code_atlas_entity', $lga)->pluck('school_id');
                    $schoolSector = School::whereIn('id', $schoolLGAS)
                    ->where('code_type_sector', $sector)
                    ->count();
                    // dd($schoolSector[0]);

                    return view('admin.reports.report-page', compact('zoneReport', 'lgaReport', 'sectorReport', 'schoolReport', 'report', 'zoneName', 'schoolLGAS', 'schoolSector', 'lgaName', 'sectorName'));
                }
                //Enrolment by class Report
                if ($report == 'enrolment1') {
                    //Enrolment Report
                    //Get schools under the sector
                    $schoolLGAS = SchoolAtlas::where('code_atlas_entity', $lga)->pluck('school_id');
                    $schoolSector = School::whereIn('id', $schoolLGAS)->where('code_type_sector', $sector)->pluck('id');
                    //Get classes names
                    $student_class = StudentAdmission::whereIn('school_enrolled_id', $schoolSector)->pluck('class_id');
                    $classes = DB::table('ds_class')
                    ->join('ds_class_sector', 'ds_class.id', '=', 'ds_class_sector.class_id')
                    ->where('ds_class_sector.sector_id', $sector)
                    ->select('ds_class.title', 'id')
                    ->get();
                    //Get students of these schools
                    $total = StudentAdmission::whereIn('school_enrolled_id', $schoolSector)
                    ->select('gender_id', 'class_id')
                    ->with(["classs.classTitle"])
                    ->get();
                    //dd($classes);

                    return view('admin.reports.report-page', compact('zoneReport', 'lgaReport', 'sectorReport', 'schoolReport', 'report', 'classes', 'zoneName', 'total', 'student_class', 'lgaName', 'sectorName'));
                }

                if ($report == 'enrolment2') {
                    //Get schools under the sector
                    $schoolLGAS = SchoolAtlas::where('code_atlas_entity', $lga)->pluck('school_id');
                    $schoolSector = School::whereIn('id', $schoolLGAS)->where('code_type_sector', $sector)->pluck('id');
                    //Get classes names
                    $student_class = StudentAdmission::whereIn('school_enrolled_id', $schoolSector)->pluck('class_id');
                    $classes = DsClass::all();
                    //Get students of these schools
                    $total = StudentAdmission::whereIn('school_enrolled_id', $schoolSector)
                    ->select('gender_id', 'date_of_birth')
                    ->get();

                    $now = Carbon::now()->format('Y-m-d');
                    $bSix = Carbon::now()->subYears(6)->subDays(-1)->format('Y-m-d');
                    $six = Carbon::now()->subYears(7)->format('Y-m-d');
                    $seven = Carbon::now()->subYears(8)->format('Y-m-d');
                    $eight = Carbon::now()->subYears(9)->format('Y-m-d');
                    $nine = Carbon::now()->subYears(10)->format('Y-m-d');
                    $ten = Carbon::now()->subYears(11)->format('Y-m-d');
                    $eleven = Carbon::now()->subYears(12)->format('Y-m-d');
                    $aEleven = Carbon::now()->subYears(30)->subDays(1)->format('Y-m-d');
                    $max = Carbon::now()->subYears(13)->subDays(-1)->format('Y-m-d');

                    $bSixYears = $total->whereBetween('date_of_birth', [$bSix, $now]);
                    $sixYears = $total->whereBetween('date_of_birth', [$six, $bSix]);
                    $sevenYears = $total->whereBetween('date_of_birth', [$seven, $six]);
                    $eightYears = $total->whereBetween('date_of_birth', [$eight, $seven]);
                    $nineYears = $total->whereBetween('date_of_birth', [$nine, $eight]);
                    $tenYears = $total->whereBetween('date_of_birth', [$ten, $nine]);
                    $elevenYears = $total->whereBetween('date_of_birth', [$eleven, $ten]);
                    $aElevenYears = $total->whereBetween('date_of_birth', [$aEleven, $max]);

                    $ages = ['Below 6 Years', '6 Years', '7 Years', '8 Years', '9 Years', '10 Years', '11 Years', 'Above 11 Years'];
                    return view('admin.reports.report-page', compact('zoneReport', 'lgaReport', 'sectorReport', 'schoolReport', 'report', 'zoneName', 'total', 'bSixYears', 'sixYears', 'sevenYears', 'eightYears', 'nineYears', 'tenYears', 'elevenYears', 'aElevenYears', 'lgaName', 'sectorName', 'ages'));
                }

                if ($report == 'staff1'  || $report ==  'staff2' || $report ==  'staff3') {
                    //Get schools under the lga & sector
                    $schoolLGAS = SchoolAtlas::where('code_atlas_entity', $lga)->pluck('school_id');
                    $schoolSector = School::whereIn('id', $schoolLGAS)->where('code_type_sector', $sector)->pluck('id');
                    //Get staffs of these schools
                    if ($report == 'staff1') {
                        $parameters = DsTypeStaff::all();
                        $total = Staff::whereIn('school_id', $schoolSector)
                        ->select('gender_id', 'type_staff_id', 'school_id')
                        ->get();

                    } elseif ($report == 'staff2') {
                        $parameters = DsAcademicQualification::all();
                        $total = Staff::whereIn('school_id', $schoolSector)
                        ->select('gender_id', 'academic_qualification_id', 'school_id')
                        ->get();
                    } elseif ($report == 'staff3') {
                        $parameters = DsTeachingQualification::all();
                        $total = Staff::whereIn('school_id', $schoolSector)
                        ->select('gender_id', 'teaching_qualification_id', 'school_id')
                        ->get();
                    }


                    return view('admin.reports.report-page', compact('zoneReport', 'lgaReport', 'sectorReport', 'schoolReport', 'report', 'zoneName', 'total', 'lgaName', 'parameters', 'sectorName'));
                }
                if ($report == 'teacher_deployment_index') {
                    //Get schools under the lga & sector
                    $schoolLGAS = SchoolAtlas::where('code_atlas_entity', $lga)->pluck('school_id');
                    $schoolCodeSector = School::whereIn('id', $schoolLGAS)->where('code_type_sector', $sector)->pluck('id');
                    $schoolSector = School::whereIn('id', $schoolLGAS)->where('code_type_sector', $sector)->get();
                    //Get students of these schools
                    $students = StudentAdmission::whereIn('school_enrolled_id', $schoolCodeSector)
                    ->select('gender_id','school_enrolled_id')
                    ->get();
                    //Get teachers of these schools
                    $teachers = Staff::whereIn('school_id', $schoolCodeSector)
                        ->select('gender_id', 'teaching_qualification_id', 'school_id')
                        ->whereIn('type_staff_id', [1,2,3,4,7,8])
                        ->get();
                    return view('admin.reports.report-page', compact('zoneReport', 'lgaReport', 'sectorReport', 'schoolReport', 'report', 'zoneName', 'lgaName','schoolLGAS', 'sectorName', 'students','teachers', 'schoolSector'));
                }
                
            }
            ////////////////////////////////////////////////////SCHOOL REPORT
            if ($schoolReport) {
                //Enrolment by class Report
                if ($report == 'enrolment1') {
                   //Enrolment Report
                    //Get classes names
                    $student_class = StudentAdmission::where('school_enrolled_id', $school)->pluck('class_id');
                    $classes = DB::table('ds_class')
                    ->join('ds_class_sector', 'ds_class.id', '=', 'ds_class_sector.class_id')
                    ->where('ds_class_sector.sector_id', $sector)
                    ->select('ds_class.title', 'id')
                    ->get();
                    //Get students of these schools
                    $total = StudentAdmission::where('school_enrolled_id', $school)
                    ->select('gender_id', 'class_id')
                    ->with(["classs.classTitle"])
                    ->get();

                    return view('admin.reports.report-page', compact('zoneReport', 'lgaReport', 'sectorReport', 'schoolReport', 'report', 'classes', 'zoneName', 'total', 'student_class', 'lgaName', 'sectorName', 'schoolName'));
                }
                
                if ($report == 'enrolment2') {
                    //Get classes names
                    $student_class = StudentAdmission::where('school_enrolled_id', $school)->pluck('class_id');
                    $school_class = SchoolClass::whereIn('id', $student_class)->pluck('ds_class_id');
                    $classes = DsClass::all();
                    //Get students of these schools
                    $total = StudentAdmission::where('school_enrolled_id', $school)
                    ->select('gender_id', 'date_of_birth')
                    ->get();

                    $now = Carbon::now()->format('Y-m-d');
                    $bSix = Carbon::now()->subYears(6)->subDays(-1)->format('Y-m-d');
                    $six = Carbon::now()->subYears(7)->format('Y-m-d');
                    $seven = Carbon::now()->subYears(8)->format('Y-m-d');
                    $eight = Carbon::now()->subYears(9)->format('Y-m-d');
                    $nine = Carbon::now()->subYears(10)->format('Y-m-d');
                    $ten = Carbon::now()->subYears(11)->format('Y-m-d');
                    $eleven = Carbon::now()->subYears(12)->format('Y-m-d');
                    $aEleven = Carbon::now()->subYears(30)->subDays(1)->format('Y-m-d');
                    $max = Carbon::now()->subYears(13)->subDays(-1)->format('Y-m-d');

                    $bSixYears = $total->whereBetween('date_of_birth', [$bSix, $now]);
                    $sixYears = $total->whereBetween('date_of_birth', [$six, $bSix]);
                    $sevenYears = $total->whereBetween('date_of_birth', [$seven, $six]);
                    $eightYears = $total->whereBetween('date_of_birth', [$eight, $seven]);
                    $nineYears = $total->whereBetween('date_of_birth', [$nine, $eight]);
                    $tenYears = $total->whereBetween('date_of_birth', [$ten, $nine]);
                    $elevenYears = $total->whereBetween('date_of_birth', [$eleven, $ten]);
                    $aElevenYears = $total->whereBetween('date_of_birth', [$aEleven, $max]);

                    $ages = ['Below 6 Years', '6 Years', '7 Years', '8 Years', '9 Years', '10 Years', '11 Years', 'Above 11 Years'];
                    return view('admin.reports.report-page', compact('zoneReport', 'lgaReport', 'sectorReport', 'schoolReport', 'report', 'zoneName', 'total', 'bSixYears', 'sixYears', 'sevenYears', 'eightYears', 'nineYears', 'tenYears', 'elevenYears', 'aElevenYears', 'lgaName', 'sectorName', 'schoolName', 'ages'));
                }

                if ($report == 'staff1'  || $report ==  'staff2' || $report ==  'staff3') {
                    //Get staffs of these schools
                    if ($report == 'staff1') {
                        $a = School::where('id', $school)->pluck('code_type_sector');
                        $b = DsTypeStaffSector::where('sector_id', $a)->pluck('type_staff_id');
                        $parameters = DsTypeStaff::whereIn('id', $b)->get();
                        // $parameters = DsTypeStaff::all();
                        // dd($parameters);
                        $total = Staff::where('school_id', $school)
                        ->select('gender_id', 'type_staff_id', 'school_id')
                        ->get();

                    } elseif ($report == 'staff2') {
                        $parameters = DsAcademicQualification::all();
                        $total = Staff::where('school_id', $school)
                        ->select('gender_id', 'academic_qualification_id', 'school_id')
                        ->get();
                    } elseif ($report == 'staff3') {
                        $parameters = DsTeachingQualification::all();
                        $total = Staff::where('school_id', $school)
                        ->select('gender_id', 'teaching_qualification_id', 'school_id')
                        ->get();
                    }


                    return view('admin.reports.report-page', compact('zoneReport', 'lgaReport', 'sectorReport', 'schoolReport', 'report', 'zoneName', 'total', 'lgaName', 'parameters', 'sectorName', 'schoolName'));
                }
            }
            ////////////////////////////////////////////////////REPORT CARD
            if ($school<'0' && $report == 'report_card'){
                return ("not available");
            } else {
            if ($schoolReport) {
                //Enrolment by class Report

                if ($report == 'report_card') {
                    //LGA schools
                    $schoolLGAS = SchoolAtlas::where('code_atlas_entity', $lga)->pluck('school_id');
                    //State schools
                    $lgas =  AtlasLink::where('code_atlas_link', 121)->pluck('code_atlas_entity');
                    $schoolState = SchoolAtlas::whereIn('code_atlas_entity', $lgas)->pluck('school_id');
                    //school backgrounds
                    $schoolBackground = SchoolBackground::with(['schoolType','schoolLocation'])->get();
                    //Get classes names
                    $student_class = StudentAdmission::where('school_enrolled_id', $school)->pluck('class_id');
                    $school_class = SchoolClass::whereIn('id', $student_class)->pluck('ds_class_id');
                    $classes = DB::table('ds_class')
                    ->join('ds_class_sector', 'ds_class.id', '=', 'ds_class_sector.class_id')
                    ->where('ds_class_sector.sector_id', $sector)
                    ->select('ds_class.title', 'id')
                    ->get();
                    //Get students
                    $students = StudentAdmission::select('gender_id', 'class_id', 'school_enrolled_id')
                    ->with(["classs"])
                    ->get();
                    $studentsSchool = $students->where('school_enrolled_id', $school)->count();
                    $studentsLGA = $students->whereIn('school_enrolled_id', $schoolLGAS)->count();
                    $studentsState = $students->count();
                    $studentsMSchool = $students->where('school_enrolled_id', $school)->where('gender_id', 1)->count();
                    $studentsMLGA = $students->whereIn('school_enrolled_id', $schoolLGAS)->where('gender_id', 1)->count();
                    $studentsMState = $students->where('gender_id', 1)->count();
                    $studentsFSchool = $students->where('school_enrolled_id', $school)->where('gender_id', 2)->count();
                    $studentsFLGA = $students->whereIn('school_enrolled_id', $schoolLGAS)->where('gender_id', 2)->count();
                    $studentsFState = $students->where('gender_id', 2)->count();
                    //Get staff 
                    $parameters = DsTeachingQualification::all();
                    $staffs = Staff::select('gender_id', 'teaching_qualification_id', 'school_id', 'seminar_workshop_id', 'present_status_id', 'type_staff_id')
                        ->get();
                    //Get classrooms
                    $classrooms = Classroom::select('id', 'condition', 'seating','writing_board', 'school_id')->get();
                    $nbClassroomsSchool = $classrooms->where('school_id', $school)->count();
                    $nbClassroomsLGA = $classrooms->whereIn('school_id', $schoolLGAS)->count();
                    $nbClassroomsState = $classrooms->count();
                    $useableClassroomsSchool = $classrooms->where('school_id', $school)->whereIn('condition', [1,2,3])->count();
                    $useableClassroomsLGA = $classrooms->whereIn('school_id', $schoolLGAS)->whereIn('condition', [1,2,3])->count();
                    $useableClassroomsState = $classrooms->whereIn('condition', [1,2,3])->count();
                    $adequateSeatClassroomsSchool = $classrooms->where('school_id', $school)->where('seating', 1)->count();
                    $adequateSeatClassroomsLGA = $classrooms->whereIn('school_id', $schoolLGAS)->where('seating', 1)->count();
                    $adequateSeatClassroomsState = $classrooms->where('seating', 1)->count();
                    $goodBlackBoardClassroomsSchool = $classrooms->where('school_id', $school)->where('writing_board', 1)->count();
                    $goodBlackBoardClassroomsLGA = $classrooms->whereIn('school_id', $schoolLGAS)->where('writing_board', 1)->count();
                    $goodBlackBoardClassroomsState = $classrooms->where('writing_board', 1)->count();
                    $minorRepairClassroomsSchool = $classrooms->where('school_id', $school)->where('condition', 2)->count();
                    $minorRepairClassroomsLGA = $classrooms->whereIn('school_id', $schoolLGAS)->where('condition', 2)->count();
                    $minorRepairClassroomsState = $classrooms->where('condition', 2)->count();
                    $majorRepairClassroomsSchool = $classrooms->where('school_id', $school)->where('condition', 3)->count();
                    $majorRepairClassroomsLGA = $classrooms->whereIn('school_id', $schoolLGAS)->where('condition',3)->count();
                    $majorRepairClassroomsState = $classrooms->where('condition', 3)->count();
                    //Get toilets
                    $toilets = Toilet::select('id', 'ds_condition_id', 'ds_user_toilet_id','ds_toilet_usage_id', 'school_id')->get();
                    $nbToiletsSchool = $toilets->where('school_id', $school)->count();
                    $nbToiletsLGA = $toilets->whereIn('school_id', $schoolLGAS)->count();
                    $nbToiletsState = $toilets->count();
                    //Context index calculations
                    $availabilityElectricitySchool = $schoolName->background->source_of_electricity ==1 || $schoolName->background->source_of_electricity ==2 || $schoolName->background->source_of_electricity ==3 || $schoolName->background->source_of_electricity ==5 ? 1: 0;
                    $availabilityElectricityLGA = $schoolBackground->whereIn('school_id', $schoolLGAS)->where('source_of_electricity',4)->count()/$schoolLGAS->count();
                    $availabilityElectricityState = $schoolBackground->whereIn('school_id', $schoolState)->where('source_of_electricity',4)->count()/$schoolState->count();
                    $availabilityWaterSchool = $schoolName->background->source_of_water ==1 || $schoolName->background->source_of_water ==2 || $schoolName->background->source_of_water ==3 ? 1 : 0;
                    $availabilityWaterLGA = $schoolBackground->whereIn('school_id', $schoolLGAS)->whereIn('source_of_water',[1,2,3])->count()/$schoolLGAS->count();
                    $availabilityWaterState = $schoolBackground->whereIn('school_id', $schoolState)->whereIn('source_of_water',[1,2,3])->count()/$schoolState->count();
                    $availabilityToiletsStudentsSchool = 1;
                    $availabilityToiletsStudentsLGA = 1;
                    $availabilityToiletsStudentsState = 1;
                    $sbmcExistsMetPast12MonthsSchool = $schoolName->background->sbmc ==1 ? 1: 0  ;
                    $sbmcExistsMetPast12MonthsLGA = $schoolBackground->whereIn('school_id', $schoolLGAS)->where('sbmc',2)->count()/$schoolLGAS->count();
                    $sbmcExistsMetPast12MonthsState = $schoolBackground->whereIn('school_id', $schoolState)->where('sbmc',2)->count()/$schoolState->count();
                    $classesHeldOutsideSchool = $schoolName->background->any_classes_held_outside_y_n ==2 ? 1: 0;
                    $classesHeldOutsideLGA = $schoolBackground->whereIn('school_id', $schoolLGAS)->where('any_classes_held_outside_y_n',2)->count()/$schoolLGAS->count();
                    $classesHeldOutsideState  = $schoolBackground->whereIn('school_id', $schoolState)->where('any_classes_held_outside_y_n',2)->count()/$schoolState->count();
                    $arrayContextSchool = array($availabilityElectricitySchool,$availabilityWaterSchool,$availabilityToiletsStudentsSchool,$sbmcExistsMetPast12MonthsSchool,$classesHeldOutsideSchool);
                    $arrayContextLGA = array($availabilityElectricityLGA,$availabilityWaterLGA,$availabilityToiletsStudentsLGA,$sbmcExistsMetPast12MonthsLGA,$classesHeldOutsideLGA);
                    $arrayContextState = array($availabilityElectricityState,$availabilityWaterState,$availabilityToiletsStudentsState,$sbmcExistsMetPast12MonthsState,$classesHeldOutsideState);
                    $contextIndexScoreSchool = number_format(array_sum($arrayContextSchool) / count($arrayContextSchool),2);
                    $contextIndexScoreLGA = number_format(array_sum($arrayContextLGA) / count($arrayContextLGA),1);
                    $contextIndexScoreState = number_format(array_sum($arrayContextState) / count($arrayContextState),2);
                    //Inputs Index calculations
                    $ptrschl=number_format($studentsSchool/$staffs->where('school_id', $school)->count(),2);
                    if($ptrschl>=0 && $ptrschl<=40){$PTRSchool =1;} else if($ptrschl>40 && $ptrschl<=60){$PTRSchool =0.75;} else if($ptrschl>60 && $ptrschl<=80){$PTRSchool =0.5;} else if($ptrschl>80 && $ptrschl<=99){$PTRSchool =0.25;} else {$PTRSchool =0;}
                    $ptrlga =number_format($studentsLGA/$staffs->whereIn('school_id', $schoolLGAS)->count(),2);
                    if($ptrlga>=0 && $ptrlga<=40){$PTRLGA =1;} else if($ptrlga>40 && $ptrlga<=60){$PTRLGA =0.75;} else if($ptrlga>60 && $ptrlga<=80){$PTRLGA =0.5;} else if($ptrlga>80 && $ptrlga<=99){$PTRLGA =0.25;} else {$PTRLGA =0;}
                    $ptrstt =number_format($studentsState/$staffs->count(),2);
                    if($ptrstt>=0 && $ptrstt<=40){$PTRState =1;} else if($ptrstt>40 && $ptrstt<=60){$PTRState =0.75;} else if($ptrstt>60 && $ptrstt<=80){$PTRState =0.5;} else if($ptrstt>80 && $ptrstt<=99){$PTRState =0.25;} else {$PTRState =0;}
                    $pcrschl=number_format($studentsSchool/$useableClassroomsSchool,2);
                    if($pcrschl>=0 && $pcrschl<=40){$PCRSchool =1;} else if($pcrschl>40 && $pcrschl<=60){$PCRSchool =0.75;} else if($pcrschl>60 && $pcrschl<=80){$PCRSchool =0.5;} else if($pcrschl>80 && $pcrschl<=99){$PCRSchool =0.25;} else {$PCRSchool =0;}
                    $pcrlga =number_format($studentsLGA/$useableClassroomsLGA,2);
                    if($pcrlga>=0 && $pcrlga<=40){$PCRLGA =1;} else if($pcrlga>40 && $pcrlga<=60){$PCRLGA =0.75;} else if($pcrlga>60 && $pcrlga<=80){$PCRLGA =0.5;} else if($pcrlga>80 && $pcrlga<=99){$PCRLGA =0.25;} else {$PCRLGA =0;}
                    $pcrstt =number_format($studentsState/$useableClassroomsState,2);
                    if($pcrstt>=0 && $pcrstt<=40){$PCRState =1;} else if($pcrstt>40 && $pcrstt<=60){$PCRState =0.75;} else if($pcrstt>60 && $pcrstt<=80){$PCRState =0.5;} else if($pcrstt>80 && $pcrstt<=99){$PCRState =0.25;} else {$PCRState =0;}
                    $PMTRSchool = number_format(1,2);
                    $PMTRLGA = number_format(1,2);
                    $PMTRState = number_format(1,2);
                    $arrayInputSchool = array($PTRSchool,$PCRSchool,$PMTRSchool);
                    $arrayInputLGA = array($PTRLGA,$PCRLGA,$PMTRLGA);
                    $arrayInputState = array($PTRState,$PCRState,$PMTRState);
                    $inputIndexScoreSchool = number_format(array_sum($arrayInputSchool) / count($arrayInputSchool),2);
                    $inputIndexScoreLGA = number_format(array_sum($arrayInputLGA) / count($arrayInputLGA),2);
                    $inputIndexScoreState = number_format(array_sum($arrayInputState) / count($arrayInputState),2);
                    //Result Index calculations
                    $gpisch = number_format($studentsFSchool/$studentsMSchool,2);
                    if($gpisch>0.97){$PTRSchool=1;} else if($gpisch>0.79 && $gpisch<=0.97){$GPISchool=0.5;} else if($gpisch>0.69 && $gpisch<=0.79){$GPISchool=0.25;} else {$GPISchool=0;}
                    $gpilga = number_format($studentsFLGA/$studentsMLGA,2);
                    if($gpilga>0.97){$GPILGA=1;} else if($gpilga>0.79 && $gpilga<=0.97){$GPILGA=0.5;} else if($gpilga>0.69 && $gpilga<=0.79){$GPILGA=0.25;} else {$GPILGA=0;}
                    $gpistt = number_format($studentsFState/$studentsMState,2);
                    if($gpistt>0.97){$GPIState=1;} else if($gpistt>0.79 && $gpistt<=0.97){$GPIState=0.5;} else if($gpistt>0.69 && $gpistt<=0.79){$GPIState=0.25;} else {$GPIState=0;}
                    $RetentionRateSchool = 1;
                    $RetentionRateLGA = 1;
                    $RetentionRateState = 1;
                    $arrayResultSchool = array($GPISchool,$RetentionRateSchool);
                    $arrayResultLGA = array($GPILGA,$RetentionRateLGA);
                    $arrayResultState = array($GPIState,$RetentionRateState);
                    $resultIndexScoreSchool = array_sum($arrayResultSchool) / count($arrayResultSchool);
                    $resultIndexScoreLGA = array_sum($arrayResultLGA) / count($arrayResultLGA);
                    $resultIndexScoreState = array_sum($arrayResultState) / count($arrayResultState);
                    //Efficiency Index (Results/Inputs) calculation
                    $efficiencyIndexSchool1 = $resultIndexScoreSchool/$inputIndexScoreSchool;
                    $efficiencyIndexLGA1 = $resultIndexScoreLGA/$inputIndexScoreLGA;
                    $efficiencyIndexState1 = $resultIndexScoreState/$inputIndexScoreState;
                    //Efficiency Index (Results/Context) calculation
                    $efficiencyIndexSchool2 = number_format($resultIndexScoreSchool/$contextIndexScoreSchool,2);
                    $efficiencyIndexLGA2 = number_format($resultIndexScoreLGA/$contextIndexScoreLGA,2);
                    $efficiencyIndexState2 = number_format($resultIndexScoreState/$contextIndexScoreState,2);

                    return view('admin.reports.report-page', compact('zoneReport', 'lgaReport', 'sectorReport', 'schoolReport', 'report', 'zoneName', 'students', 'studentsSchool', 'studentsLGA', 'studentsState','studentsMSchool', 'studentsMLGA', 'studentsMState','studentsFSchool', 'studentsFLGA', 'studentsFState', 'school', 'staffs', 'useableClassroomsSchool', 'useableClassroomsLGA', 'useableClassroomsState', 'adequateSeatClassroomsSchool', 'adequateSeatClassroomsLGA','adequateSeatClassroomsState','nbClassroomsSchool','nbClassroomsLGA','nbClassroomsState','goodBlackBoardClassroomsSchool','goodBlackBoardClassroomsLGA','goodBlackBoardClassroomsState','minorRepairClassroomsSchool','minorRepairClassroomsLGA','minorRepairClassroomsState','majorRepairClassroomsSchool','majorRepairClassroomsLGA','majorRepairClassroomsState', 'nbToiletsSchool','nbToiletsLGA','nbToiletsState', 'parameters', 'classes', 'lgaName', 'sectorName', 'schoolName', 'schoolBackground', 'schoolLGAS','schoolState','contextIndexScoreSchool','contextIndexScoreLGA','contextIndexScoreState','inputIndexScoreSchool', 'inputIndexScoreLGA', 'inputIndexScoreState','resultIndexScoreSchool','resultIndexScoreLGA','resultIndexScoreState','efficiencyIndexSchool1','efficiencyIndexLGA1','efficiencyIndexState1','efficiencyIndexSchool2','efficiencyIndexLGA2','efficiencyIndexState2'));
                }

            }
        }

            // dd($zoneReport, $lgaReport, $sectorReport, $schoolReport); 
        }
    }
}
