<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBehaviorBehaviorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('behavior_behavior', function (Blueprint $table) {
            $table->foreignId('parent_behavior_id')->references('id')->on('behaviors')->onDelete('cascade')->onUpdate('cascade')->primary();
            $table->foreignId('child_behavior_id')->references('id')->on('behaviors')->onDelete('cascade')->onUpdate('cascade')->primary();
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
        Schema::dropIfExists('behavior_behavior');
    }
}
