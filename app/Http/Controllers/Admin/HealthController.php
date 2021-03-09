<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyHealthRequest;
use App\Http\Requests\StoreHealthRequest;
use App\Http\Requests\UpdateHealthRequest;
use App\Health;
use App\Atlas;
use App\StudentAdmission;
use Gate;
use App\Term;
use App\Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Auth;

class HealthController extends Controller
{
    use CsvImportTrait;
        
    public function index(Request $request)
    {
       abort_if(Gate::denies('health_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Health::where('team_id', $request->school)->select(sprintf('%s.*', (new Health)->table));
            $table = Datatables::of($query);

            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'health_show';
                $editGate      = 'health_edit';
                $deleteGate    = 'health_delete';
                $crudRoutePart = 'health';

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
            $table->addColumn('date', function ($row) {
                return $row->date ? $row->date : '';
            });

            $table->editColumn('type', function ($row) {
                return $row->type ? $row->type : "";
            });
            $table->editColumn('prescription', function ($row) {
                return $row->prescription ? $row->prescription : "";
            });
            $table->editColumn('cause', function ($row) {
                return $row->cause ? $row->cause : "";
            });
            $table->addColumn('followup', function ($row) {
                return $row->followup ? $row->followup : '';
            });

            $table->editColumn('remark', function ($row) {
                return $row->remark ? $row->remark : "";
            });

            $table->rawColumns(['actions', 'expense_category']);

            return $table->make(true);
        }
        $country_list = Atlas::select('name_atlas_entity', 'code_atlas_entity')
                        ->where('code_ds_atlas_entity', 1)
                        ->groupBy('code_atlas_entity','name_atlas_entity')
                        ->get();

        return view('admin.health.index', compact('country_list'));
    }

    public function create()
    {
       abort_if(Gate::denies('health_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentAdmission = StudentAdmission::all();        
        
        return view('admin.health.create', compact('studentAdmission'));
    }

    public function store(StoreHealthRequest $request)
    {
        // $health = Health::create($request->all());
        $term_id = Term::where('active_status', 1)->get();
        $session_id = Session::where('active_status', 1)->get();

        $team_id = Auth::User()->team_id;

        $data = new Health();
        $data->date = $request->date;
        $data->student_id = $request->student_id;
        $data->type = $request->type;
        $data->prescription = $request->prescription;
        $data->cause = $request->cause;
        $data->followup = $request->followup;
        $data->remark = $request->remark;
        $data->team_id = $team_id;
        $data->term_id = $term_id[0]->id;
        $data->session_id = $session_id[0]->id;
        $final = $data->save();

        if ($final) {
            $notification = array(
                    'message' => 'Operation Successful'
                );
            return redirect()->route('admin.health.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Operation Failed'
                );
            return redirect()->back()->with($notification);
        }

        // return redirect()->route('admin.health.index');
    }

    public function edit(Health $health)
    {
        abort_if(Gate::denies('health_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $studentAdmission = StudentAdmission::all();        
        
        return view('admin.health.edit', compact('health', 'studentAdmission'));
    }

    public function update(UpdateHealthRequest $request, Health $health)
    {
        // $health->update($request->all());

        $data = Health::find($health->id);
        $data->date = $request->date;
        $data->student_id = $request->student_id;
        $data->type = $request->type;
        $data->prescription = $request->prescription;
        $data->cause = $request->cause;
        $data->followup = $request->followup;
        $data->remark = $request->remark;
        $final = $data->update();

        if ($final) {
            $notification = array(
                    'message' => 'Operation Successful'
                );
            return redirect()->route('admin.health.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Operation Failed'
                );
            return redirect()->back()->with($notification);
        }

        // return redirect()->route('admin.health.index');
    }

    public function show(Health $health)
    {
        abort_if(Gate::denies('health_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.health.show', compact('health'));
    }

    public function destroy(Health $health)
    {
        abort_if(Gate::denies('health_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $health->delete();

        return back();
    }

    public function massDestroy(MassDestroyHealthRequest $request)
    {
        Health::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
