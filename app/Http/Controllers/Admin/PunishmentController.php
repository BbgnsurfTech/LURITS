<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPunishmentRequest;
use App\Http\Requests\StorePunishmentRequest;
use App\Http\Requests\UpdatePunishmentRequest;
use App\Classroom;
use App\Punishment;
use App\StudentAdmission;
use App\Teacher;
use App\Atlas;
use Gate;
use App\Term;
use App\Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Auth;

class PunishmentController extends Controller
{
   use CsvImportTrait;

    public function index(Request $request)
    {
       abort_if(Gate::denies('punishment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Punishment::where('team_id', $request->school)->select(sprintf('%s.*', (new Punishment)->table));
            $table = Datatables::of($query);

            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'punishment_show';
                $editGate      = 'punishment_edit';
                $deleteGate    = 'punishment_delete';
                $crudRoutePart = 'punishment';

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
            $table->editColumn('date', function ($row) {
                return $row->date ? $row->date : "";
            });
            $table->addColumn('offence', function ($row) {
                return $row->offence ? $row->offence : '';
            });
            $table->editColumn('punishment', function ($row) {
                return $row->punishment ? $row->punishment : "";
            });
            $table->editColumn('remark', function ($row) {
                return $row->remark ? $row->remark : "";
            });

            $table->rawColumns(['actions']);

            return $table->make(true);
        }
        $country_list = Atlas::select('name_atlas_entity', 'code_atlas_entity')
                        ->where('code_ds_atlas_entity', 1)
                        ->groupBy('code_atlas_entity','name_atlas_entity')
                        ->get();
        return view('admin.punishment.index', compact('country_list'));
    }

    public function create()
    {
       abort_if(Gate::denies('punishment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        //$punishment = Punishment::all();
        $studentAdmission = StudentAdmission::all();        
        $classroom = Classroom::all();
        $teachers = Teacher::all();

        //dd($punishment);
        return view('admin.punishment.create', compact('studentAdmission', 'classroom', 'teachers'));
    }

    public function store(StorePunishmentRequest $request)
    {
        $term_id = Term::where('active_status', 1)->get();
        $session_id = Session::where('active_status', 1)->get();
        // $punishment = Punishment::create($request->all());

        $team_id = Auth::User()->team_id;

        $data = new Result();
        $data->date = $request->date;
        $data->student_id = $request->student_id;
        $data->age = $request->age;
        $data->punished_by = $request->punished_by;
        $data->remark = $request->remark;
        $data->punishment = $request->punishment;
        $data->offence = $request->offence;
        $data->team_id = $team_id;
        $data->term_id = $term_id[0]->id;
        $data->session_id = $session_id[0]->id;
        $final = $data->save();

        if ($final) {
            $notification = array(
                    'message' => 'Operation Successful'
                );
            return redirect()->route('admin.punishment.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Operation Failed'
                );
            return redirect()->back()->with($notification);
        }

        // return redirect()->route('admin.punishment.index');
    }

    public function edit(Punishment $punishment)
    {
        abort_if(Gate::denies('punishment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $studentAdmission = StudentAdmission::all();        
        $classroom = Classroom::all();
        $teachers = Teacher::all();
        
       // dd($punishment);

        return view('admin.punishment.edit', compact('punishment', 'studentAdmission', 'classroom', 'teachers'));
    }

    public function update(UpdatePunishmentRequest $request, Punishment $punishment)
    {
        // $punishment->update($request->all());

        $data = Punishment::find($punishment->id);
        $data->date = $request->date;
        $data->student_id = $request->student_id;
        $data->age = $request->age;
        $data->punished_by = $request->punished_by;
        $data->remark = $request->remark;
        $data->punishment = $request->punishment;
        $data->offence = $request->offence;
        $final = $data->update();

        if ($final) {
            $notification = array(
                    'message' => 'Operation Successful'
                );
            return redirect()->route('admin.punishment.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Operation Failed'
                );
            return redirect()->back()->with($notification);
        }

        // return redirect()->route('admin.punishment.index');
    }

    public function show(Punishment $punishment)
    {
        abort_if(Gate::denies('punishment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        //dd($punishment);

        return view('admin.punishment.show', compact('punishment'));
    }

    public function destroy(Punishment $punishment)
    {
        abort_if(Gate::denies('punishment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $punishment->delete();

        return back();
    }

    public function massDestroy(MassDestroyPunishmentRequest $request)
    {
        Punishment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
