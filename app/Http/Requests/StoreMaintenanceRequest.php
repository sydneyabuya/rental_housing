<?php

namespace App\Http\Requests;

use App\Models\Maintenance;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMaintenanceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('maintenance_create');
    }

    public function rules()
    {
        return [
            'property_id' => [
                'required',
                'integer',
            ],
            'unit_id' => [
                'required',
                'integer',
            ],
            'specify' => [
                'required',
            ],
        ];
    }
}
