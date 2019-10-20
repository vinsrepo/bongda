<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('Tên người dùng');
            $table->string('password')->comment('Mật khẩu');
            $table->string('phone')->unique()->comment('Số điện thoại');
            $table->string('email')->unique()->comment('Địa chỉ email');
            $table->integer('role')->nullable()->comment('Quyền người dùng');
            $table->tinyInteger('status')->comment('1:Hoạt động,2 Đã khóa');
            $table->string('avatar')->nullable()->comment('Ảnh đại diện');
            $table->text('introduce')->nullable()->comment('Giới thiệu người dùng');
            $table->timestamps();
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
        Schema::dropIfExists('users');
    }
}
