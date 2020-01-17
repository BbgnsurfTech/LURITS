<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyParentGuardianregisterRequest;
use App\Http\Requests\StoreParentGuardianregisterRequest;
use App\Http\Requests\UpdateParentGuardianregisterRequest;
use App\ParentGuardianregister;
use App\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ParentGuardianregisterController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = ParentGuardianregister::with(['teams'])->select(sprintf('%s.*', (new ParentGuardianregister)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'parent_guardianregister_show';
                $editGate      = 'parent_guardianregister_edit';
                $deleteGate    = 'parent_guardianregister_delete';
                $crudRoutePart = 'parent-guardianregisters';

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
            $table->editColumn('first_name', function ($row) {
                return $row->first_name ? $row->first_name : "";
            });
            $table->editColumn('middle_name', function ($row) {
                return $row->middle_name ? $row->middle_name : "";
            });
            $table->editColumn('last_name', function ($row) {
                return $row->last_name ? $row->last_name : "";
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : "";
            });
            $table->editColumn('phone_number', function ($row) {
                return $row->phone_number ? $row->phone_number : "";
            });
            $table->editColumn('team', function ($row) {
                $labels = [];

                foreach ($row->teams as $team) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $team->name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'team']);

            return $table->make(true);
        }

        return view('admin.parentGuardianregisters.index');
    }

    public function create()
    {
        abort_if(Gate::denies('parent_guardianregister_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $teams = Team::all()->pluck('name', 'id');

        return view('admin.parentGuardianregisters.create', compact('teams'));
    }

    public function store(StoreParentGuardianregisterRequest $request)
    {
        $parentGuardianregister = ParentGuardianregister::create($request->all());
        $parentGuardianregister->teams()->sync($request->input('teams', []));

        return redirect()->route('admin.parent-guardianregisters.index');
    }

    public function edit(ParentGuardianregister $parentGuardianregister)
    {
        abort_if(Gate::denies('parent_guardianregister_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $teams = Team::all()->pluck('name', 'id');

        $parentGuardianregister->load('teams');

        return view('admin.parentGuardianregisters.edit', compact('teams', 'parentGuardianregister'));
    }

    public function update(UpdateParentGuardianregisterRequest $request, ParentGuardianregister $parentGuardianregister)
    {
        $parentGuardianregister->update($request->all());
        $parentGuardianregister->teams()->sync($request->input('teams', []));

        return redirect()->route('admin.parent-guardianregisters.index');
    }

    public function show(ParentGuardianregister $parentGuardianregister)
    {
        abort_if(Gate::denies('parent_guardianregister_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parentGuardianregister->load('teams');

        return view('admin.parentGuardianregisters.show', compact('parentGuardianregister'));
    }

    public function destroy(ParentGuardianregister $parentGuardianregister)
    {
        abort_if(Gate::denies('parent_guardianregister_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parentGuardianregister->delete();

        return back();
    }

    public function massDestroy(MassDestroyParentGuardianregisterRequest $request)
    {
        ParentGuardianregister::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
