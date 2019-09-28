<?php

namespace App\Http\Requests\Examination;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $rules = [
            'occlusion'                 => 'required',
            'periodontal_condition'     => 'required',
            'oral_hygiene'              => 'required',
            'abnormalities'             => 'required',
            'general_condition'         => 'required',
            'physician'                 => 'required',
            'nature_of_treatment'       => 'required',
            'allergies'                 => 'required',
            'previous_bleeding_history' => 'required',
            'chronic_ailment'           => 'required',
            'blood_pressure'            => 'required',
            'drugs_taken'               => 'required',
            'teeths.numbers.*'          => 'required|integer|between:1,32',
            'teeths.descriptions.*'     => 'required',
            'teeths.treatments.*'       => 'required',
            'teeths.surfaces.*'         => 'required',
            'teeths.statuses.*'         => 'required',
        ];

        if ($this->request->has('denture_upper')) {
            $rules['denture_upper']       = ['required'];
            $rules['denture_upper_since'] = ['required', 'digits:4', 'integer', 'min:1900', 'max:' . date('Y')];
        }

         if ($this->request->has('denture_lower')) {
            $rules['denture_lower']       = ['required'];
            $rules['denture_lower_since'] = ['required', 'digits:4', 'integer', 'min:1900', 'max:' . date('Y')];
        }

        
        return $rules;
    }

    public function attributes()
    {
        return [
            'teeths.treatments.*' => 'The treatment of tooth field',
            'teeths.surfaces.*'   => 'The surface of tooth field',
            'teeths.statuses.*'   => 'The status of tooth',
        ];
    }

    public function messages()
    {
        return [
            'teeths.treatments.*.required' => ':attribute is required (click the add details for selected tooth button)',
            'teeths.surfaces.*.required' => ':attribute is required (click the add details for selected tooth button)',
            'teeths.statuses.*.required' => ':attribute is required (click the add details for selected tooth button)',
        ];
    }

}
