<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ElectricityChargeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'applies_from' => 'date',
            'applies_to' => 'date',
            'component_c' => 'required|regex:/^\d{1,3}(\.\d{0,6})?$/',
            'component_ssvn' => 'required|regex:/^\d{1,3}(\.\d{0,6})?$/',
            'component_szvnk' => 'required|regex:/^\d{1,3}(\.\d{0,6})?$/',
            'component_sop' => 'required|regex:/^\d{1,3}(\.\d{0,6})?$/',
            'component_sosj' => 'required|regex:/^\d{1,3}(\.\d{0,6})?$/',
            'component_os' => 'required|regex:/^\d{1,3}(\.\d{0,6})?$/'
        ];
    }
}
