<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\ExpenseCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExpenseCategoryRequest;
use App\Http\Requests\UpdateExpenseCategoryRequest;
use App\Http\Resources\Admin\ExpenseCategoryResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExpenseCategoryApiController extends Controller
{
    public function index()
    {
        // abort_if(Gate::denies('expense_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // return new ExpenseCategoryResource(ExpenseCategory::all());

        $data = ExpenseCategory::all();
        return response(
            json_decode($data),
        200);
    }

    public function store(StoreExpenseCategoryRequest $request)
    {
        $expenseCategory = ExpenseCategory::create($request->all());

        if ($expenseCategory) {
            return response([
                'success' => true,
                'message' => "Expense Category Added Successfully",
            ], 200);
        } else {
            return response([
                'success' => false,
                'message' => "Operation Failed, Server Error!",
            ], 200);
        }

        // return (new ExpenseCategoryResource($expenseCategory))
        //     ->response()
        //     ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ExpenseCategory $expenseCategory)
    {
        abort_if(Gate::denies('expense_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ExpenseCategoryResource($expenseCategory);
    }

    public function update(UpdateExpenseCategoryRequest $request, ExpenseCategory $expenseCategory)
    {
        $expenseCategory->update($request->all());

        if ($expenseCategory) {
            return response([
                'success' => true,
                'message' => "Expense Category Updated Successfully",
            ], 200);
        } else {
            return response([
                'success' => false,
                'message' => "Operation Failed, Server Error!",
            ], 200);
        }

        // return (new ExpenseCategoryResource($expenseCategory))
        //     ->response()
        //     ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ExpenseCategory $expenseCategory)
    {
        abort_if(Gate::denies('expense_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expenseCategory->delete();

        if ($expenseCategory) {
            return response([
                'success' => true,
                'message' => "Expense Category Deleted Successfully",
            ], 200);
        } else {
            return response([
                'success' => false,
                'message' => "Operation Failed, Server Error!",
            ], 200);
        }

        // return response(null, Response::HTTP_NO_CONTENT);
    }
}
