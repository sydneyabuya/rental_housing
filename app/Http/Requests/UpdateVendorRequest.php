<?php

namespace App\Http\Requests;

use App\Models\Vendor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateVendorRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('vendor_edit');
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
                'unique:vendors,email,' . request()->route('vendor')->id,
            ],
            'specialization' => [
                'string',
                'required',
            ],
        ];
    }
}
