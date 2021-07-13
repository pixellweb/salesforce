<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorrespondanceTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('correspondances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('referentiel_id')->nullable();
            $table->string('referentiel_type')->index();
            $table->unsignedBigInteger('source_id')->index();
            $table->string('source_reference');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('correspondances');
    }
}
