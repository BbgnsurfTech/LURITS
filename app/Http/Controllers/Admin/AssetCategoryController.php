<?php

namespace App\Http\Controllers\Admin;

use App\AssetCategory;
use App\Atlas;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAssetCategoryRequest;
use App\Http\Requests\StoreAssetCategoryRequest;
use App\Http\Requests\UpdateAssetCategoryRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Auth;

class AssetCategoryController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('asset_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetCategories = AssetCategory::all();

        return view('admin.assetCategories.index', compact('assetCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('asset_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.assetCategories.create');
    }

    public function store(StoreAssetCategoryRequest $request)
    {
        $data = new AssetCategory();
        $data->name = $request->name;
        $final = $data->save();

        if ($final) {
            $notification = array(
                    'message' => 'Asset Category Added Successfully'
                );
            return redirect()->route('admin.asset-categories.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Operation Failed'
                );
            return redirect()->back()->with($notification);
        }
    }

    public function edit(AssetCategory $assetCategory)
    {
        abort_if(Gate::denies('asset_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.assetCategories.edit', compact('assetCategory'));
    }

    public function update(UpdateAssetCategoryRequest $request, AssetCategory $assetCategory)
    {
        $data = AssetCategory::find($assetCategory->id);
        $data->name = $request->name;
        $final = $data->update();

        if ($final) {
            $notification = array(
                    'message' => 'Asset Category Updated Successfully'
                );
            return redirect()->route('admin.asset-categories.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Operation Failed'
                );
            return redirect()->back()->with($notification);
        }
    }

    public function show(AssetCategory $assetCategory)
    {
        abort_if(Gate::denies('asset_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetCategory->load('categoryAssets');

        return view('admin.assetCategories.show', compact('assetCategory'));
    }

    public function destroy(AssetCategory $assetCategory)
    {
        abort_if(Gate::denies('asset_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetCategory->delete();

        session()->flash('message', 'Asset Category Deleted Successfully');
        return back();
    }

    public function massDestroy(MassDestroyAssetCategoryRequest $request)
    {
        AssetCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
