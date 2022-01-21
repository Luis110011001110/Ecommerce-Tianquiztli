<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    const CREATED_AT = null;
    const UPDATED_AT = null;

    public function product()
    {
        return $this->hasOne("App/Product");
    }
}
