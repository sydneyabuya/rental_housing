<?php

namespace App\Http\Requests;

use App\Models\Unit;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUnitRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('unit_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'property_id' => [
                'required',
                'integer',
            ],
            'rent' => [
                'required',
            ],
            'property_units.*' => [
                'integer',
            ],
            'property_units' => [
                'required',
                'array',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
