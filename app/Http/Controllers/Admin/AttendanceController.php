<?php

namespace App\Http\Controllers\Admin;

use App\Attendance;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAttendanceRequest;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\StudentAdmission;
use App\Classroom;
use DB;
use Gate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AttendanceController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        
        $attendances = Attendance::select('date')->groupBy('date')->get();
        return view('admin.attendances.index', compact('attendances'));
    }

    public function create()
    {
        abort_if(Gate::denies('attendance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $date = Carbon::now();
        $admissions = StudentAdmission::all();
        $classrooms = Classroom::all();

        return view('admin.attendances.create', compact('admissions', 'classrooms', 'date'));
    }

    public function store(Request $request)
    {   
        //$attendance = Attendance::create($request->all());
        $date = $request->date;
        $date = Attendance::where('date', $date)->first();
        if ($date) {
            # code...
            $notification = array(
                'message' => 'Attendance has been taken',
                'icon' => 'error'
                 );
            return Redirect()->back()->with($notification);
        } else {
            foreach ($request->admission_id as $id) {
                # code...
                $data[]=[
                    "admission_id" => $id,
                    "attendance_morning" => $request->attendance_morning[$id],
                    "attendance_afternoon" => $request->attendance_afternoon[$id],
                    "late_status" => $request->late_status[$id],
                    "note" => $request->note[$id],
                    "class_id" => $request->class_id,
                    "school_id" => $request->school_id,
                    "date" => $request->date
                ];
            //dd($data);
            }
            $attendance = Attendance::insert($data);
            if ($attendance) {
                # code...
                $notification = array(
                    'message' => 'Attendance taken successfully',
                    'icon' => 'success'
                );
            return redirect()->back()->with($notification);
            } else {
                $notification = array(
                    'message' => 'error',
                    'icon' => 'success'
                );
            return redirect()->back()->with($notification);
            }
        }
    }

    public function edit(Attendance $attendance)
    {
        abort_if(Gate::denies('attendance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $admissions = StudentAdmission::all()->pluck('child_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $attendance->load('admission', 'school');

        return view('admin.attendances.edit', compact('admissions', 'attendance'));
    }

    public function update(UpdateAttendanceRequest $request, Attendance $attendance)
    {
        $attendance->update($request->all());

        return redirect()->route('admin.attendances.index');
    }

    public function show(Attendance $attendance)
    {
        abort_if(Gate::denies('attendance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attendance->load('admission', 'school');

        return view('admin.attendances.show', compact('attendance'));
    }

    public function destroy(Attendance $attendance)
    {
        abort_if(Gate::denies('attendance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attendance->delete();

        return back();
    }

    public function massDestroy(MassDestroyAttendanceRequest $request)
    {
        Attendance::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
