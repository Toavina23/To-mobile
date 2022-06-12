<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EqualsLieu implements Rule
{
    private $dernierTrajet;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($trajet)
    {
        $this->dernierTrajet = $trajet;
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
        return $this->dernierTrajet == null ? $value == 1 : $this->dernierTrajet->lieu_arrive == $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Le lieu de départ doit être '. ($this->dernierTrajet == null ? 'Garage entreprise' : $this->dernierTrajet->lieu_nom);
    }
}
