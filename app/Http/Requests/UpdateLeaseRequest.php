<?php

namespace App\Http\Requests;

use App\Models\Lease;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateLeaseRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('lease_edit');
    }

    public function rules()
    {
        return [
            'applications.*' => [
                'integer',
            ],
            'applications' => [
                'required',
                'array',
            ],
            'amount_invoiced_id' => [
                'required',
                'integer',
            ],
            'property_id' => [
                'required',
                'integer',
            ],
            'unit_id' => [
                'required',
                'integer',
            ],
            'paid_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'status_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
