<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLeaveRequest;
use App\Http\Requests\UpdateLeaveRequest;
use App\Http\Resources\Admin\LeaveResource;
use App\Staff;
use App\TeacherAttendance;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StaffAttendaceApiController extends Controller
{
    public function index()
    {
        // abort_if(Gate::denies('Leave_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // return new LeaveResource(Leave::with(['Leave_category', 'school'])->get());

        $data = Staff::all()->get();
        return response(
            json_decode($data),
        200);
    }

    public function store(StoreLeaveRequest $request)
    {
        $Leave = Leave::create($request->all());

        return (new LeaveResource($Leave))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Leave $Leave)
    {
        abort_if(Gate::denies('Leave_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LeaveResource($Leave->load(['Leave_category', 'school']));
    }

    public function update(UpdateLeaveRequest $request, Leave $Leave)
    {
        $Leave->update($request->all());

        return (new LeaveResource($Leave))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Leave $Leave)
    {
        abort_if(Gate::denies('Leave_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $Leave->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
