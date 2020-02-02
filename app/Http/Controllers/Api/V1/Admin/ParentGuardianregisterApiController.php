<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreParentGuardianregisterRequest;
use App\Http\Requests\UpdateParentGuardianregisterRequest;
use App\Http\Resources\Admin\ParentGuardianregisterResource;
use App\ParentGuardianregister;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ParentGuardianregisterApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('parent_guardianregister_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ParentGuardianregisterResource(ParentGuardianregister::with(['teams'])->get());
    }

    public function store(StoreParentGuardianregisterRequest $request)
    {
        $parentGuardianregister = ParentGuardianregister::create($request->all());
        $parentGuardianregister->teams()->sync($request->input('teams', []));

        return (new ParentGuardianregisterResource($parentGuardianregister))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ParentGuardianregister $parentGuardianregister)
    {
        abort_if(Gate::denies('parent_guardianregister_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ParentGuardianregisterResource($parentGuardianregister->load(['teams']));
    }

    public function update(UpdateParentGuardianregisterRequest $request, ParentGuardianregister $parentGuardianregister)
    {
        $parentGuardianregister->update($request->all());
        $parentGuardianregister->teams()->sync($request->input('teams', []));

        return (new ParentGuardianregisterResource($parentGuardianregister))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ParentGuardianregister $parentGuardianregister)
    {
        abort_if(Gate::denies('parent_guardianregister_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parentGuardianregister->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
