<?php

namespace App\Http\Requests;

use App\Models\Workorder;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateWorkorderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('workorder_edit');
    }

    public function rules()
    {
        return [
            'vendor_id' => [
                'required',
                'integer',
            ],
            'details_id' => [
                'required',
                'integer',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
