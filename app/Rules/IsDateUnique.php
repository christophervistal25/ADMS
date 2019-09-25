<?php

namespace App\Rules;

use App\CloseDay;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class IsDateUnique implements Rule
{
    protected $attribute;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $this->attribute = $attribute;
        $value = Carbon::parse($value);
        return !CloseDay::whereDate($attribute, $value)->whereTime($attribute, $value)->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ucfirst($this->attribute) . ' date must be unique.';
    }
}
