<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogbookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logbook', function (Blueprint $table) {
            /**$table->id();*/
            $table->tinyIncrements('id');
            /**$table->timestamps();*/
            $table->date('datefiled');
            $table->enum('caselevel', ['Mediation', 'Case']);
            $table->enum('disposition', ['Settled', 'Withdrawn']); 	
            $table->dateTime('updated_at')->timestamps();
            $table->dateTime('created_at')->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logbook');
    }
}
