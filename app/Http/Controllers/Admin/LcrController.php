<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyLcrRequest;
use App\Http\Requests\StoreLcrRequest;
use App\Http\Requests\UpdateLcrRequest;
use App\Classroom;
use App\Atlas;
use App\StudentAdmission;
use App\LeaveCertificateRecord;
use App\ParentGuardianregister;
use Gate;
use App\Term;
use App\Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Auth;

class LcrController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
       abort_if(Gate::denies('lcr_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = LeaveCertificateRecord::where('team_id', $request->school)->select(sprintf('%s.*', (new LeaveCertificateRecord)->table));
            $table = Datatables::of($query);

            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'lcr_show';
                $editGate      = 'lcr_edit';
                $deleteGate    = 'lcr_delete';
                $crudRoutePart = 'leave-certificate-records';

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
            $table->addColumn('certificate_number', function ($row) {
                return $row->certificate_number ? $row->certificate_number : '';
            });

            $table->editColumn('date_of_graduation', function ($row) {
                return $row->date_of_graduation ? $row->date_of_graduation : "";
            });
            $table->editColumn('headteacher_name', function ($row) {
                return $row->headteacher_name ? $row->headteacher_name : "";
            });
            $table->editColumn('headteacher_phone', function ($row) {
                return $row->headteacher_phone ? $row->headteacher_phone : "";
            });

            $table->rawColumns(['actions', 'income_category']);

            return $table->make(true);
        }
        $country_list = Atlas::select('name_atlas_entity', 'code_atlas_entity')
                        ->where('code_ds_atlas_entity', 1)
                        ->groupBy('code_atlas_entity','name_atlas_entity')
                        ->get();

        return view('admin.lcr.index', compact('country_list'));
    }

    public function create()
    {
       abort_if(Gate::denies('lcr_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parentGuardian = ParentGuardianregister::all();
        $studentAdmission = StudentAdmission::all();        
        $classroom = Classroom::all();

        return view('admin.lcr.create', compact('parentGuardian', 'studentAdmission', 'classroom'));
    }

    public function store(StoreLcrRequest $request)
    {
        // $lcr = LeaveCertificateRecord::create($request->all());
        $term_id = Term::where('active_status', 1)->get();
        $session_id = Session::where('active_status', 1)->get();

        $team_id = Auth::User()->team_id;

        $data = new LeaveCertificateRecord();
        $data->student_id = $request->student_id;
        $data->certificate_number = $request->certificate_number;
        $data->date_of_graduation = $request->date_of_graduation;
        $data->last_class_passed_id = $request->last_class_passed_id;
        $data->parent_guardian_id = $request->parent_guardian_id;
        $data->headteacher_name = $request->headteacher_name;
        $data->headteacher_phone = $request->headteacher_phone;
        $data->team_id = $team_id;
        $data->term_id = $term_id[0]->id;
        $data->session_id = $session_id[0]->id;
        $final = $data->save();

        if ($final) {
            $notification = array(
                    'message' => 'Operation Successful'
                );
            return redirect()->route('admin.leave-certificate-records.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Operation Failed'
                );
            return redirect()->back()->with($notification);
        }

        // return redirect()->route('admin.leave-certificate-records.index');
    }

    public function edit(LeaveCertificateRecord $leaveCertificateRecord)
    {
        abort_if(Gate::denies('lcr_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $studentAdmission = StudentAdmission::all();
        $parentGuardian = ParentGuardianregister::all();
        $classroom = Classroom::all();

        return view('admin.lcr.edit', compact('parentGuardian', 'studentAdmission', 'classroom', 'leaveCertificateRecord'));
    }

    public function update(UpdateLcrRequest $request, LeaveCertificateRecord $leaveCertificateRecord)
    {
        // $leaveCertificateRecord->update($request->all());

        $data = LeaveCertificateRecord::find($leaveCertificateRecord->id);
        $data->student_id = $request->student_id;
        $data->certificate_number = $request->certificate_number;
        $data->date_of_graduation = $request->date_of_graduation;
        $data->last_class_passed_id = $request->last_class_passed_id;
        $data->parent_guardian_id = $request->parent_guardian_id;
        $data->headteacher_name = $request->headteacher_name;
        $data->headteacher_phone = $request->headteacher_phone;
        $final = $data->update();

        if ($final) {
            $notification = array(
                    'message' => 'Operation Successful'
                );
            return redirect()->route('admin.leave-certificate-records.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Operation Failed'
                );
            return redirect()->back()->with($notification);
        }

        // return redirect()->route('admin.leave-certificate-records.index');
    }

    public function show(LeaveCertificateRecord $leaveCertificateRecord)
    {
        abort_if(Gate::denies('lcr_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.lcr.show', compact('leaveCertificateRecord'));
    }

    public function destroy(LeaveCertificateRecord $leaveCertificateRecord)
    {
        abort_if(Gate::denies('lcr_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $leaveCertificateRecord->delete();

        return back();
    }

    public function massDestroy(MassDestroyLcrRequest $request)
    {
        LeaveCertificateRecord::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
