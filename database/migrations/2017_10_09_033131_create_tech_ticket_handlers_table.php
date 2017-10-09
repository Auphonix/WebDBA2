<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTechTicketHandlersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tech_ticket_handlers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('techUserID')->unsigned();
            $table->integer('ticketID')->unsigned();
            $table->timestamps();

            $table->foreign('techUserID')
                ->references('id')
                ->on('tech_users');
            $table->foreign('ticketID')
                ->references('id')
                ->on('tickets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tech_ticket_handlers');
    }
}
