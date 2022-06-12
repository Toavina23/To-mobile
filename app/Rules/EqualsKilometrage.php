<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EqualsKilometrage implements Rule
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
        return $this->dernierTrajet == null ? true : $this->dernierTrajet->kilometrage_arrive == $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Le kilométrage de départ doit être à '. ($this->dernierTrajet == null ? 0 : $this->dernierTrajet->kilometrage_arrive);
    }
}
