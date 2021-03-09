<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Incidence;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use DataTables;
use Redirect;
use Response;
use Carbon\Carbon;
use App\Notifications\IncidenceNotification;

class IncidenceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function index(Request $request)
    {
        $incidences = Incidence::latest()->get();

        if ($request->ajax()) {
            if (isset($request->school)) {
                return Datatables::of($incidences->where('school_id', $request->school))
                    ->addIndexColumn()
                    ->addColumn('school', function ($row){
                        return Incidence::find($row->id)->school->name ?? '';
                    })
                    ->addColumn('time', function ($row){
                            return $row->created_at->diffForHumans();
                        })
                        ->addColumn('photo', function ($row){
                            return isset($row->photo)?'<i class="fas fa-paperclip"></i>':'';
                        })
                        ->addColumn('rate', function ($row){
                            switch ($row->rate){
                                case 'extreme':
                                    return '<i class="fas fa-star text-red">Extreme</i>';
                                case 'high':
                                    return '<i class="fas fa-star text-orange">High</i>';
                                case 'medium':
                                    return '<i class="fas fa-star text-yellow">Medium</i>';
                                case 'low':
                                    return '<i class="fas fa-star text-blue">Low</i>';
                                case 'default':
                                    return '<i class="fas fa-star text-green">Default</i>';
                            }
                        })
                    ->addColumn('actions', 'admin.pages.incidencereporting.incidenceactions')
                    ->rawColumns(['actions', 'school', 'time', 'rate', 'photo'])
                    ->make(true);
            } else {
                return Datatables::of($incidences)
                    ->addIndexColumn()
                    ->addColumn('school', function ($row){
                        return Incidence::find($row->id)->school->name ?? '';
                    })
                    ->addColumn('time', function ($row){
                            return $row->created_at->diffForHumans();
                        })
                        ->addColumn('photo', function ($row){
                            return isset($row->photo)?'<i class="fas fa-paperclip"></i>':'';
                        })
                        ->addColumn('rate', function ($row){
                            switch ($row->rate){
                                case 'extreme':
                                    return '<i class="fas fa-star text-red">Extreme</i>';
                                case 'high':
                                    return '<i class="fas fa-star text-orange">High</i>';
                                case 'medium':
                                    return '<i class="fas fa-star text-yellow">Medium</i>';
                                case 'low':
                                    return '<i class="fas fa-star text-blue">Low</i>';
                                case 'default':
                                    return '<i class="fas fa-star text-green">Default</i>';
                            }
                        })
                    ->addColumn('actions', 'admin.pages.incidencereporting.incidenceactions')
                    ->rawColumns(['actions', 'school', 'time', 'rate', 'photo'])
                    ->make(true);
            }
        }

        return view('admin.pages.incidencereporting.manageincidence');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = Auth::User();

            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'rate' => 'required',
                'incidence_body' => 'required',
                'attachement' => 'image|mimes:jpeg,png,jpg,gif,svg',
             ]);

            //dd($request->file('attachment'));

            if ($validator->fails()) {
                return Response::json(['type' => 'error', 'errors'=>$validator->errors()->all()]);
            }else{

                if ($request->hasFile('attachment')){
                    $image = $request->file('attachment');
                     $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
                    $destinationPath = 'storage/images/incidences';
                    $image->move($destinationPath, $input['imagename']);
               }else{
                    $input['imagename']='';
               }

                $incidence_id = $request->incidence_id;
                $school_id = Auth::User()->school_id;

                // $iii = Incidence::updateOrCreate(['id' => $incidence_id],
                // [
                //     'title' => $request->title,
                //     'rate' => $request->rate,
                //     'description' => $request->incidence_body,
                //     'school_id' => $school_id,
                //     'photo' => $input['imagename'],
                // ]);

                // if ($iii) {
                //     $user->notify(new IncidenceNotification(User::findOrFail(114)));
                // }

                $data_id = Incidence::where('school_id', $school)->max('id') + 1;
                // dd($data_id);
                if ($data_id == 1) {
                    $model_id = str_pad($school, 15, "0", STR_PAD_RIGHT).$data_id;
                } else {
                    $model_id = $data_id;
                }

                if(empty($incidence_id)) {
                    $incidence = new Incidence();
                    $incidence->id = $model_id;
                    $incidence->title = $request->title;
                    $incidence->rate = $request->rate;
                    $incidence->description = $request->incidence_body;
                    $incidence->school_id = $school_id;
                    $incidence->photo = $input['imagename'];
                    $incidence->save();

                    $msg = 'Incidence created successfully.';
                } else {
                    $incidence = Incidence::find($incidence_id);
                    $incidence->title = $request->title;
                    $incidence->rate = $request->rate;
                    $incidence->description = $request->incidence_body;
                    $incidence->school_id = $school_id;
                    $incidence->photo = $input['imagename'];
                    $incidence->update();

                    $msg = 'Incidence data is updated successfully';
                }

                return Response::json(['type' => 'success', 'message' => $msg]);
            }   
        } catch (\Exception $e) {
            return Response::json(['type' => 'error', 'message' => 'Operation Failed']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Incidence  $incidence
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $where = array('id' => $id);
        $incidence = Incidence::where($where)->first();
        return Response::json($incidence);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Incidence  $incidence
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $incidence = Incidence::where($where)->first();
        return Response::json($incidence);
    }
}
