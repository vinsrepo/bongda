<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFootballTeamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('football_team', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment("Tên đội bóng");
            $table->string('avatar')->nullable()->comment("Ảnh đại diện");
            $table->string('note')->nullable()->comment("Ghi chú");
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
        Schema::dropIfExists('football_team');
    }
}
