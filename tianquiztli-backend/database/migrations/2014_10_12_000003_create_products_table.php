<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_artisan')->constrained('artisans');
            $table->foreignId('id_categorie')->constrained('categories');
            $table->string('product_name',30);
            $table->float('price');
            $table->string('dimentions',100);
            $table->float('product_weight');
            $table->string('size',30);
            $table->string('stock',11);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
