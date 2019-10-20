<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_list', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('Tên cầu thủ');
            $table->integer('number')->nullable()->comment('Số áo');
            $table->integer('team')->nullable()->comment('Thuộc team');    
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
        Schema::dropIfExists('player_list');
    }
}
