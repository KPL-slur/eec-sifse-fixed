<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DigitsOr implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($firstDigit, $secondDigit)
    {
        $this->digits[] = $firstDigit;
        $this->digits[] = $secondDigit;
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
        $length = strlen((string) $value);

        return ! preg_match('/[^0-9]/', $value) 
                    && ($length == $this->digits[0] || $length == $this->digits[1]);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This input must be '.$this->digits[0].' or '.$this->digits[1].' digits.';
    }
}
