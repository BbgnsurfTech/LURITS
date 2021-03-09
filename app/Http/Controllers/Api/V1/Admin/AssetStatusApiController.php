<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\AssetStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAssetStatusRequest;
use App\Http\Requests\UpdateAssetStatusRequest;
use App\Http\Resources\Admin\AssetStatusResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AssetStatusApiController extends Controller
{
    public function index()
    {
        // abort_if(Gate::denies('asset_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // return new AssetStatusResource(AssetStatus::all());

        $data = AssetStatus::all();
        return response(
            json_decode($data),
        200);
    }

    public function store(StoreAssetStatusRequest $request)
    {
        $assetCategory = AssetStatus::create($request->all());

        if ($assetCategory) {
            return response([
                'success' => true,
                'message' => "Asset Status Added Successfully",
            ], 200);
        } else {
            return response([
                'success' => false,
                'message' => "Operation Failed, Server Error!",
            ], 200);
        }
        // $assetStatus = AssetStatus::create($request->all());

        // return (new AssetStatusResource($assetStatus))
        //     ->response()
        //     ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AssetStatus $assetStatus)
    {
        abort_if(Gate::denies('asset_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AssetStatusResource($assetStatus);
    }

    public function update(UpdateAssetStatusRequest $request, AssetStatus $assetStatus)
    {
        $assetStatus->update($request->all());

        if ($assetStatus) {
            return response([
                'success' => true,
                'message' => "Asset Status Updated Successfully",
            ], 200);
        } else {
            return response([
                'success' => false,
                'message' => "Operation Failed, Server Error!",
            ], 200);
        }
        // $assetStatus->update($request->all());

        // return (new AssetStatusResource($assetStatus))
        //     ->response()
        //     ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AssetStatus $assetStatus)
    {
        abort_if(Gate::denies('asset_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetStatus->delete();

        if ($assetStatus) {
            return response([
                'success' => true,
                'message' => "Asset Status Deleted Successfully",
            ], 200);
        } else {
            return response([
                'success' => false,
                'message' => "Operation Failed, Server Error!",
            ], 200);
        }

        // return response(null, Response::HTTP_NO_CONTENT);
    }
}
