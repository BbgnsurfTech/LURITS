<?php

namespace App\Http\Requests;

use App\LogBook;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyLogBookRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('log_book_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:log_books,id',
        ];
    }
}
