<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beer', function (Blueprint $table) {
            $table->addColumn('integer', 'idBeer', ['unsigned' => false, 'length' => 11])->autoIncrement();
            $table->string('name');
            $table->string('description')->nullable($value = true);
            $table->integer('idCompany');
            $table->integer('idType');
            $table->foreign('idCompany')->references('idCompany')->on('company')->onDelete('cascade');;
            $table->foreign('idType')->references('idType')->on('type')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beer');
    }
}
