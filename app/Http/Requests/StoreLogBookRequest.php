<?php

namespace App\Http\Requests;

use App\LogBook;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreLogBookRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('log_book_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'event'    => [
                'required',
            ],
            'date'   => [
                'required',
            ],
        ];
    }
}
