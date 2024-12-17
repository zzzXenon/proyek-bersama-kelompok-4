<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pelanggaran_id');
            $table->unsignedBigInteger('user_id');
            $table->text('comment');
            $table->string('file_path')->nullable();
            $table->timestamps();

            $table->foreign('pelanggaran_id')->references('id')->on('pelanggaran')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
};
