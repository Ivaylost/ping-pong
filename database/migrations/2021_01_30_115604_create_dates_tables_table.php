<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatesTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dates_tables', function (Blueprint $table) {
            $table->primary(['date_id', 'table_id']);
            $table->unsignedBigInteger('date_id');
            $table->unsignedBigInteger('table_id');
            $table->string('reservations');
            $table->timestamps();
            $table->foreign('date_id')->references('id')->on('dates');
            $table->foreign('table_id')->references('id')->on('tables');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dates_tables');
    }
}
