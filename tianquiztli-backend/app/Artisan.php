<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artisan extends Model
{
    public function user()
    {
        return $this->hasOne("App/User");
    }

    public function products()
    {
        return $this->hasMany("App/Product");
    }
}
