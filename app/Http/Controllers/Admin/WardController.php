<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ward;
use DataTables;
use Redirect;
use Response;

class WardController extends Controller
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
         $wards = Ward::latest()->get();

        if ($request->ajax()) {
            return Datatables::of($wards)
                ->addIndexColumn()
                ->addColumn('lga', function($row){
                    return Ward::find($row->id)->lga->name?Ward::find($row->id)->lga->name:"";
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editWard"><i class="fa fa-pencil-alt"></i>&nbsp;Edit</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteWard"><i class="fa fa-trash-alt"></i>&nbsp;Delete</a>';
                    return $btn;
                })

                ->rawColumns(['action', 'lga'])
                ->make(true);
        }

        return view('admin.pages.managewards', compact('wards'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $r=$request->validate([
            'name' => 'required',
            'lga' => 'required',
        ]);

        $wardId = $request->ward_id;
        Ward::updateOrCreate(['id' => $wardId],['name' => $request->name, 'lga_id' => $request->lga]);
        if(empty($request->ward_id))
            $msg['message']  = 'Ward created successfully.';
        else
            $msg['message']  = 'Ward data is updated successfully';
        return Response::json($msg);
        return redirect()->route('wards.index');
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
        $ward = Ward::where($where)->first();
        return Response::json($ward);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ward = Ward::where('id',$id)->delete();
        return Response::json($ward);
    }
}
