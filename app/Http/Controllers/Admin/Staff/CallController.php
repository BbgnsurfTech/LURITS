<?php

namespace App\Http\Controllers\Admin\Staff;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Staff\Call;
use DataTables;
use Redirect;
use Response;
use File;

class CallController extends Controller
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
        $calls = call::latest()->get();
        //Parents::find($row->id)->first_name
        //dd($calls);
        if ($request->ajax()) {
            return Datatables::of($calls)
                ->addIndexColumn()
                ->addColumn('recording', function ($row){
                    return '<audio controls><source src="../uploads/calls/'.$row->file_name.'" type="audio/mp3"></audio>';
                })
                ->rawColumns(['recording'])
                ->make(true);
        }
        //dd($calls);
        return view('admin.pages.managecalls', compact('calls'));
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
            File::delete('uploads/calls/'.$request->hidden_file);

            //insert new file
            $destinationPath = 'uploads/calls/'; // upload path
            $profileAudio = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileAudio);
         }

        $profileAudio=isset($profileAudio)?$profileAudio:$request->hidden_file;

        $call_id = $request->call_id;
        call::updateOrCreate(['id' => $call_id],['title' => $request->title, 'file_name' => $profileAudio]);

        if(empty($request->call_id))
            $msg['message'] = 'Call created successfully.';
        else
            $msg['message'] = 'Call data is updated successfully';

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

    }
}
