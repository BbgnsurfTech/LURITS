<?php

namespace App\Http\Controllers\Admin;

use App\Attendance;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAttendanceRequest;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\StudentAdmission;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Attendance::with(['admission', 'team'])->select(sprintf('%s.*', (new Attendance)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'attendance_show';
                $editGate      = 'attendance_edit';
                $deleteGate    = 'attendance_delete';
                $crudRoutePart = 'attendances';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->addColumn('admission_child_name', function ($row) {
                return $row->admission ? $row->admission->child_name : '';
            });

            $table->editColumn('admission.middle_name', function ($row) {
                return $row->admission ? (is_string($row->admission) ? $row->admission : $row->admission->middle_name) : '';
            });
            $table->editColumn('admission.last_name', function ($row) {
                return $row->admission ? (is_string($row->admission) ? $row->admission : $row->admission->last_name) : '';
            });
            $table->editColumn('admission.admission', function ($row) {
                return $row->admission ? (is_string($row->admission) ? $row->admission : $row->admission->admission) : '';
            });
            $table->editColumn('attendance_status_morninig', function ($row) {
                return $row->attendance_status_morninig ? Attendance::ATTENDANCE_STATUS_MORNINIG_RADIO[$row->attendance_status_morninig] : '';
            });
            $table->editColumn('attendance_status_afternoon', function ($row) {
                return $row->attendance_status_afternoon ? Attendance::ATTENDANCE_STATUS_AFTERNOON_RADIO[$row->attendance_status_afternoon] : '';
            });
            $table->editColumn('late_status_y_n', function ($row) {
                return $row->late_status_y_n ? Attendance::LATE_STATUS_Y_N_RADIO[$row->late_status_y_n] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'admission']);

            return $table->make(true);
        }

        return view('admin.attendances.index');
    }

    public function create()
    {
        abort_if(Gate::denies('attendance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $admissions = StudentAdmission::all()->pluck('child_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.attendances.create', compact('admissions'));
    }

    public function store(StoreAttendanceRequest $request)
    {
        $attendance = Attendance::create($request->all());

        return redirect()->route('admin.attendances.index');
    }

    public function edit(Attendance $attendance)
    {
        abort_if(Gate::denies('attendance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $admissions = StudentAdmission::all()->pluck('child_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $attendance->load('admission', 'team');

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

        $attendance->load('admission', 'team');

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
