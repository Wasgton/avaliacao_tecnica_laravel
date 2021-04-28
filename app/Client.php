<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    public function phonesByClient()
    {
        return $this->hasMany(ClientsPhone::class,'client_id','id')->get();
    }

    public function createFor()
    {
        return $this->hasOne(User::class,'id','created_for')->first();
    }

    public function updatedFor()
    {
        return $this->hasOne(User::class,'id','updated_for')->first();
    }


}
