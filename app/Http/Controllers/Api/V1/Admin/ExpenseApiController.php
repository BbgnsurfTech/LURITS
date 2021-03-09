<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Expense;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Http\Resources\Admin\ExpenseResource;
use Gate;
use App\Term;
use App\Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use DB;

class ExpenseApiController extends Controller
{
    public function index()
    {
        // abort_if(Gate::denies('expense_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // return new ExpenseResource(Expense::with(['expense_category', 'school'])->get());

        $data = Expense::where('school_id', Auth::User()->school_id)->get();
        return response($data);
    }

    public function store(StoreExpenseRequest $request)
    {
        $term_id = Term::where('active_status', 1)->pluck('id')->first();
        $session_id = Session::where('active_status', 1)->pluck('id')->first();
        
        if (Auth::User()->is_headTeacher) {
            $school = Auth::User()->school_id;
        } else {
            $school = $request->school;
        }
        
        $allData = $request->all();

        DB::beginTransaction();
        try {
        
            foreach ($allData as $expenseData) {
                $data_id = Expense::where('school_id', $school)->max('id') + 1;

                if ($data_id == 1) {
                    $model_id = str_pad($school, 15, "0", STR_PAD_RIGHT).$data_id;
                } else {
                    $model_id = $data_id;
                }

                if ($expenseData['id'] == '' || $expenseData['id'] == null) {
                    $data = new Expense();
                } else {
                    $data = Expense::find($expenseData['id']);
                }

                $data->id = $model_id;
                $data->entry_date = $expenseData['entry_date'];
                $data->amount = $expenseData['amount'];
                $data->description = $expenseData['description'];
                $data->beneficiary = $expenseData['beneficiary'];
                $data->issued_cheque_no = $expenseData['issued_cheque_no'];
                $data->balance_as_at = $expenseData['balance_as_at'];
                $data->name_of_authorizing_individual = $expenseData['name_of_authorizing_individual'];
                $data->funds_out = $expenseData['funds_out'];
                $data->expense_category_id = $expenseData['expense_category_id'];
                $data->term_id = $term_id;
                $data->session_id = $session_id;
                $data->school_id = $school;

                if ($expenseData['id'] == '' || $expenseData['id'] == null) {
                    $final = $data->save();
                } else {
                    $final = $data->update();
                }
                
            }

            DB::commit();

        } catch (Exception $e) {
            DB::rollback();
            return response($e);
        }

        if ($final) {
            $message = Expense::where('school_id', $school_id)->get();
            return response($message);
        }
    }

    public function destroy(Expense $expense)
    {
        abort_if(Gate::denies('expense_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $final = $expense->delete();

        if ($final) {
            return response([
                'success' => true,
                'message' => "Data Deleted Successfully",
            ], 200);
        } else {
            return response([
                'success' => false,
                'message' => "Operation Failed, Server Error!",
            ], 200);
        }
        
    }
}
