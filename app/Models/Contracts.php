<?php

namespace App\Models;

class Contracts extends Model
{
    public function a_user() {
        return $this->belongsTo(User::class, 'a_user_id','id');
    }
    public function b_user() {
        return $this->belongsTo(User::class, 'b_user_id','id');
    }

    public function things() {
        return $this->hasMany(ContractThings::class, 'contract_id', 'id');
    }

}
