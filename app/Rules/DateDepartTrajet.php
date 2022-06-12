<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DateDepartTrajet implements Rule
{
    private $dernierTrajet;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($date_arrive_dernier_trajet)
    {
        $this->dernierTrajet = $date_arrive_dernier_trajet;
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
        return $this->dernierTrajet == null ? true : strtotime($this->dernierTrajet->date_arrive) <= strtotime($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'La date d\'arrivé doit être après ou égale à '.$this->dernierTrajet->date_arrive;
    }
}
