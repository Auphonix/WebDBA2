<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCommentsTicketsForTechUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['userID']);
            $table->dropColumn('userID');
            $table->integer('techUserID')->unsigned();
            $table->foreign('techUserID')
                ->references('id')
                ->on('tech_users');
        });

        Schema::table('tickets', function (Blueprint $table) {
            $table->string('priority');
            $table->integer('escalationLevel');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['techUserID']);
            $table->dropColumn('techUserID');
            $table->integer('userID')->unsigned();
            $table->foreign('userID')
                ->references('id')
                ->on('users');
        });

        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('priority');
            $table->dropColumn('escalationLevel');
        });
    }
}
