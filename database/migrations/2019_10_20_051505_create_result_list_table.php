<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_list', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('point_a')->comment("Điểm số bên A");
            $table->integer('point_b')->comment("Điểm số bên B");
            $table->integer('team_a')->nullable()->comment("Đội A");
            $table->integer('team_b')->nullable()->comment("Đội B");
            $table->string('group')->nullable()->comment("Thuộc bảng");
            $table->string('scorer_a')->nullable()->comment("Người ghi bàn bên A");
            $table->string('scorer_b')->nullable()->comment("Người ghi bàn bên B");
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
        Schema::dropIfExists('result_list');
    }
}
