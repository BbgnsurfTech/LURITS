<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyClassroomRequest;
use App\Http\Requests\StoreClassroomRequest;
use App\Http\Requests\UpdateClassroomRequest;
use App\Classroom;
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

class ClassroomController extends Controller
{
    use CsvImportTrait;
    
    public function index(Request $request)
    {
        abort_if(Gate::denies('classroom_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        if ($request->ajax()) {
            
            $query = Classroom::where('school_id', $request->school)->with(['school'])->select(sprintf('%s.*', (new Classroom)->table));
            $table = Datatables::of($query);

            $table->addColumn('actions', '&nbsp;');
            $table->addColumn('placeholder', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'classroom_show';
                $editGate      = 'classroom_edit';
                $deleteGate    = 'classroom_delete';
                $crudRoutePart = 'classrooms';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('capacity', function ($row) {
                return $row->capacity ? $row->capacity : "";
            });
            $table->editColumn('year', function ($row) {
                return $row->year ? $row->year : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $school = Auth::User()->schools()->get();

        return view('admin.classroom.index', compact('school'));
    }

    public function getClassroom(Request $request)
    {
        $school_id = Auth::User()->school_id;
        if ($request->ajax()) {
            
            $query = Classroom::where('school_id', $school_id)->select(sprintf('%s.*', (new Classroom)->table));
            $table = Datatables::of($query);

            $table->addColumn('actions', '&nbsp;');
            $table->addColumn('placeholder', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'classroom_show';
                $editGate      = 'classroom_edit';
                $deleteGate    = 'classroom_delete';
                $crudRoutePart = 'classrooms';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('capacity', function ($row) {
                return $row->capacity ? $row->capacity : "";
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
        abort_if(Gate::denies('classroom_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $conditions = DsClassroomCondition::all();
        $floor_materials = DsClassroomFloorMaterial::all();
        $wall_materials = DsClassroomWallMaterial::all();
        $roof_materials = DsClassroomRoofMaterial::all();
        $yes_no = DsYesNo::all();

        return view('admin.classroom.create', compact('conditions', 'floor_materials', 'wall_materials', 'roof_materials', 'yes_no'));
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

        $term_id = Term::where('active_status', 1)->select('id')->get();
        $session_id = Session::where('active_status', 1)->select('id')->get();
        //dd($term_id);

        $data_id = Classroom::where('school_id', $school)->max('id') + 1;
        // dd($data_id);
        if ($data_id == 1) {
            $model_id = str_pad($school, 15, "0", STR_PAD_RIGHT).$data_id;
        } else {
            $model_id = $data_id;
        }

        $classroom = new Classroom();
        $classroom->id = $model_id;
        $classroom->capacity = $request->capacity;
        $classroom->current_capacity = $request->current_capacity;
        $classroom->year = $request->year;
        $classroom->condition = $request->condition;
        $classroom->length = $request->length;
        $classroom->width = $request->width;
        $classroom->floor_material = $request->floor_material;
        $classroom->wall_material = $request->wall_material;
        $classroom->roof_material = $request->roof_material;
        $classroom->seating = $request->seating;
        $classroom->writing_board = $request->writing_board;
        $classroom->school_id = $school;
        $classroom->term_id = $term_id[0]->id;
        $classroom->session_id = $session_id[0]->id;
        $final = $classroom->save();

        if ($final) {
            session()->flash('message', 'Classroom Data Added Successfully');
            return redirect()->route('admin.classrooms.index');
        } else {
            session()->flash('error', 'Operation Failed');
            return redirect()->back();
        }
        
    }

    public function show(Classroom $classroom)
    {
        abort_if(Gate::denies('classroom_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $classroom->load('school', 'classCondition', 'floorMaterial', 'wallMaterial', 'roofMaterial', 'availableSeating', 'writingBoard');

        return view('admin.classroom.show', compact('classroom'));
    }

    public function edit(Classroom $classroom)
    {
        abort_if(Gate::denies('classroom_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $school_enrolleds = School::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $classroom->load('school');
        $conditions = DsClassroomCondition::all()->pluck('title', 'id');
        $floor_materials = DsClassroomFloorMaterial::all()->pluck('title', 'id');
        $wall_materials = DsClassroomWallMaterial::all()->pluck('title', 'id');
        $roof_materials = DsClassroomRoofMaterial::all()->pluck('title', 'id');
        $yes_no = DsYesNo::all()->pluck('title', 'id');

        return view('admin.classroom.edit', compact('school_enrolleds', 'classroom', 'conditions', 'floor_materials', 'wall_materials', 'roof_materials', 'yes_no'));
    }

    public function update(Request $request, Classroom $classroom)
    {
        if (Auth::User()->is_headTeacher) {
            $school_id = Auth::User()->school_id;
        } else {
            $request->validate([
                "school" => "required",
            ]);
            $school_id = $request->school;
        }

        $classroom->capacity = $request->capacity;
        $classroom->current_capacity = $request->current_capacity;
        $classroom->year = $request->year;
        $classroom->condition = $request->condition;
        $classroom->length = $request->length;
        $classroom->width = $request->width;
        $classroom->floor_material = $request->floor_material;
        $classroom->wall_material = $request->wall_material;
        $classroom->roof_material = $request->roof_material;
        $classroom->seating = $request->seating;
        $classroom->writing_board = $request->writing_board;
        $classroom->school_id = $school_id;
        $final = $classroom->update();

        if ($final) {
            session()->flash('message', 'Classroom Data Added Successfully');
            return redirect()->route('admin.classrooms.index');
        } else {
            session()->flash('error', 'Operation Failed');
            return redirect()->back();
        }
    }

    public function destroy(Classroom $classroom)
    {
        abort_if(Gate::denies('classroom_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $classroom->delete();
        session()->flash('message', 'Classroom Data Deleted Successfully');

        return back();
    }
    
    public function massDestroy(MassDestroyClassroomRequest $request)
    {
        Classroom::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }    
}
