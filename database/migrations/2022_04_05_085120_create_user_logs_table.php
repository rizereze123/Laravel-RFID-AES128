<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_logs', function (Blueprint $table) {
            $table->id();
            //$table->text('user_card_uid')->foreign()->references('uid')->on('user_cards')->onDelete('cascade');
            $table->text('user_card_uid');
            $table->date('check_in_date')->nullable();
            $table->time('time_in', $precision = 0)->nullable();
            $table->time('time_out', $precision = 0)->nullable();
            $table->boolean('card_out')->default(0);
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
        Schema::dropIfExists('user_logs');
    }
}
