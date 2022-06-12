<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Equals implements Rule
{
    private $value_to_be_matched;
    private $error_message_value;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($value, $error_message_value = null)
    {
        $this->value_to_be_matched = $value;
        $this->error_message_value = $error_message_value;
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
        return $value == $this->value_to_be_matched;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must equals '. ($this->error_message_value == null ? $this->value_to_be_matched: $this->error_message_value);
    }
}
