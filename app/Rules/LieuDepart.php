<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class LieuDepart implements Rule
{
    private $dernierTrajet;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($dernierTrajet)
    {
        $this->dernierTrajet = $dernierTrajet;
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
        return $this->dernierTrajet !=  null ? $this->dernierTrajet->lieu_arrive == $value : $value == 1;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->dernierTrajet !=  null ? $this->dernierTrajet->lieu_nom : 'Garage entreprise';
    }
}
