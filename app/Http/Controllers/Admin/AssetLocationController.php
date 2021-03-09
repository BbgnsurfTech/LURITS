<?php

namespace App\Http\Controllers\Admin;

use App\AssetLocation;
use App\Atlas;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAssetLocationRequest;
use App\Http\Requests\StoreAssetLocationRequest;
use App\Http\Requests\UpdateAssetLocationRequest;
use Gate;
use App\Term;
use App\Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Auth;

class AssetLocationController extends Controller
{
    
    public function index(Request $request)
    {
        abort_if(Gate::denies('asset_location_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {

            $query = AssetLocation::where('school_id', $request->school)->select(sprintf('%s.*', (new AssetLocation)->table));
            $table = Datatables::of($query);

            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'asset_location_show';
                $editGate      = 'asset_location_edit';
                $deleteGate    = 'asset_location_delete';
                $crudRoutePart = 'asset-locations';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
            
        }
        $country_list = Atlas::select('name_atlas_entity', 'code_atlas_entity')
                        ->where('code_ds_atlas_entity', 1)
                        ->groupBy('code_atlas_entity','name_atlas_entity')
                        ->get();

        return view('admin.assetLocations.index', compact('country_list'));
    }

    public function create()
    {
        abort_if(Gate::denies('asset_location_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.assetLocations.create');
    }

    public function store(StoreAssetLocationRequest $request)
    {
        // $assetLocation = AssetLocation::create($request->all());
        $term_id = Term::where('active_status', 1)->get();
        $session_id = Session::where('active_status', 1)->get();

        $user_id = 1210100001;

        $data = new AssetLocation();
        $data->name = $request->name;
        $data->school_id = $user_id; 
        // $data->term_id = $term_id[0]->id;
        // $data->session_id = $session_id[0]->id;
        $final = $data->save();

        if ($final) {
            $notification = array(
                    'message' => 'Operation Successful'
                );
            return redirect()->route('admin.asset-locations.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Operation Failed'
                );
            return redirect()->back()->with($notification);
        }

        // return redirect()->route('admin.asset-locations.index');
    }

    public function edit(AssetLocation $assetLocation)
    {
        abort_if(Gate::denies('asset_location_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetLocation->load('team');

        return view('admin.assetLocations.edit', compact('assetLocation'));
    }

    public function update(UpdateAssetLocationRequest $request, AssetLocation $assetLocation)
    {
        // $assetLocation->update($request->all());

        $data = AssetLocation::find($assetLocation->id);
        $data->name = $request->name;
        //dd($data);
        $result = $data->update();
        if ($result) {
            $notification = array(
                    'message' => 'Operation Successful'
                );
            return redirect()->route('admin.asset-locations.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Operation Failed'
                );
            return redirect()->back()->with($notification);
        }

        // return redirect()->route('admin.asset-locations.index');
    }

    public function show(AssetLocation $assetLocation)
    {
        abort_if(Gate::denies('asset_location_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetLocation->load('team', 'locationAssets', 'locationAssetsHistories');

        return view('admin.assetLocations.show', compact('assetLocation'));
    }

    public function destroy(AssetLocation $assetLocation)
    {
        abort_if(Gate::denies('asset_location_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetLocation->delete();

        return back();
    }

    public function massDestroy(MassDestroyAssetLocationRequest $request)
    {
        AssetLocation::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
