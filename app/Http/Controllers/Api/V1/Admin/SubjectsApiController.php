<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubjectsRequest;
use App\Http\Requests\UpdateSubjectsRequest;
use App\Http\Resources\Admin\SubjectsResource;
use App\DsSubject;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubjectsApiController extends Controller
{
    
    public function index()
    {
        // abort_if(Gate::denies('subject_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // return new SubjectsResource(Subjects::get());

        $data = DsSubject::all();
        return response(
            json_decode($data),
        200);
    }

    public function store(StoreSubjectsRequest $request)
    {
        $subject = Subjects::create($request->all());

        return (new SubjectsResource($subject))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DsSubject $subject)
    {
        abort_if(Gate::denies('subject_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SubjectsResource();
    }

    public function update(UpdateSubjectsRequest $request, DsSubject $subject)
    {
        $subject->update($request->all());

        return (new SubjectsResource($subject))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DsSubject $subject)
    {
        abort_if(Gate::denies('subject_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subject->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
