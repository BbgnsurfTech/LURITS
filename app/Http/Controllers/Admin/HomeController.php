<?php

namespace App\Http\Controllers\Admin;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use App\StudentAdmission;
use App\Staff;
use App\Parents;
use App\Expense;
use App\Atlas;
use App\AtlasLink;
use App\School;
use App\SchoolAtlas;
use Auth;
use Illuminate\Http\Request;

class HomeController
{
    public function notifications()
    {
        $notifications = Auth::User()->notifications;
        return view('notifications', compact('notifications'));    
    }

    public function route(Request $request)
    {
        $n = Auth::User()->unreadNotifications->where('id', $request->id)->markAsRead();
        $r = 'admin.'.$request->route.'.index';
        return redirect()->route($r);
    }

    // public function notifications(Request $request)
    // {
    //     $notifications = Auth::User()->notifications;
    //     return view('notifications', compact('notifications'));   

    //     $this->checkAccessRights($topic);

    //     foreach ($topic->messages as $message) {
    //         if ($message->sender_id !== Auth::id() && $message->read_at === null) {
    //             $message->read_at = Carbon::now();
    //             $message->save();
    //         }
    //     }

    //     $unreads = $this->unreadTopics();

    //     return view('admin.messenger.show', compact('topic', 'unreads')); 
    // }

    public function index()
    {
        $settings1 = [
            'chart_title'           => 'my test report',
            'chart_type'            => 'line',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\\School',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'week',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd/m/Y H:i:s',
            'column_class'          => 'col-md-12',
            'entries_number'        => '5',
        ];

        // $chart1 = new LaravelChart($settings1);

        $settings2 = [
            'chart_title'           => 'task',
            'chart_type'            => 'bar',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\\Task',
            'group_by_field'        => 'due_date',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd/m/Y',
            'column_class'          => 'col-md-12',
            'entries_number'        => '5',
        ];

        // $chart2 = new LaravelChart($settings2);

        
        // $expenses = Expense::all();
        
        
        // $atlaslink = AtlasLink::where('code_atlas_link', 121)->get();
        
         // -12 Zones

        // dd($lga);

        
        
        
        //dd($lga);
        if (isset(Auth::User()->atlas)) {
            $atlass = Atlas::where('code_atlas_entity', Auth::User()->atlas->atlas_id)->first();
        } else {
            $atlass = '';
        }

        if (Auth::User()->is_superAdmin || Auth::User()->is_admin) {
            //Zones
            //LGA
            $stateLGA = AtlasLink::where('code_atlas_link', 121)->pluck('code_atlas_entity');
            $lgaa = Atlas::whereIn('code_atlas_entity', $stateLGA)->count() - 12;
            //Schools
            $schools = School::count();
            // staffs
            $staffs = Staff::count();
            $teachers = Staff::whereIn('type_staff_id', [1,2,3,4,7,8])->count();
            // Students
            $students = StudentAdmission::count();
            $mStud = StudentAdmission::where('gender_id', 1)->count();
            // dd($mStud);
            $fStud = StudentAdmission::where('gender_id', 2)->count();
            // Parents
            $parents = Parents::count();
        } elseif (Auth::User()->is_zeqa) {
            // LGA
            $a = Auth::User()->atlas;
            $stateLGA = AtlasLink::where('code_atlas_link', $a->atlas_id)->pluck('code_atlas_entity');
            $lgas = Atlas::whereIn('code_atlas_entity', $stateLGA)->get();
            $lgaa = $lgas->count();
            //Schools
            $allschools = SchoolAtlas::whereIn('code_atlas_entity', $lgas->pluck('code_atlas_entity'))->get();
            $schools = $allschools->count();
            // staffs
            $staffs = Staff::whereIn('school_id', $allschools->pluck('school_id'))->count();
            $teachers = Staff::whereIn('school_id', $allschools->pluck('school_id'))->whereIn('type_staff_id', [1,2,3,4,7,8])->count();
            // Students
            $students = StudentAdmission::whereIn('school_enrolled_id', $allschools->pluck('school_id'))->count();
            $mStud = StudentAdmission::whereIn('school_enrolled_id', $allschools->pluck('school_id'))->where('gender_id', 1)->count();
            $fStud = StudentAdmission::whereIn('school_enrolled_id', $allschools->pluck('school_id'))->where('gender_id', 2)->count();
            // Parents
            $parents = Parents::whereIn('school_id', $allschools->pluck('school_id'))->count();
        } elseif (Auth::User()->is_lgea) {
            $lgaa = '';
            // Schools
            $a = Auth::User()->atlas;
            $b = $a->atlas_id;
            $lgaSchool = SchoolAtlas::where('code_atlas_entity', $b)->pluck('school_id');
            $school = School::whereIn('id', $lgaSchool)->where('code_type_sector', 1)->get();
            $schools = $school->count();
            $students = StudentAdmission::whereIn('school_enrolled_id', $school->pluck('id'))->count();
            $mStud = StudentAdmission::whereIn('school_enrolled_id', $school->pluck('id'))->where('gender_id', 1)->count();
            $fStud = StudentAdmission::whereIn('school_enrolled_id', $school->pluck('id'))->where('gender_id', 2)->count();
            $parents = Parents::whereIn('school_id', $school->pluck('id'))->count();
            $staffs = Staff::whereIn('school_id', $school->pluck('id'))->count();
            $teachers = Staff::whereIn('school_id', $school->pluck('id'))->whereIn('type_staff_id', [1,2,3,4,7,8])->count();
        } elseif (Auth::User()->is_headTeacher) {
            $school_id = Auth::User()->school_id;
            $zones = '';
            $lgaa = '';
            $schools = '';
            $staffs = Staff::where('school_id', $school_id)->count();
            $teachers = Staff::where('school_id', $school_id)->whereIn('type_staff_id', [1,2,3,4,7,8])->count();
            $students = StudentAdmission::where('school_enrolled_id', $school_id)->count();
            $mStud = StudentAdmission::where('school_enrolled_id', $school_id)->where('gender_id', 1)->count();
            $fStud = StudentAdmission::where('school_enrolled_id', $school_id)->where('gender_id', 2)->count();
            $parents = Parents::where('school_id', $school_id)->count();
        } elseif (Auth::User()->is_teacher) {
            $lgaa = '';
            $schools = '';
            $staffs = '';
            $teachers = '';
            $students = '';
            $mStud = '';
            $fStud = '';
            $parents = '';
        }
        // $school = Auth::User()->schools;

        return view('home', compact('students', 'parents',  'atlass', 'lgaa', 'schools', 'staffs', 'mStud', 'fStud', 'teachers'));
        
    }
}
