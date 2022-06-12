<?php
namespace App\Services;
use App\Models\type;

class TypeService{
    public function getAllTypes(){
        return type::all();
    }
}