<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassVisitorsRequest;
use App\Http\Requests\StoreVisitorsRequest;
use App\Http\Requests\UpdateVisitorsRequest;
use App\Visitor;
use Gate;
use App\Term;
use App\Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Atlas;
use Yajra\DataTables\Facades\DataTables;
use Auth;

class VisitorsController extends Controller
{
   use CsvImportTrait;

    public function index(Request $request)
    {
       abort_if(Gate::denies('visitors_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            
            $query = Visitor::where('team_id', $request->school)->select(sprintf('%s.*', (new Visitor)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'visitors_show';
                $editGate      = 'visitors_edit';
                $deleteGate    = 'visitors_delete';
                $crudRoutePart = 'visitors';

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
            $table->editColumn('visitors_name', function ($row) {
                return $row->visitors_name ? $row->visitors_name : "";
            });
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : "";
            });
            $table->editColumn('purpose', function ($row) {
                return $row->purpose ? $row->purpose : "";
            });
            $table->editColumn('remark', function ($row) {
                return $row->remark ? $row->remark : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }
        $country_list = Atlas::select('name_atlas_entity', 'code_atlas_entity')
                        ->where('code_ds_atlas_entity', 1)
                        ->groupBy('code_atlas_entity','name_atlas_entity')
                        ->get();

        return view('admin.visitors.index', compact('country_list'));
    }

    public function create()
    {
       abort_if(Gate::denies('visitors_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $visitors = Visitor::all();        

        return view('admin.visitors.create', compact('visitors'));
    }

    public function store(StoreVisitorsRequest $request)
    {
        // $visitors = Visitor::create($request->all());
        $term_id = Term::where('active_status', 1)->get();
        $session_id = Session::where('active_status', 1)->get();

        $team_id = Auth::User()->team_id;

        $data = new Visitor();
        $data->date = $request->date;
        $data->visitors_name = $request->visitors_name;
        $data->address = $request->address;
        $data->purpose = $request->purpose;
        $data->phone = $request->phone;
        $data->remark = $request->remark;
        $data->team_id = $team_id;
        $data->term_id = $term_id[0]->id;
        $data->session_id = $session_id[0]->id;
        $final = $data->save();

        if ($final) {
            $notification = array(
                    'message' => 'Operation Successful'
                );
            return redirect()->route('admin.visitors.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Operation Failed'
                );
            return redirect()->back()->with($notification);
        }

        // return redirect()->route('admin.visitors.index');
    }

    public function edit(Visitor $visitor)
    {
        abort_if(Gate::denies('visitors_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        return view('admin.visitors.edit', compact('visitor'));
    }

    public function update(UpdateVisitorsRequest $request, Visitor $visitor)
    {
        // $visitor->update($request->all());

        $data = Visitor::find($visitor->id);
        $data->date = $request->date;
        $data->visitors_name = $request->visitors_name;
        $data->address = $request->address;
        $data->purpose = $request->purpose;
        $data->phone = $request->phone;
        $data->remark = $request->remark;
        $final = $data->update();

        if ($final) {
            $notification = array(
                    'message' => 'Operation Successful'
                );
            return redirect()->route('admin.visitors.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Operation Failed'
                );
            return redirect()->back()->with($notification);
        }

        // return redirect()->route('admin.visitors.index');
    }

    public function show(Visitor $visitor)
    {
        abort_if(Gate::denies('visitors_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.visitors.show', compact('visitor'));
    }

    public function destroy(Visitor $visitor)
    {
        abort_if(Gate::denies('visitors_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $visitor->delete();

        return back();
    }

    public function massDestroy(MassDestroyVisitorRequest $request)
    {
        Visitor::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
