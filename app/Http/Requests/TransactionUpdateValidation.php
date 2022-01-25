<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionUpdateValidation extends FormRequest
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
            'code_Transaction'  =>  ['nullable'],
            'Age'   =>  ['required', 'numeric', 'min:0'],
            'Weight'    =>  ['required', 'numeric', 'min:0'],
            'Hemoglobin'    =>  ['required', 'numeric', 'min:0'],
            'Pressure_sistole'  =>  ['required', 'numeric', 'min:0'],
            'Pressure_diastole' =>  ['required', 'numeric', 'min:0'],
            'Rhesus_category'         => ['required'],
        ];
    }
}
