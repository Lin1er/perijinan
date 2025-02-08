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
        Schema::create('ijins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('reason');
            $table->date('date_pick');
            $table->date('date_return');
            $table->dateTime('date_returned')->nullable();
            $table->string('status')->default('wait_approval');  // Status tunggal untuk seluruh alur proses
            $table->json('attachments')->nullable();  // Menyimpan semua lampiran dalam format JSON
            $table->text('notes')->nullable();  // Catatan umum
            $table->timestamps();  // Otomatis menyediakan created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ijins');
    }
};
