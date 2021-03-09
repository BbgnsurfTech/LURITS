<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
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
    use CsvImportTrait;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = TeacherAttendance::with(['teacher', 'team'])->select(sprintf('%s.*', (new TeacherAttendance)->table));
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

            $table->addColumn('teachers_first_name', function ($row) {
                return $row->teacher ? $row->teacher->first_name : '';
            });

            $table->editColumn('teachers.middle_name', function ($row) {
                return $row->teacher ? (is_string($row->teacher) ? $row->teacher : $row->teacher->middle_name) : '';
            });
            $table->editColumn('teachers.last_name', function ($row) {
                return $row->teacher ? (is_string($row->teacher) ? $row->teachers : $row->teacher->last_name) : '';
            });
            $table->editColumn('teachers.phone_number', function ($row) {
                return $row->teacher ? (is_string($row->teacher) ? $row->teacher : $row->teacher->phone_number) : '';
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

            $table->rawColumns(['actions', 'placeholder', 'teachers']);

            return $table->make(true);
        }

        return view('admin.teacherAttendances.index');
    }

    public function create()
    {
        abort_if(Gate::denies('teacher_attendance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $teachers = Teacher::all()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.teacherAttendances.create', compact('teachers'));
    }

    public function store(StoreTeacherAttendanceRequest $request)
    {
        $teacherAttendance = TeacherAttendance::create($request->all());

        return redirect()->route('admin.teacher-attendances.index');
    }

    public function edit(TeacherAttendance $teacherAttendance)
    {
        abort_if(Gate::denies('teacher_attendance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $teachers = Teacher::all()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $teacherAttendance->load('teacher', 'team');

        return view('admin.teacherAttendances.edit', compact('teachers', 'teacherAttendance'));
    }

    public function update(UpdateTeacherAttendanceRequest $request, TeacherAttendance $teacherAttendance)
    {
        $teacherAttendance->update($request->all());

        return redirect()->route('admin.teacher-attendances.index')->with('message', 'Teacher attendance updated.')->with('icon','success');
    }

    public function show(TeacherAttendance $teacherAttendance)
    {
        abort_if(Gate::denies('teacher_attendance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $teacherAttendance->load('teacher', 'team');

        return view('admin.teacherAttendances.show', compact('teacherAttendance'));
    }

    public function destroy(TeacherAttendance $teacherAttendance)
    {
        abort_if(Gate::denies('teacher_attendance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $teacherAttendance->delete();

        return back()->with('message', 'Teacher attendance deleted.')->with('icon','error');
    }

    public function massDestroy(MassDestroyTeacherAttendanceRequest $request)
    {
        TeacherAttendance::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
