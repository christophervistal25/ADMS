<?php

namespace App\Http\Requests\Patient;

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
        $martial_status = ['Married', 'Single', 'Divorced', 'Widowed'];
        $sex            = ['Women', 'Men', 'Choose not to say'];
        return [
              'name'           => 'required',
              'email'          => 'required|unique:patients',
              'mobile_no'      => 'required|unique:patients',
              'password'       => 'required|min:8|max:20|confirmed',
              'nickname'       => 'required',
              'birthdate'      => 'date',
              'martial_status' => ['required', Rule::in($martial_status)],
              'sex'            => ['required', Rule::in($sex)],
              'occupation'     => 'required',
              'home_address'   => 'required',
        ];
    }
}
