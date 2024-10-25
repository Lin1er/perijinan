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
            $table->foreignId('student_id')->constrained()->onDelete('cascade');  // Foreign key ke students
            $table->foreignId('user_id')->constrained()->onDelete('cascade');     // Foreign key ke users
            $table->string('class');
            $table->string('reason');
            $table->string('attachment_link')->nullable(); // bukti siswa telah keluar
            $table->date('date_out');
            $table->date('date_in');
            $table->string('verify_status')->default('0');
            $table->dateTime('returned_at')->nullable();  //siswa akan kembali pada tanggal sekian
            $table->integer('late_in_minutes')->nullable(); // waktu terlambat(menit)
            $table->string('return_attachment_link')->nullable();  //bukti siswa telah kembali
            $table->string('status')->default('0');
            $table->timestamps();
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
