<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePlayerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('player_list', function (Blueprint $table) {
            $tabel->string('position')->nullable()->comment('Vị trí cầu thủ')->after('number');
        });

        Schema::create('result_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('action')->comment('Hành động');
            $table->string('time_takes_place')->nullable()->comment('Thời gian diễn ra');
            $table->integer('player_id')->nullable()->comment('Cầu thủ thực hiện');
            $table->integer('match_id')->nullable()->comment('ID trận đấu');    
            $table->string('note')->nullable()->comment('Ghi chú của hành động');    
            $table->timestamps();
        });

        Schema::create('football_team', function (Blueprint $table) {
            $table->integer('group')->nullable()->comment('Đội thuộc bảng đấu')->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('player_list', function (Blueprint $table) {
            //
        });
    }
}
