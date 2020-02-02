<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\Admin\TaskResource;
use App\Task;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('task_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TaskResource(Task::with(['status', 'tags', 'assigned_to'])->get());
    }

    public function store(StoreTaskRequest $request)
    {
        $task = Task::create($request->all());
        $task->tags()->sync($request->input('tags', []));

        return (new TaskResource($task))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Task $task)
    {
        abort_if(Gate::denies('task_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TaskResource($task->load(['status', 'tags', 'assigned_to']));
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->all());
        $task->tags()->sync($request->input('tags', []));

        return (new TaskResource($task))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Task $task)
    {
        abort_if(Gate::denies('task_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $task->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
