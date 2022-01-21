<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   
    const CREATED_AT = null;
    const UPDATED_AT = null;

    public function SaleDetail()
    {
        return $this->hasOne("App/SaleDetail");
    }
    
    public function categorie()
    {
        return $this->hasOne("App/Categorie");
    }

    public function artisan(){
        return $this->hasOne("App/Artisan");
    }

    public function image()
    {
        return $this->hasOne("App/Image");
    }
}
