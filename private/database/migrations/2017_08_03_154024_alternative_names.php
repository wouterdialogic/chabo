<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlternativeNames extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alternative_names', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('alternative_name')->unique();

            $table->string('created_by')->nullable();;
            $table->string('modified_by')->nullable();;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alternative_names');
    }
}
