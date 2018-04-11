<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganisationTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organisation_type', function (Blueprint $table) {
            $table->integer('organisation_id')->unsigned();
            $table->integer('organisation_type_id')->unsigned();
            $table->string('reg_num')->nullable();

            $table->foreign('organisation_id')->references('id')->on('organisations');
            $table->foreign('organisation_type_id')->references('id')->on('organisation_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organisation_type');
    }
}
