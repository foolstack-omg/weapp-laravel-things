<?php

namespace App\Models;

class ThingMemories extends Model
{
    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function things() {
        return $this->belongsTo(ContractThings::class, 'contract_thing_id', 'id');
    }
}
