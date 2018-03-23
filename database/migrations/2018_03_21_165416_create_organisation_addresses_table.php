<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganisationAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organisation_addresses', function (Blueprint $table) {
            $table->integer('organisation_id')->unsigned();
            $table->integer('address_id')->unsigned();
            $table->boolean('is_default');
            $table->integer('address_type_id');

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
        Schema::dropIfExists('organisation_addresses');
    }
}
