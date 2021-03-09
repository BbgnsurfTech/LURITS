<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassLeaveRequest;
use App\Http\Requests\StoreLeaveRequest;
use App\Http\Requests\UpdateLeaveRequest;
use App\Staff;
use App\Leave;
use Gate;
use App\Term;
use App\Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use App\Atlas;
use Yajra\DataTables\Facades\DataTables;

class LeaveController extends Controller
{
   use CsvImportTrait;

    public function index(Request $request)
    {
       abort_if(Gate::denies('leave_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Leave::where('school_id', $request->school)->select(sprintf('%s.*', (new Leave)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'leave_show';
                $editGate      = 'leave_edit';
                $deleteGate    = 'leave_delete';
                $crudRoutePart = 'leave';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });
            $table->editColumn('date', function ($row) {
                return $row->date ? $row->date : "";
            });
            $table->addColumn('staff_id', function ($row) {
                return $row->staff_id ? $row->staff_id : '';
            });
            $table->editColumn('number_of_days', function ($row) {
                return $row->number_of_days ? $row->number_of_days : "";
            });
            $table->editColumn('contact_number', function ($row) {
                return $row->contact_number ? $row->contact_number : "";
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? $row->status : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.leave.index');
    }

    public function getLeave(Request $request)
    {
        abort_if(Gate::denies('leave_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Leave::where('school_id', Auth::User()->school_id)->select(sprintf('%s.*', (new Leave)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'leave_show';
                $editGate      = 'leave_edit';
                $deleteGate    = 'leave_delete';
                $crudRoutePart = 'leave';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });
            $table->addColumn('staff_id', function ($row) {
                return $row->staff_id ? $row->staff_id : '';
            });
            $table->editColumn('number_of_days', function ($row) {
                return $row->number_of_days ? $row->number_of_days : "";
            });
            $table->editColumn('contact_number', function ($row) {
                return $row->contact_number ? $row->contact_number : "";
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? $row->status : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }
    }

    public function create()
    {
       abort_if(Gate::denies('leave_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
     
        $staffs = Staff::where('school_id', Auth::User()->school_id)->get();

        return view('admin.leave.create', compact('staffs'));
    }

    public function approve($id)
    {
        $a = Leave::find($id);
        $a->status = 1;
        $a->update();

        session()->flash('message', 'Leave has been approved');
        return redirect()->back();
    }

    public function store(StoreLeaveRequest $request)
    {   
        if (Auth::User()->is_headTeacher) {
           $request->validate([
            'staff_id' => 'required',
           ]);
        }
        // $leave = Leave::create($request->all());
        $term_id = Term::where('active_status', 1)->pluck('id')->first();
        $session_id = Session::where('active_status', 1)->pluck('id')->first();

        if (Auth::User()->is_teacher) {
            $staff_id = Staff::where('user_id', Auth::User()->id)->pluck('id')->first();
            $school_id = Auth::User()->school_id;
        } elseif (Auth::User()->is_headTeacher) {
            $school_id = Auth::User()->school_id;
        } else {
            $staff_id = $request->staff_id;
            $school_id = $request->school;
        }

        $data_id = Leave::where('school_id', $school_id)->max('id') + 1;
        
        if ($data_id == 1) {
            $model_id = str_pad($school_id, 15, "0", STR_PAD_RIGHT).$data_id;
        } else {
            $model_id = $data_id;
        }

        $data = new Leave();
        $data->id = $model_id;
        $data->staff_id = $staff_id;
        $data->status = $request->status;
        $data->contact_number = $request->contact_number;
        $data->address = $request->address;
        $data->number_of_days = $request->number_of_days;
        $data->leave_type = $request->leave_type;
        $data->remark = $request->remark;
        $data->term_id = $term_id;
        $data->session_id = $session_id;
        $data->start_date = $request->start_date;
        $data->end_date = $request->end_date;
        $data->school_id = $school_id;
        $final = $data->save();

        if ($final) {
            $notification = array(
                    'message' => 'Leave Data Added Successful'
                );
            return redirect()->route('admin.leave.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Operation Failed'
                );
            return redirect()->back()->with($notification);
        }

        // return redirect()->route('admin.leave.index');
    }

    public function edit(Leave $leave)
    {
        abort_if(Gate::denies('leave_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $staffs = Staff::where('school_id', Auth::User()->school_id)->get();        
        
        return view('admin.leave.edit', compact('staffs', 'leave'));
    }

    public function update(UpdateLeaveRequest $request, Leave $leave)
    {
        if (Auth::User()->is_teacher) {
            $staff_id = Staff::where('user_id', Auth::User()->id)->pluck('id')->first();
        } else {
            $staff_id = $request->staff_id;
        }
        
        // dd($staff_id);
        $leave->staff_id = $staff_id;
        $leave->status = $request->status;
        $leave->contact_number = $request->contact_number;
        $leave->address = $request->address;
        $leave->number_of_days = $request->number_of_days;
        $leave->leave_type = $request->leave_type;
        $leave->remark = $request->remark;
        $leave->start_date = $request->start_date;
        $leave->end_date = $request->end_date;
        $final = $leave->update();

        if ($final) {
            $notification = array(
                    'message' => 'Leave Data Updated Successful'
                );
            return redirect()->route('admin.leave.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Operation Failed'
                );
            return redirect()->back()->with($notification);
        }

        // return redirect()->route('admin.leave.index');
    }

    public function show(Leave $leave)
    {
        abort_if(Gate::denies('leave_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.leave.show', compact('leave'));
    }

    public function destroy(Leave $leave)
    {
        abort_if(Gate::denies('leave_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $leave->delete();

        return back();
    }

    public function massDestroy(MassDestroyLeaveRequest $request)
    {
        Leave::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
