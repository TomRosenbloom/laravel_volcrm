<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganisationAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organisation_address', function (Blueprint $table) {
            $table->integer('organisation_id')->unsigned();
            $table->integer('address_id')->unsigned();
            $table->boolean('is_default')->default(0);
            $table->integer('address_type_id')->nullable();

            $table->foreign('organisation_id')->references('id')->on('organisations');
            $table->foreign('address_id')->references('id')->on('addresses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organisation_address');
    }
}
