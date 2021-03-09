<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Atlas;
use App\DsFlow;
use App\School;
use App\SchoolAtlas;
use App\DsClass;
use Auth;
use App\Term;
use App\Session;
use App\StudentAdmission;
use Yajra\DataTables\Facades\DataTables;
use App\Promotion;
use App\AtlasLink;
use DB;
use App\SchoolClass;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = SchoolClass::where('school_id', Auth::User()->school_id)->with(['classTitle', 'armTitle'])->get();

        $flows = DsFlow::all()->pluck('title', 'id');
        if (Auth::User()->is_zeqa) {
            $a = Auth::User()->atlas;
            $stateLGA = AtlasLink::where('code_atlas_link', $a->atlas_id)->pluck('code_atlas_entity');
            $lga = Atlas::whereIn('code_atlas_entity', $stateLGA)->get();
        } else {
            $lga = null;
        }

        if (Auth::User()->is_lgea) {
            $a = Auth::User()->atlas;
            $b = $a->atlas_id;
            $schooll = SchoolAtlas::where('code_atlas_entity', $b)->pluck('school_id');
            $lgea = School::whereIn('id', $schooll)->where('code_type_sector', 1)->get();
        } else {
            $lgea = null;
        }

        $classrooms = DsClass::all();

        return view('admin.studentAdmissions.promotion-create', compact('flows', 'classes', 'classrooms'));
    }

    public function getAdmission(Request $request)
    {
        if ($request->ajax()) {
            
            $query = StudentAdmission::where('class_id', $request->classs)->select(sprintf('%s.*', (new StudentAdmission)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'student_admission_show';
                $editGate      = 'student_admission_edit';
                $deleteGate    = 'student_admission_delete';
                $crudRoutePart = 'student-admissions';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            
            $table->editColumn('child_name', function ($row) {
                return $row->child_name ? $row->child_name : "";
            });
            $table->editColumn('middle_name', function ($row) {
                return $row->middle_name ? $row->middle_name : "";
            });
            $table->editColumn('last_name', function ($row) {
                return $row->last_name ? $row->last_name : "";
            });
            $table->editColumn('admission', function ($row) {
                return $row->admission ? $row->admission : "";
            });
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = SchoolClass::where('school_id', Auth::User()->school_id)->with(['classTitle', 'armTitle'])->get();

        $flows = DsFlow::all()->pluck('title', 'id');

        return view('admin.studentAdmissions.promotion-create', compact('classes', 'flows'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $term_id = Term::where('active_status', 1)->pluck('id')->first();
        $session_id = Session::where('active_status', 1)->pluck('id')->first();

        if ($request->classs == $request->target_class) {
            // dd(true);
            session()->flash('error', 'Current class and Target class cannot be the same');
            return redirect()->back();
        }


        $students = StudentAdmission::where('school_enrolled_id', $request->school)->where('class_id', $request->classs)->select('id')->get();
        DB::beginTransaction();
        try {
            foreach ($students as $student) {
                $data_id = Promotion::where('school_id', $school)->max('id') + 1;
                // dd($data_id);
                if ($data_id == 1) {
                    $model_id = str_pad($school, 15, "0", STR_PAD_RIGHT).$data_id;
                } else {
                    $model_id = $data_id;
                }

                $data = new Promotion();
                $data->id = $model_id;
                $data->admission_id = $student->id;
                $data->flow_id = $request->flow;
                $data->current_class_id = $request->classs;
                $data->target_class_id = $request->target_class;
                $data->session_id = $term_id;
                $data->term = $session_id;
                $data->save();

                DB::table('student_admissions')
                    ->where('id',$student->id)
                    ->update([
                        'class_id' => $request->target_class,
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            //dd($e);
            DB::rollback();
            session()->flash('error', 'Operation Failed');
            return redirect()->back();
        }

        session()->flash('message', 'Student(s) Flow Added Successful');
        return redirect()->route('admin.promotion.index');
    }

    public function individual(Request $request)
    {
        //dd($request->all());

        $term_id = Term::where('active_status', 1)->select('id')->get();
        $session_id = Session::where('active_status', 1)->select('id')->get();

        DB::beginTransaction();
        try {

            $data = new Promotion();
            $data->admission_id = $request->student;
            $data->flow_id = $request->floww;
            $data->current_class_id = $request->clazz;
            $data->target_class_id = $request->target_classs;
            $data->session_id = $term_id[0]->id;
            $data->term = $session_id[0]->id;
            $data->save();

            DB::table('student_admissions')
                ->where('id',$request->student)
                ->update([
                    'class_id' => $request->target_classs,
            ]);
            

            DB::commit();
        } catch (\Exception $e) {
            //dd($e);
            DB::rollback();
            session()->flash('error', 'Operation Failed');
            return redirect()->back();
        }

        session()->flash('message', 'Student Flow Added Successful');
        return redirect()->route('admin.promotion.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
