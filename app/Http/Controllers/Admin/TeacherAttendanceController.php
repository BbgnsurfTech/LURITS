<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTeacherAttendanceRequest;
use App\Http\Requests\StoreTeacherAttendanceRequest;
use App\Http\Requests\UpdateTeacherAttendanceRequest;
use App\Teacher;
use App\TeacherAttendance;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TeacherAttendanceController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = TeacherAttendance::with(['admission', 'team'])->select(sprintf('%s.*', (new TeacherAttendance)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'teacher_attendance_show';
                $editGate      = 'teacher_attendance_edit';
                $deleteGate    = 'teacher_attendance_delete';
                $crudRoutePart = 'teacher-attendances';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->addColumn('admission_first_name', function ($row) {
                return $row->admission ? $row->admission->first_name : '';
            });

            $table->editColumn('admission.middle_name', function ($row) {
                return $row->admission ? (is_string($row->admission) ? $row->admission : $row->admission->middle_name) : '';
            });
            $table->editColumn('admission.last_name', function ($row) {
                return $row->admission ? (is_string($row->admission) ? $row->admission : $row->admission->last_name) : '';
            });
            $table->editColumn('admission.phone_number', function ($row) {
                return $row->admission ? (is_string($row->admission) ? $row->admission : $row->admission->phone_number) : '';
            });
            $table->editColumn('attendance_status_morninig', function ($row) {
                return $row->attendance_status_morninig ? TeacherAttendance::ATTENDANCE_STATUS_MORNINIG_RADIO[$row->attendance_status_morninig] : '';
            });
            $table->editColumn('attendance_status_afternoon', function ($row) {
                return $row->attendance_status_afternoon ? TeacherAttendance::ATTENDANCE_STATUS_AFTERNOON_RADIO[$row->attendance_status_afternoon] : '';
            });
            $table->editColumn('late_status_y_n', function ($row) {
                return $row->late_status_y_n ? TeacherAttendance::LATE_STATUS_Y_N_RADIO[$row->late_status_y_n] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'admission']);

            return $table->make(true);
        }

        return view('admin.teacherAttendances.index');
    }

    public function create()
    {
        abort_if(Gate::denies('teacher_attendance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $admissions = Teacher::all()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.teacherAttendances.create', compact('admissions'));
    }

    public function store(StoreTeacherAttendanceRequest $request)
    {
        $teacherAttendance = TeacherAttendance::create($request->all());

        return redirect()->route('admin.teacher-attendances.index');
    }

    public function edit(TeacherAttendance $teacherAttendance)
    {
        abort_if(Gate::denies('teacher_attendance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $admissions = Teacher::all()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $teacherAttendance->load('admission', 'team');

        return view('admin.teacherAttendances.edit', compact('admissions', 'teacherAttendance'));
    }

    public function update(UpdateTeacherAttendanceRequest $request, TeacherAttendance $teacherAttendance)
    {
        $teacherAttendance->update($request->all());

        return redirect()->route('admin.teacher-attendances.index');
    }

    public function show(TeacherAttendance $teacherAttendance)
    {
        abort_if(Gate::denies('teacher_attendance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $teacherAttendance->load('admission', 'team');

        return view('admin.teacherAttendances.show', compact('teacherAttendance'));
    }

    public function destroy(TeacherAttendance $teacherAttendance)
    {
        abort_if(Gate::denies('teacher_attendance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $teacherAttendance->delete();

        return back();
    }

    public function massDestroy(MassDestroyTeacherAttendanceRequest $request)
    {
        TeacherAttendance::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
