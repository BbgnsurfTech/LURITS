<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyTransferRequest;
use App\Http\Requests\StoreTransferRequest;
use App\Http\Requests\UpdateTransferRequest;
use App\Classroom;
use App\StudentAdmission;
use App\DsClass;
use App\Transfer;
use App\Session;
use App\SchoolAtlas;
use App\Term;
use App\School;
use App\SchoolClass;
use App\Notifications\TransferNotification;
use Gate;
use App\AtlasLink;
use App\Atlas;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use App\Staff;
use DB;
use App\User;
use App\DsClassSector;

class TransferController extends Controller
{
   use CsvImportTrait;

    public function index(Request $request)
    {
       abort_if(Gate::denies('student_transfer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            
            $query = Transfer::where('old_school', $request->school)->select(sprintf('%s.*', (new Transfer)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'student_transfer_show';
                $editGate      = 'student_transfer_edit';
                $deleteGate    = 'student_transfer_delete';
                $crudRoutePart = 'transfer';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('certificate_number', function ($row) {
                return $row->certificate_number ? $row->certificate_number : "";
            });
            $table->editColumn('pupils_conduct', function ($row) {
                return $row->pupils_conduct ? $row->pupils_conduct : "";
            });
            $table->editColumn('reason_for_leaving', function ($row) {
                return $row->reason_for_leaving ? $row->reason_for_leaving : "";
            });
            $table->editColumn('last_attendance_date', function ($row) {
                return $row->last_attendance_date ? $row->last_attendance_date : "";
            });
            $table->editColumn('headteacher_name', function ($row) {
                return $row->headteacher_name ? $row->headteacher_name : "";
            });
            $table->editColumn('headteacher_phone', function ($row) {
                return $row->headteacher_phone ? $row->headteacher_phone : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }
        
        return view('admin.transfer.index');
    }

    public function getTransfer(Request $request)
    {
        $school_id = Auth::User()->school_id;
        if ($request->ajax()) {
            
            $query = Transfer::where('old_school', $school_id)->select(sprintf('%s.*', (new Transfer)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'transfer_show';
                $editGate      = 'transfer_edit';
                $deleteGate    = 'transfer_delete';
                $crudRoutePart = 'transfer';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('reason_for_leaving', function ($row) {
                return $row->reason_for_leaving ? $row->reason_for_leaving : "";
            });
            $table->editColumn('pupils_conduct', function ($row) {
                return $row->pupils_conduct ? $row->pupils_conduct : "";
            });
            $table->editColumn('last_attendance_date', function ($row) {
                return $row->last_attendance_date ? $row->last_attendance_date : "";
            });
            $table->editColumn('headteacher_name', function ($row) {
                return $row->headteacher_name ? $row->headteacher_name : "";
            });
            $table->editColumn('headteacher_phone', function ($row) {
                return $row->headteacher_phone ? $row->headteacher_phone : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }
    }

    public function create()
    {
       abort_if(Gate::denies('student_transfer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        //dd($classroom->classTitle);
        // $studentAdmission = StudentAdmission::where('school_enrolled_id', Auth::User()->school_id)->get();
        if (Auth::User()->is_headTeacher) {
            $sector_classes = DsClassSector::where('sector_id', Auth::User()->school->code_type_sector)->with('dsClass')->get();
        } else {
            $sector_classes = null;
        }
        // dd($sector_classes);
        return view('admin.transfer.create', compact('sector_classes'));
    }

    public function initialize()
    {
        # code...
    }

    public function ini($value='')
    {
        # code...
    }

    public function request()
    {
        if (Auth::User()->is_headTeacher) {

            return view('admin.transfer.request');
        } else {
            abort(404);
        }
    }

    public function storeRequest(Request $request)
    {
        $term_id = Term::where('active_status', 1)->select('id')->get();
        $session_id = Session::where('active_status', 1)->select('id')->get();
        
        $data = new Transfer();
        $data->student_id = $request->student_id;
        $data->class_id = $request->classs;
        // $data->last_class_attended = $request->last_class_attended;
        // $data->pupils_conduct = $request->pupils_conduct;
        // $data->reason_for_leaving = $request->reason_for_leaving;
        // $data->last_attendace_date = $request->last_attendance_date;
        $data->old_school = $request->school;
        $data->new_school = Auth::User()->school_id;
        // $data->headteacher_name = $request->headteacher_name;
        // $data->headteacher_phone = $request->headteacher_phone;
        $data->term_id = $term_id[0]->id;
        $data->session_id = $session_id[0]->id;
        $final = $data->save();
        
        if ($final) {
            session()->flash('message', 'Student Transfer Successful, Contact the destination school to accept the transfer');
            return redirect()->route('admin.transfer.index');
        } else {
            session()->flash('error', 'Operation Failed');
            return redirect()->back();
        }

    }

    public function store(StoreTransferRequest $request)
    {
        // dd($request->all());
        if ($request->last_attendance_date !== null) {
            $request->validate([
                'destination_school' => "required",
                'last_attendance_date' => "date_format:Y/m/d"
            ]);
        }

        if (!Auth::User()->is_headTeacher) {
            $request->validate([
                'school' => "required"
            ]);
            $old_school = $request->school;
        } else {
            $old_school = Auth::User()->school_id;
        }
        
        $destination_school = $request->destination_school;

        $term_id = Term::where('active_status', 1)->pluck('id')->first();
        $session_id = Session::where('active_status', 1)->pluck('id')->first();

        // $oldSchool = School::where('id', $request->school)->firstOrFail();
        // $newSchool = School::where('id', $request->destination_school)->firstOrFail();

        $oldSchoolHeadteacher = Staff::where('school_id', $old_school)
             ->where(function($q) {
                 $q->where('type_staff_id', 1)
                   ->orWhere('type_staff_id', 7);
             })
             ->pluck('user_id')->first();

        $newSchoolHeadTeacher = Staff::where('school_id', $destination_school)
             ->where(function($q) {
                 $q->where('type_staff_id', 1)
                   ->orWhere('type_staff_id', 7);
             })
             ->pluck('user_id')->first();
        
        DB::beginTransaction();
        try {
            $data = new Transfer();
            $data->student_id = $request->student_id;
            $data->class_id = $request->classs;
            $data->last_class_attended = $request->last_class_attended;
            $data->pupils_conduct = $request->pupils_conduct;
            $data->reason_for_leaving = $request->reason_for_leaving;
            $data->last_attendace_date = $request->last_attendance_date;
            $data->old_school = $request->school;
            $data->new_school = $request->destination_school;
            $data->headteacher_name = $request->headteacher_name;
            $data->headteacher_phone = $request->headteacher_phone;
            $data->term_id = $term_id;
            $data->session_id = $session_id;
            $final = $data->save();

            $transfer = StudentAdmission::where('id', $request->student_id)->firstOrFail();
            $transfer->school_enrolled_id = $destination_school;
            $transfer->update();

            // $user1 = User::findOrFail($oldSchoolHeadteacher);
            // $user2 = User::findOrFail($newSchoolHeadTeacher);
            
            // $user1->notify(new TransferNotification(User::findOrFail($oldSchoolHeadteacher)));
            // $user2->notify(new TransferNotification(User::findOrFail($newSchoolHeadTeacher)));
            
            DB::commit();
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            session()->flash('error', 'Operation Failed');
            return redirect()->back();
        }


        if ($final) {
            $notification = array(
                    'message' => 'Student Transfer Successful, Contact the destination school to accept the transfer'
                );
            return redirect()->route('admin.transfer.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Transfer Failed, Check the information and try again'
                );
            return redirect()->back()->with($notification);
        }
    }

    public function edit(Transfer $transfer)
    {
        abort_if(Gate::denies('student_transfer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $studentAdmission = StudentAdmission::all();
        $school_enrolleds = School::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $classroom = Classroom::all();
        if (Auth::User()->is_zeqa) {
            $a = Auth::User()->atlas;
            $stateLGA = AtlasLink::where('code_atlas_link', $a->atlas_id)->pluck('code_atlas_entity');
            $lga = Atlas::whereIn('code_atlas_entity', $stateLGA)->get();
        } else {
            $lga = null;
        }
       // dd($transfer);

        return view('admin.transfer.edit', compact('transfer', 'studentAdmission', 'school_enrolleds', 'classroom', 'lga'));
    }

    public function update(UpdateTransferRequest $request, Transfer $transfer)
    {
        // $transfer->update($request->all());

        $data = Transfer::find($transfer->id);
        $data->student_id = $request->student_id;
        $data->certificate_number = $request->certificate_number;
        $data->class_id = $request->class_id;
        $data->last_class_attended = $request->last_class_attended;
        $data->pupils_conduct = $request->pupils_conduct;
        $data->reason_for_leaving = $request->reason_for_leaving;
        $data->last_attendance_date = $request->last_attendance_date;
        $data->old_school = $request->old_school;
        $data->new_school = $request->new_school;
        $data->headteacher_name = $request->headteacher_name;
        $data->headteacher_phone = $request->headteacher_phone;
        $data->transfer_status = $request->status;
        $final = $data->update();

        if ($final) {
            $notification = array(
                    'message' => 'Student Transfer Updated Successfully'
                );
            return redirect()->route('admin.transfer.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Operation Failed'
                );
            return redirect()->back()->with($notification);
        }

        // return redirect()->route('admin.transfer.index');
    }

    public function show(Transfer $transfer)
    {
        abort_if(Gate::denies('student_transfer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        //dd($transfer);

        return view('admin.transfer.show', compact('transfer'));
    }

    public function destroy(Transfer $transfer)
    {
        abort_if(Gate::denies('student_transfer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transfer->delete();

        return back();
    }

    public function massDestroy(MassDestroyTransferRequest $request)
    {
        Transfer::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
