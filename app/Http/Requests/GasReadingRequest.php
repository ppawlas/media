<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GasReadingRequest extends FormRequest
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
            'date' => 'required|date',
            'state' => 'required|regex:/^\d{1,7}(\.\d{0,2})?$/',
            'fixed_usage' => 'required|boolean',
            'usage' => 'required_if:fixed_usage,true|regex:/^\d{1,7}(\.\d{0,2})?$/'
        ];
    }
}
