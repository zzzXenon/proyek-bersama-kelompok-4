<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pelanggaran_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pelanggaran_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('action'); // Description of the action (e.g., "Updated", "Commented").
            $table->text('details')->nullable(); // Details of the action (e.g., fields changed or comment text).
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('pelanggaran_id')->references('id')->on('pelanggaran')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelanggaran_logs');
    }
};
