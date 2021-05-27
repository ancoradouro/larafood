<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('detail_plans')) {

            Schema::create('detail_plans', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('plan_id');
                $table->String('name');
                $table->timestamps();
                $table->foreign('plans_id')->references('id')->on('plans')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('detail_plans');
    }
}
