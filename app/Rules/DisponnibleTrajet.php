<?php

namespace App\Rules;

use App\Models\VehiculeDisponibleTrajet;
use Illuminate\Contracts\Validation\Rule;

class DisponnibleTrajet implements Rule
{
    private $disponnibles;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($disponnibles)
    {
        $this->disponnibles = $disponnibles;
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
        foreach($this->disponnibles as $dispo){
            if($value == $dispo->vehicule_id){
                return true;
            }
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Véhicule non disponnible';
    }
}
