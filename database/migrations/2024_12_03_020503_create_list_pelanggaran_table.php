<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListPelanggaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_pelanggaran', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelanggaran'); 
            $table->integer('poin'); 
            $table->string('tingkat');
            $table->timestamps(); // Timestamp untuk created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('list_pelanggaran'); // Pastikan nama tabel konsisten
    }
}
