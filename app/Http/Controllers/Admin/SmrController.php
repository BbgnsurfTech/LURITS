<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassSmrRequest;
use App\Http\Requests\StoreSmrRequest;
use App\Http\Requests\UpdateSmrRequest;
use App\Atlas;
use App\Smr;
use App\Staff;
use App\DsRank;
use App\AtlasLink;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use App\Session;
use App\SchoolAtlas;
use App\School;
use App\Term;

class SmrController extends Controller
{
   use CsvImportTrait;

    public function index(Request $request)
    {
       abort_if(Gate::denies('smr_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Smr::where('school_id', $request->school)->select(sprintf('%s.*', (new Smr)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'smr_show';
                $editGate      = 'smr_edit';
                $deleteGate    = 'smr_delete';
                $crudRoutePart = 'smr';

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
            $table->addColumn('contact_number', function ($row) {
                return $row->contact_number ? $row->contact_number : '';
            });
            $table->editColumn('purpose', function ($row) {
                return $row->purpose ? $row->purpose : "";
            });
            $table->editColumn('time_out', function ($row) {
                return $row->time_out ? $row->time_out : "";
            });
            $table->editColumn('time_back', function ($row) {
                return $row->time_back ? $row->time_back : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.smr.index');
    }

    public function getSmr(Request $request)
    {
        $school_id = Auth::User()->school_id;
        if ($request->ajax()) {
            $query = Smr::where('school_id', $school_id)->select(sprintf('%s.*', (new Smr)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'smr_show';
                $editGate      = 'smr_edit';
                $deleteGate    = 'smr_delete';
                $crudRoutePart = 'smr';

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
            $table->addColumn('contact_number', function ($row) {
                return $row->contact_number ? $row->contact_number : '';
            });
            $table->editColumn('purpose', function ($row) {
                return $row->purpose ? $row->purpose : "";
            });
            $table->editColumn('time_out', function ($row) {
                return $row->time_out ? $row->time_out : "";
            });
            $table->editColumn('time_back', function ($row) {
                return $row->time_back ? $row->time_back : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }
    }

    public function create()
    {
       abort_if(Gate::denies('smr_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // if (Auth::User()->is_superAdmin || Auth::User()->is_admin) {
        //     abort(401);
        // }
        $staffs = Staff::where('school_id', Auth::User()->school_id)->get();
        $ranks = DsRank::pluck('title', 'id');

        return view('admin.smr.create', compact('staffs', 'ranks'));
    }

    public function store(StoreSmrRequest $request)
    {
        // $smr = Smr::create($request->all());
        $term_id = Term::where('active_status', 1)->select('id')->get();
        $session_id = Session::where('active_status', 1)->select('id')->get();
        
        $data = new Smr();
        $data->date = $request->date;
        $data->staff_id = $request->staff_id;
        $data->contact_number = $request->contact_number;
        $data->purpose = $request->purpose;
        $data->time_out = $request->time_out;
        $data->time_back = $request->time_back;
        $data->ht_approval = $request->ht_approval;
        $data->school_id = Auth::User()->school_id;
        $data->term_id = $term_id[0]->id;
        $data->session_id = $session_id[0]->id;
        $final = $data->save();

        if ($final) {
            session()->flash('message', 'Staff Movement Record Added Successfully');
            return redirect()->route('admin.smr.index');
        } else {
            session()->flash('error', 'Operation Failed');
            return redirect()->back();
        }

        // return redirect()->route('admin.smr.index');
    }

    public function edit(Smr $smr)
    {
        abort_if(Gate::denies('smr_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $staffs = Staff::where('school_id', Auth::User()->school_id)->get();
        $ranks = DsRank::all();

        return view('admin.smr.edit', compact('staffs', 'ranks', 'smr'));
    }

    public function update(UpdateSmrRequest $request, Smr $smr)
    {
        // $smr->update($request->all());

        $data = Smr::find($smr->id);
        $data->date = $request->date;
        $data->staff_id = $request->staff_id;
        $data->contact_number = $request->contact_number;
        $data->purpose = $request->purpose;
        $data->time_out = $request->time_out;
        $data->time_back = $request->time_back;
        $data->ht_approval = $request->ht_approval;
        $final = $data->update();

        if ($final) {
            session()->flash('message', 'Staff Movement Record Updated Successfully');
            return redirect()->route('admin.smr.index');
        } else {
            session()->flash('error', 'Operation Failed');
            return redirect()->back();
        }

        // return redirect()->route('admin.smr.index');
    }

    public function show(Smr $smr)
    {
        abort_if(Gate::denies('smr_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        //dd($smr);

        return view('admin.smr.show', compact('smr'));
    }

    public function destroy(Smr $smr)
    {
        abort_if(Gate::denies('smr_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $smr->delete();

        session()->flash('message', 'Staff Movement Record Deleted Successfully');
        return redirect()->back();
    }

    public function massDestroy(MassDestroySmrRequest $request)
    {
        Smr::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
