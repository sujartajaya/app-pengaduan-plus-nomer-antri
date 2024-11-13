<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('queues', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->foreignId('schedule_id')->constrained()->on('schedules')->onDelete('cascade');
            $table->foreignId('post_id')->constrained()->on('posts')->onDelete('cascade');
            $table->foreignId('civitas_id')->constrained()->on('civitas')->onDelete('cascade');
            $table->string('number')->unique(); /** kombinasi tanggal dan nomer urut 20241031000001 */
            $table->enum('status',['open','close','cancel'])->default('open');
            $table->enum('checkin',['true','false'])->default('false');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('queues');
    }
};
