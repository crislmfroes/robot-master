<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBehaviorState extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('behavior_state', function (Blueprint $table) {
            $table->foreignId('behavior_id')->references('id')->on('behaviors')->onDelete('cascade')->onUpdate('cascade')->primary();
            $table->foreignId('state_id')->references('id')->on('states')->onDelete('cascade')->onUpdate('cascade')->primary();
            $table->timestamps();
            $table->foreignId('state_param_id')->references('id')->on('state_params')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('behavior_state');
    }
}
