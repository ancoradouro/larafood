<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (!Schema::hasTable('plans')) {
            
            Schema::create('plans', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->String('name')->unique();
                $table->String('url')->unique();
                $table->Double('price', 10, 2);
                $table->String('description')->nullable();
                $table->timestamps();                
            });

        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
}
