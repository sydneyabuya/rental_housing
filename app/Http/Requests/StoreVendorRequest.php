<?php

namespace App\Http\Requests;

use App\Models\Vendor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreVendorRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('vendor_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
                'unique:vendors',
            ],
            'specialization' => [
                'string',
                'required',
            ],
        ];
    }
}
