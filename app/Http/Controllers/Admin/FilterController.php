<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Response;
use App\Atlas;
use App\AtlasLink;
use App\SchoolAtlas;
use App\SchoolSubject;

class FilterController extends Controller
{

    public function get_schools(Request $request)
    {
         if (empty($request))
            $schools = DB::table('schools')->sortByDesc('name');
        else
            $schools = DB::table('schools')->where('id', $request)->orderBy('name', 'desc')->get();

        return $schools;

    }

    public function filter_schools(Request $request)
    {

        $schoolLGA = SchoolAtlas::where('code_atlas_entity', $request->lga_id)->pluck('school_id');
        $schools = School::whereIn('id', $schoolLGA)->pluck('name','id');

        // $schools = DB::table('schools')
        //     ->select('id', 'name')
        //     ->orderBy('name', 'asc')
        //     ->get();

        $result = "";

        /*
        if ($schools->count() > 1)
            $result .= "<option value='%'>All Schools</option>";
        */

        foreach ($schools as $id => $school) {
            $result .= "<option value='" . $id . "'>$school</option>";
        }

        return $result;
    }


     public function filter_lgas()
    {

        $lgas = DB::table('lgas')
            ->where('state_id', 20)
            ->select('id', 'name')
            ->orderBy('name', 'asc')
            ->get();

        $result = "";

        /*
        if ($schools->count() > 1)
            $result .= "<option value='%'>All Schools</option>";
        */

        foreach ($lgas as $lga) {
            $result .= "<option value='" . $lga->id . "'>$lga->name</option>";
        }

        return $result;
    }

    public function filter_wards(Request $request)
    {
         $wards = DB::table('wards')
            ->where('lga_id', $request->lga)
            ->select('id', 'name')
            ->orderBy('name', 'asc')
            ->get();

        $result = "";

        foreach ($wards as $ward) {
            $result .= "<option value='" . $ward->id . "'>$ward->name</option>";
        }

        return $result;
    }

    public function filter_school_types()
    {

        $school_types = DB::table('school_types')
            ->select('id', 'name')
            ->orderBy('name', 'asc')
            ->get();

        $result = "";

        /*
        if ($schools->count() > 1)
            $result .= "<option value='%'>All Schools</option>";
        */

        foreach ($school_types as $school_type) {
            $result .= "<option value='" . $school_type->id . "'>$school_type->name</option>";
        }

        return $result;
    }    
    
    public function filter_school_categories()
    {

        $school_categories = DB::table('school_categories')
            ->select('id', 'name')
            ->orderBy('name', 'asc')
            ->get();

        $result = "";

        foreach ($school_categories as $school_category) {
            $result .= "<option value='" . $school_category->id . "'>$school_category->name</option>";
        }

        return $result;
    }

    
    public function filter_classes()
    {
         $classes = DB::table('classes')
            ->join('class_settings', 'classes.id', '=', 'class_settings.class_id')
            ->select('class_settings.id', 'name')
            ->where('school_id', Auth::user()->school_id)
            ->orderBy('name', 'asc')
            ->get();

        $result = "";

        foreach ($classes as $clas) {
            $result .= "<option value='" . $clas->id . "'>$clas->name</option>";
        }

        return $result;
    }

    public function filter_all_classes()
    {
         $classes = DB::table('classes')
            ->select('id', 'name')
            ->orderBy('name', 'asc')
            ->get();

        $result = "";

        foreach ($classes as $clas) {
            $result .= "<option value='" . $clas->id . "'>$clas->name</option>";
        }

        return $result;
    }

    public function filter_zones()
    {
        $zones = Atlas::select('name_atlas_entity', 'code_atlas_entity')
                        ->where('code_ds_atlas_entity', 4)
                        ->groupBy('code_atlas_entity','name_atlas_entity')
                        ->get();

        // $zones = DB::table('zones')
        //     ->where('state_id', 20)
        //     ->select('id', 'name')
        //     ->orderBy('name', 'asc')
        //     ->get();

        $result = "";

        foreach ($zones as $zone) {
            $result .= "<option value='" . $zone->code_atlas_entity . "'>$zone->name_atlas_entity</option>";
        }

        return $result;
    }

    public function filter_zones_lgas(Request $request)
    {   
        $stateLGA = AtlasLink::where('code_atlas_link', $request->zone_id)->pluck('code_atlas_entity');
        $zones_lgas = Atlas::whereIn('code_atlas_entity', $stateLGA)->pluck('name_atlas_entity', 'code_atlas_entity');

        // $zones_lgas = DB::table('zones_lgas')
        //     ->select('id', 'name')
        //     ->orderBy('name', 'asc')
        //     ->get();

        $result = "";

        foreach ($zones_lgas as $zones_lga => $zone) {
            $result .= "<option value='" . $zones_lga . "'>$zone</option>";
        }

        return $result;
    }

    public function filter_staff()
    {

        $staffs = DB::table('staffs')
            ->select('id', 'first_name')
            ->orderBy('first_name', 'asc')
            ->get();

        $result = "";

        foreach ($staffs as $staff) {
            $result .= "<option value='" . $staff->id . "'>$staff->first_name</option>";
        }

        return $result;
    }

    public function filter_staff_email()
    {
        $staffs = DB::table('staffs')
            ->select('id', 'first_name', 'email')
            ->orderBy('first_name', 'asc')
            ->get();
        $result = "";
        foreach ($staffs as $staff) {
            $result .= "<option value='" . $staff->id . "'>".$staff->first_name." (".$staff->email.")</option>";
        }
        return $result;
    } 

    public function filter_staff_phone()
    {
        $staffs = DB::table('staff')
            ->select('id', 'first_name', 'gsm')
            ->orderBy('first_name', 'asc')
            ->get();
        $result = "";
        foreach ($staffs as $staff) {
            $result .= "<option value='" . $staff->id . "'>".$staff->first_name." (".$staff->gsm.")</option>";
        }
        return $result;
    } 
    
    public function filter_message_type()
    {
        $messagetypes = DB::table('mailsms')
            ->orderBy('message_type', 'asc')
            ->distinct()
            ->get(['message_type']);
        $result = "";

        foreach ($messagetypes as $messagetype) {
            $result .= "<option value='" . $messagetype->message_type . "'>$messagetype->message_type</option>";
        }

        return $result;
    }
    
    public function filter_mail_sms_template(Request $request)
    {
        $mailsmstemplates = DB::table('mailsms_templates')
            ->select('id', 'type', 'title')
            ->where('type', $request->messagetype)
            ->orderBy('title', 'asc')
            ->get();
        $result = "";
        foreach ($mailsmstemplates as $mailsmstemplate) {
            $result .= "<option value='" . $mailsmstemplate->id . "'>$mailsmstemplate->title</option>";
        }
        return $result;
    }    

    public function filter_mail_sms_body(Request $request)
    {
        $mailsmsbody = DB::table('mailsms_templates')
        ->where('id', $request->id)
        ->select('id', 'title', 'message', 'type')
        ->get()->first();
       return Response::json($mailsmsbody);
    }

    public function filter_sections(Request $request)
    {

        $sections = Section::ofClass($request->class_id)->get()->pluck('name', 'id')->sortBy('name');
        $result = "";

        foreach ($sections as $key => $value) {
            $result .= "<option value='" . $key . "'>" . $value . "</option>";
        }

        return $result;
    }

    public function filter_all_subjects()
    {

        $subjects = DB::table('subjects')
            ->select('id', 'name')
            ->orderBy('name', 'asc')
            ->get();

        $result = "";

        foreach ($subjects as $subject) {
            $result .= "<option value='" . $subject->id . "'>$subject->name</option>";
        }

        return $result;
    }

    public function filter_subjects(Request $request)
    {
        //  $subjects = DB::table('subjects')
        //     ->join('subject_settings', 'subjects.id', '=', 'subject_settings.subject_id')
        //     ->select('subject_settings.id', 'name')
        //     ->where('school_id', Auth::user()->school_id)
        //     ->orderBy('name', 'asc')
        //     ->get();

        // $result = "";

        // foreach ($subjects as $subject) {
        //     $result .= "<option value='" . $subject->id . "'>$subject->name</option>";
        // }

        // return $result;

        $subjects = SchoolDsSubject::where('school_id', Auth::User()->school_id)->where('class_id', $request->class_id)->with(["subjectName"])->get();

        return $subjects;
    }


}
