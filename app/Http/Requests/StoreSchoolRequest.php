<?php

namespace App\Http\Requests;

use App\School;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreSchoolRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('school_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required'
            ],
            'lga' => [
                'required'
            ],
            'pseudo_code'       => [
                'max:10'],
            'nemis_code'        => [
                'max:10'],
            'number_and_street' => [
                'max:100'],
            'school_community'  => [
                'min:3',
                'max:100'],
            'village_town'      => [
                'min:3',
                'max:50'],
            'email_address'     => [
                'max:50'],
            'school_telephone'  => [
                'max:11'],
            'code_type_sector' => [
                'required'],
            'nearby_name_school'=> [
                'max:100'],
        ];
    }
}
