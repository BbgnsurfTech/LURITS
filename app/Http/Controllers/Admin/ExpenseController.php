<?php

namespace App\Http\Controllers\Admin;

use App\Expense;
use App\ExpenseCategory;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyExpenseRequest;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use Gate;
use App\Term;
use App\Session;
use App\Atlas;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use Validator;
use App\AtlasLink;
use App\SchoolAtlas;
use App\School;

class ExpenseController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('expense_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Expense::where('school_id', $request->school)->with(['expense_category', 'school'])->select(sprintf('%s.*', (new Expense)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'expense_show';
                $editGate      = 'expense_edit';
                $deleteGate    = 'expense_delete';
                $crudRoutePart = 'expenses';

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
            $table->addColumn('expense_category_name', function ($row) {
                return $row->expense_category ? $row->expense_category->name : '';
            });

            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : "";
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'expense_category']);

            return $table->make(true);
        }

        return view('admin.expenses.index');
    }

    public function getExpense(Request $request)
    {
        if ($request->ajax()) {
            $query = Expense::where('school_id', Auth::User()->school_id)->with(['expense_category', 'school'])->select(sprintf('%s.*', (new Expense)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'expense_show';
                $editGate      = 'expense_edit';
                $deleteGate    = 'expense_delete';
                $crudRoutePart = 'expenses';

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
            $table->addColumn('expense_category_name', function ($row) {
                return $row->expense_category ? $row->expense_category->name : '';
            });

            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : "";
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'expense_category']);

            return $table->make(true);
        }
    }

    public function create()
    {
        abort_if(Gate::denies('expense_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expense_categories = ExpenseCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.expenses.create', compact('expense_categories'));
    }

    public function store(StoreExpenseRequest $request)
    {
        if (!Auth::User()->is_headTeacher) {
            $request->validate([
                'school' => "required",
            ]);
        }
        
        $term_id = Term::where('active_status', 1)->select('id')->get();
        $session_id = Session::where('active_status', 1)->select('id')->get();
        
        if (!Auth::User()->is_headTeacher) {
            $school_id = $request->school;
        } else {
            $school_id = Auth::User()->school_id;
        }

        $data_id = Expense::where('school_id', $school_id)->max('id') + 1;
        // dd($data_id);
        if ($data_id == 1) {
            $model_id = str_pad($school_id, 15, "0", STR_PAD_RIGHT).$data_id;
        } else {
            $model_id = $data_id;
        }

        $data = new Expense();
        $data->id = $model_id;
        $data->entry_date = $request->entry_date;
        $data->amount = $request->amount;
        $data->description = $request->description;
        $data->beneficiary = $request->beneficiary;
        $data->issued_cheque_no = $request->issued_cheque_no;
        $data->balance_as_at = $request->balance_as_at;
        $data->name_of_authorizing_individual = $request->name_of_authorizing_individual;
        $data->funds_out = $request->funds_out;
        $data->expense_category_id = $request->expense_category_id;
        $data->school_id = $school_id;
        $data->term_id = $term_id[0]->id;
        $data->session_id = $session_id[0]->id;
        $final = $data->save();

        if ($final) {
            $notification = array(
                    'message' => 'Expense Added Successfully'
                );
            return redirect()->route('admin.expenses.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Operation Failed'
                );
            return redirect()->back()->with($notification);
        }
    }

    public function edit(Expense $expense)
    {
        abort_if(Gate::denies('expense_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expense_categories = ExpenseCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $expense->load('expense_category', 'school');

        return view('admin.expenses.edit', compact('expense_categories', 'expense'));
    }

    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        if (!Auth::User()->is_headTeacher) {
            $school_id = $request->school;
        } else {
            $school_id = Auth::User()->school_id;
        }

        $expense->entry_date = $request->entry_date;
        $expense->amount = $request->amount;
        $expense->description = $request->description;
        $expense->beneficiary = $request->beneficiary;
        $expense->issued_cheque_no = $request->issued_cheque_no;
        $expense->balance_as_at = $request->balance_as_at;
        $expense->name_of_authorizing_individual = $request->name_of_authorizing_individual;
        $expense->funds_out = $request->funds_out;
        $expense->expense_category_id = $request->expense_category_id;
        $final = $expense->update();

        if ($final) {
            $notification = array(
                    'message' => 'Expense Data Updated Successfully'
                );
            return redirect()->route('admin.expenses.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Operation Failed'
                );
            return redirect()->back()->with($notification);
        }
    }

    public function show(Expense $expense)
    {
        abort_if(Gate::denies('expense_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expense->load('expense_category', 'school');

        return view('admin.expenses.show', compact('expense'));
    }

    public function destroy(Expense $expense)
    {
        abort_if(Gate::denies('expense_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expense->delete();

        session()->flash('message', 'Expense Data Deleted Successfully');
        return back();
    }

    public function massDestroy(MassDestroyExpenseRequest $request)
    {
        Expense::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
