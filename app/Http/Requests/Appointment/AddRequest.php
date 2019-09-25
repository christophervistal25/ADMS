<?php

namespace App\Http\Requests\Appointment;

use Illuminate\Foundation\Http\FormRequest;

class AddRequest extends FormRequest
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
            'service_id' => 'required',
            'doctor_id'  => 'required',
            'start_date' => 'required',
            'end_date'   => 'required',
            'patient_id' => 'required',
        ];
    }


    public function attributes()
    {
        return [
            'service_id' => 'service',
            'patient_id' => 'patient information',
        ];
    }

    public function messages()
    {
        return [
            'service_id.required' => 'Please select some service.',
            'patient_id.required' => 'Please attach patient information.',
        ];
    }
}
