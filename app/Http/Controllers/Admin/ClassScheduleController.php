<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassSchedule;
use App\Models\Section;
use App\DsSubject;
use Illuminate\Http\Request;
use App\Models\ClassRoom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DataTables;
use Redirect;
use Response;
use Carbon\Carbon;
use App\SchoolClass;
use App\Staff;

class ClassScheduleController extends Controller
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
    public function index(Request $request)
    {
        $schedules = ClassSchedule::latest()->where('school_id', Auth::user()->school_id)->get();

        if ($request->ajax()) {
            return Datatables::of($schedules)
                ->addIndexColumn()
                ->addColumn('teacher', function($row){
                     return Staff::find($row->staff_id)->full_name ?? '';
                })
                ->addColumn('subject', function($row){
                     return DsSubject::find($row->subject_id)->ds_subject_name ?? '';
                })
                ->addColumn('class', function($row){
                     return SchoolClass::find($row->class_id)->classTitle->title ?? '';
                })
                ->addColumn('section', function($row){
                     return SchoolClass::find($row->class_id)->armTitle->title ?? '';
                })
                ->addColumn('day', function($row){
                    return ClassSchedule::WEEK_DAYS[$row->day_of_week];
                })
                ->addColumn('time', function($row){
                    return (Carbon::parse($row->start_time)->format('g:i A') ?? '') . '-' . (Carbon::parse($row->end_time)->format('g:i A') ?? '');
                })
                ->addColumn('actions', 'admin.pages.lessonmanagement.classschedulesactions')
                ->rawColumns(['actions', 'teacher', 'subject', 'section', 'class', 'time'])
                ->make(true);
        }

        $classes = SchoolClass::where('school_id', Auth::User()->school_id)->with(["classTitle", "armTitle"])->get();

        $teachers = Staff::where('school_id', Auth::User()->school_id)->get();

        return view('admin.pages.lessonmanagement.manageclassschedules', compact('classes', 'teachers'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'class' => 'required',
            'subject' => 'required',
            'teacher' => 'required',
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $start_time = Carbon::parse($request->start_time);
        $end_time = Carbon::parse($request->end_time);

        if ($validator->fails()) {
            return response()->json(['type' => 'error', 'errors'=>$validator->errors()->all()]);
        } else {
            $schedule_id = $request->classschedule_id;
            // ClassSchedule::updateOrCreate(
            //     ['id' => $schedule_id],
            //     [
            //         'school_id' => Auth::user()->school_id,
            //         'class_id' => $request->class,
            //         'subject_id' => $request->subject,
            //         'staff_id' => $request->teacher,
            //         'day_of_week' => $request->day,
            //         'start_time' => $start_time->format('H:i'),
            //         'end_time' => $end_time->format('H:i')
            //     ]
            // );
            $data_id = ClassSchedule::where('school_id', $school)->max('id') + 1;
            // dd($data_id);
            if ($data_id == 1) {
                $model_id = str_pad($school, 15, "0", STR_PAD_RIGHT).$data_id;
            } else {
                $model_id = $data_id;
            }
            if(empty($schedule_id)){
                $schedule = new ClassSchedule();
                $schedule->id = $model_id;
                $schedule->school_id = Auth::user()->school_id;
                $schedule->class_id = $request->class;
                $schedule->subject_id = $request->subject;
                $schedule->staff_id = $request->teacher;
                $schedule->day_of_week = $request->day;
                $schedule->start_time = $start_time->format('H:i');
                $schedule->end_time = $end_time->format('H:i');
                $schedule->save();

                $msg = 'Schedule created successfully.';
            } else {
                $schedule = ClassSchedule::find($schedule_id);
                $schedule->school_id = Auth::user()->school_id;
                $schedule->class_id = $request->class;
                $schedule->subject_id = $request->subject;
                $schedule->staff_id = $request->teacher;
                $schedule->day_of_week = $request->day;
                $schedule->start_time = $start_time->format('H:i');
                $schedule->end_time = $end_time->format('H:i');
                $schedule->update();

                $msg = 'Schedule data is updated successfully';
            }

            return Response::json(['type' => 'success', 'message' => $msg]);
        }

     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $classschedule = ClassSchedule::where($where)->first();
         $sections = Section::ofClass($classschedule->class_id)->get()->pluck('name', 'id')->sortBy('name');
         $sectionselect = View('admin.pages.lessonmanagement.sectionselect', compact('classschedule', 'sections'))->render();
        return Response::json(['sectionselect'=>$sectionselect, 'classschedule' => $classschedule]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $classschedule = ClassSchedule::where('id',$id)->delete();
        return Response::json(['type' => 'success', 'message' => "<div class='alert alert-success'>Successfully Deleted</div>"]);

    }
}
