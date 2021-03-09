<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIncomeRequest;
use App\Http\Requests\UpdateIncomeRequest;
use App\Http\Resources\Admin\IncomeResource;
use App\Income;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use DB;

class IncomeApiController extends Controller
{
    public function index()
    {
        // abort_if(Gate::denies('income_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // return new IncomeResource(Income::with(['income_category', 'school'])->get());

        $data = Income::where('school_id', Auth::User()->school_id)->get();
        return response($data);
    }

    public function store(StoreIncomeRequest $request)
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
        
            foreach ($allData as $incomeData) {
                $data_id = Income::where('school_id', $school)->max('id') + 1;

                if ($data_id == 1) {
                    $model_id = str_pad($school, 15, "0", STR_PAD_RIGHT).$data_id;
                } else {
                    $model_id = $data_id;
                }

                if ($incomeData['id'] == '' || $incomeData['id'] == null) {
                    $data = new Income();
                } else {
                    $data = Income::find($incomeData['id']);
                }

                $data->id = $model_id;
                $data->entry_date = $incomeData['entry_date'];
                $data->amount = $incomeData['amount'];
                $data->description = $incomeData['description'];
                $data->income_category_id = $incomeData['income_category_id'];
                $data->term_id = $term_id;
                $data->session_id = $session_id;
                $data->school_id = $school;

                if ($incomeData['id'] == '' || $incomeData['id'] == null) {
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
            $message = Income::where('school_id', $school_id)->get();
            return response($message);
        }
    }

    public function destroy(Income $income)
    {
        abort_if(Gate::denies('income_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $final = $income->delete();

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
