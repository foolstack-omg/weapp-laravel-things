<?php


namespace App\Models;

class ContractThings extends Model
{
    public function thing() {
        return $this->hasOne(Things::class, 'id', 'thing_id');
    }
}
