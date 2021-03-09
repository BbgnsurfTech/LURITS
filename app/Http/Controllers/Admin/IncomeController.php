<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyIncomeRequest;
use App\Http\Requests\StoreIncomeRequest;
use App\Http\Requests\UpdateIncomeRequest;
use App\Atlas;
use App\Income;
use App\IncomeCategory;
use Gate;
use App\Term;
use App\Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use App\AtlasLink;
use App\SchoolAtlas;
use App\School;

class IncomeController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('income_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Income::where('school_id', $request->school)->with(['income_category', 'school'])->select(sprintf('%s.*', (new Income)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'income_show';
                $editGate      = 'income_edit';
                $deleteGate    = 'income_delete';
                $crudRoutePart = 'incomes';

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
            $table->addColumn('income_category_name', function ($row) {
                return $row->income_category ? $row->income_category->name : '';
            });

            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : "";
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'income_category']);

            return $table->make(true);
        }

        $income_categories = IncomeCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.incomes.index', compact('income_categories'));
    }

    public function getIncome(Request $request)
    {
        $school_id = Auth::User()->school_id;

        if ($request->ajax()) {
            $query = Income::where('school_id', $school_id)->with(['income_category', 'school'])->select(sprintf('%s.*', (new Income)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'income_show';
                $editGate      = 'income_edit';
                $deleteGate    = 'income_delete';
                $crudRoutePart = 'incomes';

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
            $table->addColumn('income_category_name', function ($row) {
                return $row->income_category ? $row->income_category->name : '';
            });

            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : "";
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'income_category']);

            return $table->make(true);
        }
    }

    public function create()
    {
        abort_if(Gate::denies('income_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $income_categories = IncomeCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.incomes.create', compact('income_categories'));
    }

    public function store(StoreIncomeRequest $request)
    {
        // $income = Income::create($request->all());
        $term_id = Term::where('active_status', 1)->select('id')->get();
        $session_id = Session::where('active_status', 1)->select('id')->get();

        if (!Auth::User()->is_headTeacher) {
            $request->validate([
                'school' => "required",
            ]);
        }

        if (!Auth::User()->is_headTeacher) {
            $school_id = $request->school;
        } else {
            $school_id = Auth::User()->school_id;
        }

        $data_id = Income::where('school_id', $school_id)->max('id') + 1;
        // dd($data_id);
        if ($data_id == 1) {
            $model_id = str_pad($school_id, 15, "0", STR_PAD_RIGHT).$data_id;
        } else {
            $model_id = $data_id;
        }

        $data = new Income();
        $data->id = $model_id;
        $data->entry_date = $request->entry_date;
        $data->amount = $request->amount;
        $data->description = $request->description;
        $data->income_category_id = $request->income_category_id;
        $data->school_id = $school_id;
        $data->term_id = $term_id[0]->id;
        $data->session_id = $session_id[0]->id;
        $final = $data->save();

        if ($final) {
            $notification = array(
                    'message' => 'Income Added Successfully'
                );
            return redirect()->route('admin.incomes.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Operation Failed'
                );
            return redirect()->back()->with($notification);
        }

        // return redirect()->route('admin.incomes.index');
    }

    public function edit(Income $income)
    {
        abort_if(Gate::denies('income_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $income_categories = IncomeCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $income->load('income_category', 'school');

        if (Auth::User()->is_lgea) {
            $a = Auth::User()->atlas;
            $b = $a->atlas_id;
            $schooll = SchoolAtlas::where('code_atlas_entity', $b)->pluck('school_id');
            $lgea = School::whereIn('id', $schooll)->where('code_type_sector', 1)->get();
        } else {
            $lgea = null;
        }

        return view('admin.incomes.edit', compact('income_categories', 'income', 'lgea'));
    }

    public function update(UpdateIncomeRequest $request, Income $income)
    {
        
        $income->entry_date = $request->entry_date;
        $income->amount = $request->amount;
        $income->description = $request->description;
        $income->income_category_id = $request->income_category_id;
        $final = $income->update();

        if ($final) {
            $notification = array(
                    'message' => 'Income Data Updated Successfully'
                );
            return redirect()->route('admin.incomes.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Operation Failed'
                );
            return redirect()->back()->with($notification);
        }

        // return redirect()->route('admin.incomes.index');
    }

    public function show(Income $income)
    {
        abort_if(Gate::denies('income_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $income->load('income_category', 'school');

        return view('admin.incomes.show', compact('income'));
    }

    public function destroy(Income $income)
    {
        abort_if(Gate::denies('income_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $income->delete();

        session()->flash('message', 'Income Data Deleted Successfully');
        return back();
    }

    public function massDestroy(MassDestroyIncomeRequest $request)
    {
        Income::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
