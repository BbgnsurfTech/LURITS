<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Asset;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreAssetRequest;
use App\Http\Requests\UpdateAssetRequest;
use App\Http\Resources\Admin\AssetResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Term;
use App\Session;
use Auth;
use DB;

class AssetApiController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        $data = Asset::where("school_id", Auth::User()->school_id)->get();
        return response($data);
    }

    public function store(Request $request)
    {   
        $term_id = Term::where('active_status', 1)->pluck('id')->first();
        $session_id = Session::where('active_status', 1)->pluck('id')->first();
        
        if (Auth::User()->is_headTeacher) {
            $school = Auth::User()->school_id;
        } else {
            $school = $request->school;
        }
        
        $allData = $request->all();

        DB::beginTransaction();
        try {
        
            foreach ($allData as $assetData) {
                $data_id = Asset::where('school_id', $school)->max('id') + 1;

                if ($data_id == 1) {
                    $model_id = str_pad($school, 15, "0", STR_PAD_RIGHT).$data_id;
                } else {
                    $model_id = $data_id;
                }

                if ($assetData['id'] == '' || $assetData['id'] == null) {
                    $data = new Asset();
                } else {
                    $data = Asset::find($assetData['id']);
                }

                $data->id = $model_id;
                $data->serial_number = $assetData['serial_number'];
                $data->category_id = $assetData['category_id'];
                $data->name = $assetData['name'];
                $data->status_id = $assetData['status_id'];
                $data->notes = $assetData['notes'];
                $data->assigned_to_id = $assetData['assigned_to_id'];
                $data->term_id = $term_id;
                $data->session_id = $session_id;
                $data->school_id = $school;

                if ($assetData['id'] == '' || $assetData['id'] == null) {
                    $final = $data->save();
                } else {
                    $final = $data->update();
                }
                

                // if ($request->input('photos', false)) {
                //     $asset->addMedia(storage_path('tmp/uploads/' . $request->input('photos')))->toMediaCollection('photos');
                // }
            }

            DB::commit();

        } catch (Exception $e) {
            DB::rollback();
            return response($e);
        }
            

        

        if ($final) {
            $message = Asset::where('school_id', $school_id)->get();
            return response($message);
        }

        // $asset = Asset::create($request->all());

        // return (new AssetResource($asset))
        //     ->response()
        //     ->setStatusCode(Response::HTTP_CREATED);
    }

    public function destroy(Asset $asset)
    {
        abort_if(Gate::denies('asset_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $asset->delete();

        if ($asset) {
            return response([
                'success' => true,
                'message' => "Asset Deleted Successfully",
            ], 200);
        } else {
            return response([
                'success' => false,
                'message' => "Operation Failed, Server Error!",
            ], 200);
        }
    }
}
