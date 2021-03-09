<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\AssetCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAssetCategoryRequest;
use App\Http\Requests\UpdateAssetCategoryRequest;
use App\Http\Resources\Admin\AssetCategoryResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AssetCategoryApiController extends Controller
{
    public function index()
    {
        // abort_if(Gate::denies('asset_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // return new AssetCategoryResource(AssetCategory::all());

        $data = AssetCategory::all();
        return response(
            json_decode($data),
        200);
    }

    public function store(StoreAssetCategoryRequest $request)
    {
        $assetCategory = AssetCategory::create($request->all());

        if ($assetCategory) {
            return response([
                'success' => true,
                'message' => "Asset Category Added Successfully",
            ], 200);
        } else {
            return response([
                'success' => false,
                'message' => "Operation Failed, Server Error!",
            ], 200);
        }

        // return (new AssetCategoryResource($assetCategory))
        //     ->response()
        //     ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AssetCategory $assetCategory)
    {
        abort_if(Gate::denies('asset_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AssetCategoryResource($assetCategory);
    }

    public function update(UpdateAssetCategoryRequest $request, AssetCategory $assetCategory)
    {
        $assetCategory->update($request->all());

        if ($assetCategory) {
            return response([
                'success' => true,
                'message' => "Asset Category Updated Successfully",
            ], 200);
        } else {
            return response([
                'success' => false,
                'message' => "Operation Failed, Server Error!",
            ], 200);
        }

        // return (new AssetCategoryResource($assetCategory))
        //     ->response()
        //     ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AssetCategory $assetCategory)
    {
        abort_if(Gate::denies('asset_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetCategory->delete();

        if ($assetCategory) {
            return response([
                'success' => true,
                'message' => "Asset Category Deleted Successfully",
            ], 200);
        } else {
            return response([
                'success' => false,
                'message' => "Operation Failed, Server Error!",
            ], 200);
        }
    }
}
