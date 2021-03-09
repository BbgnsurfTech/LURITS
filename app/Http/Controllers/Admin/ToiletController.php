<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyToiletRequest;
use App\Http\Requests\StoreToiletRequest;
use App\Http\Requests\UpdateToiletRequest;
use App\Toilet;
use App\School;
use App\Atlas;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use App\Term;
use App\Session;
use App\DsClassroomCondition;
use App\DsClassroomFloorMaterial;
use App\DsClassroomWallMaterial;
use App\DsClassroomRoofMaterial;
use App\DsYesNo;
use App\DsToilet;
use App\DsUserToilet;
use App\DsToiletUsage;

class ToiletController extends Controller
{
    use CsvImportTrait;
    
    public function index(Request $request)
    {
        // abort_if(Gate::denies('toilet_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        if ($request->ajax()) {
            
            $query = Toilet::where('school_id', $request->school)->select(sprintf('%s.*', (new Toilet)->table));
            // dd($query);
            $table = Datatables::of($query);

            $table->addColumn('actions', '&nbsp;');
            $table->addColumn('placeholder', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'toilet_show';
                $editGate      = 'toilet_edit';
                $deleteGate    = 'toilet_delete';
                $crudRoutePart = 'toilets';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('year_construction', function ($row) {
                return $row->year_construction ? $row->year_construction : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.toilet.index');
    }

    public function getToilets(Request $request)
    {
        $school_id = Auth::User()->school_id;
        if ($request->ajax()) {
            
            $query = Toilet::where('school_id', $school_id)->select(sprintf('%s.*', (new Toilet)->table));
            $table = Datatables::of($query);

            $table->addColumn('actions', '&nbsp;');
            $table->addColumn('placeholder', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'toilet_show';
                $editGate      = 'toilet_edit';
                $deleteGate    = 'toilet_delete';
                $crudRoutePart = 'toilets';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('year', function ($row) {
                return $row->year ? $row->year : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }
    }

    public function create()
    {
        abort_if(Gate::denies('toilet_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ds_toilet = DsToilet::all();
        $ds_user_toilet = DsUserToilet::all();
        $ds_toilet_usage = DsToiletUsage::all();
        $conditions = DsClassroomCondition::all();

        return view('admin.toilet.create', compact('conditions', 'ds_toilet', 'ds_user_toilet', 'ds_toilet_usage'));
    }

    public function store(Request $request)
    {
        if (Auth::User()->is_headTeacher) {
            $school = Auth::User()->school_id;
        } else {
            $request->validate([
                "school" => "required",
            ]);
            $school = $request->school;
        }

        $session_id = Session::where('active_status', 1)->pluck('id')->first();
        //dd($term_id);

        $data_id = Toilet::where('school_id', $school)->max('id') + 1;
        // dd($data_id);
        if ($data_id == 1) {
            $model_id = str_pad($school, 15, "0", STR_PAD_RIGHT).$data_id;
        } else {
            $model_id = $data_id;
        }

        $toilet = new Toilet();
        $toilet->id = $model_id;
        $toilet->year_construction = $request->year;
        $toilet->ds_condition_id = $request->condition;
        $toilet->ds_user_toilet_id = $request->user_toilet;
        $toilet->ds_toilet_id = $request->toilet_type;
        $toilet->ds_toilet_usage_id = $request->toilet_usage;
        $toilet->school_id = $school;
        $toilet->session_id = $session_id;
        $final = $toilet->save();

        if ($final) {
            session()->flash('message', 'Toilet Data Added Successfully');
            return redirect()->route('admin.toilets.index');
        } else {
            session()->flash('error', 'Operation Failed');
            return redirect()->back();
        }
        
    }

    public function show(Toilet $toilet)
    {
        abort_if(Gate::denies('toilet_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $toilet->load('school', 'toiletCondition', 'toiletUser', 'toiletType', 'toiletUsage');

        return view('admin.toilet.show', compact('toilet'));
    }

    public function edit(Toilet $toilet)
    {
        abort_if(Gate::denies('toilet_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ds_toilet = DsToilet::all();
        $ds_user_toilet = DsUserToilet::all();
        $ds_toilet_usage = DsToiletUsage::all();
        $conditions = DsClassroomCondition::all();

        return view('admin.toilet.edit', compact('conditions', 'ds_toilet', 'ds_user_toilet', 'ds_toilet_usage', 'toilet'));
    }

    public function update(Request $request, Toilet $toilet)
    {
        if (Auth::User()->is_headTeacher) {
            $school_id = Auth::User()->school_id;
        } else {
            $request->validate([
                "school" => "required",
            ]);
            $school_id = $request->school;
        }

        $toilet->year_construction = $request->year;
        $toilet->ds_condition_id = $request->condition;
        $toilet->ds_user_toilet_id = $request->user_toilet;
        $toilet->ds_toilet_id = $request->toilet_type;
        $toilet->ds_toilet_usage_id = $request->toilet_usage;
        $toilet->school_id = $school_id;
        $final = $toilet->update();

        if ($final) {
            session()->flash('message', 'Toilet Data Updated Successfully');
            return redirect()->route('admin.toilets.index');
        } else {
            session()->flash('error', 'Operation Failed');
            return redirect()->back();
        }
    }

    public function destroy(Toilet $toilet)
    {
        abort_if(Gate::denies('toilet_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $toilet->delete();

        return back();
    }
    
    public function massDestroy(MassDestroyClassroomRequest $request)
    {
        Toilet::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }    
}
