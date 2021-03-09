<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ZoneLGA;
use DataTables;
use Redirect;
use Response;

class ZoneLGAController extends Controller
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
         $zoneslgas = ZoneLGA::latest()->get();

        if ($request->ajax()) {
            return Datatables::of($zoneslgas)
                ->addIndexColumn()
                ->addColumn('zonelga', function($row){
                    return ZoneLGA::find($row->id)->zone->name?ZoneLGA::find($row->id)->zone->name:"";

                })
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Update" class="edit btn btn-primary btn-sm editLGA"><i class="fa fa-pencil-alt"></i>&nbsp;Update</a>';
                    return $btn;
                })

                ->rawColumns(['action', 'zonelga'])
                ->make(true);
        }
        return view('admin.pages.managezoneslgas', compact('zoneslgas'));
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
            'zones' => 'required',
        ]);
        $zoneslgaId = $request->zoneslga_id;
        ZoneLGA::updateOrCreate(['id' => $zoneslgaId],['zone_id' => $request->zones]);
        if(empty($request->zoneslga_id))
            $msg['message']  = 'LGA added successfully.';
        else
            $msg['message']  = 'LGA data is updated successfully';
        return Response::json($msg);
        return redirect()->route('zoneslgas.index');
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
        $zoneslga = ZoneLGA::where($where)->first();
        $zoneslga->setAttribute('zones', $zoneslga->zone->id);
        return Response::json($zoneslga);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $zoneslga = ZoneLGA::where('id',$id)->delete();
        return Response::json($zoneslga);
    }
}
