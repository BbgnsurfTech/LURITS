<?php

namespace App\Http\Requests;

use App\Classroom;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateClassroomRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('classroom_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'class'    => [
                'required',
            ],
            'arms'   => [
                'required',
            ],
            'capacity'     => [
                'required',
            ],
            'school_enrolled_id'     => [
                'required',
            ],
            'year'        => [
                'required',
            ],
            'condition'  => [
                'required',
            ],
            'length' => [
                'required',
            ],
            'width'         => [
                'required',
            ],
            'floor_material'      => [
                'required',
            ],
            'wall_material'       => [
                'required',
            ],
            'roof_material'       => [
                'required',
            ],
            'seating'       => [
                'required',
            ],
            'writing_board'       => [
                'required',
            ],
        ];
    }
}
