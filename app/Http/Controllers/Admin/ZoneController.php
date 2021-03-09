<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zone;
use App\Atlas;
use DataTables;
use Redirect;
use Response;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$zones = Zone::latest()->get();
    	$zones = Atlas::where('code_ds_atlas_entity', 4)->get();

        if ($request->ajax()) {
            return Datatables::of($zones)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editZone"><i class="fa fa-pencil-alt"></i>&nbsp;Edit</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteZone"><i class="fa fa-trash-alt"></i>&nbsp;Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.pages.managezones');
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
        ]);

        $zoneId = $request->zone_id;
        Zone::updateOrCreate(['id' => $zoneId],['name' => $request->name, 'state_id' => '20']);
        if(empty($request->zone_id))
            $msg['message'] = 'Zone created successfully.';
        else
            $msg['message'] = 'Zone data is updated successfully';
        
        return Response::json($msg);
        return redirect()->route('zones.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $zone = Atlas::where($where)->first();
        return Response::json($zone);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $zone = Zone::where('id',$id)->delete();
        return Response::json($zone);
    }
}
