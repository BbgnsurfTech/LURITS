<?php

namespace App\Http\Controllers\Admin\Staff;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Staff\CallTemplate;
use DataTables;
use Redirect;
use Response;
use File;

class CallTemplateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $calltemplates = CallTemplate::latest()->get();
        //Parents::find($row->id)->first_name
        //dd($calltemplates);
        if ($request->ajax()) {
            return Datatables::of($calltemplates)
                ->addIndexColumn()
                ->addColumn('recording', function ($row){
                    return '<audio controls><source src="../uploads/calltemplates/'.$row->file_name.'" type="audio/mp3"></audio>';
                })
                ->addColumn('action', function($row){
                                                           
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editCallTemplate"><i class="fa fa-pencil-alt"></i>&nbsp;Edit</a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteCallTemplate"><i class="fa fa-trash-alt"></i>&nbsp;Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action', 'recording'])
                ->make(true);
        }
        //dd($calltemplates);
        return view('admin.pages.managecalltemplates', compact('calltemplates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'recording' => 'required|mimes:mpga,wav,mp3|max:2048',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        if ($files = $request->file('recording')) {

            //delete old file
            File::delete('uploads/calltemplates/'.$request->hidden_file);

            //insert new file
            $destinationPath = 'uploads/calltemplates/'; // upload path
            $profileAudio = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileAudio);
         }

        $profileAudio=isset($profileAudio)?$profileAudio:$request->hidden_file;

        $calltemplate_id = $request->calltemplate_id;
        CallTemplate::updateOrCreate(['id' => $calltemplate_id],['title' => $request->title, 'file_name' => $profileAudio]);

        if(empty($request->calltemplate_id))
            $msg['message'] = 'Call Template created successfully.';
        else
            $msg['message'] = 'Call Template data is updated successfully';

        return Response::json($msg);
        return redirect()->route('sections.index');
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $calltemplate = CallTemplate::where($where)->first();
        return Response::json($calltemplate);
    }

    public function show($id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $calltemplate = CallTemplate::where('id',$id)->delete();
        return Response::json($calltemplate);
    }
}
