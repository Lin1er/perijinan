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
            $table->string('medic_attachment_link')->nullable(); // bukti surat izin medic
            $table->string('reason');
            $table->date('date_return');
            $table->date('date_pick');
            $table->string('verify_status')->default('0');
            $table->string('status')->default('0');
            $table->dateTime('returned_at')->nullable();  //siswa akan kembali pada tanggal sekian
            $table->string('pickup_attachment_link')->nullable(); // bukti siswa telah keluar
            $table->string('return_attachment_link')->nullable();  //bukti siswa telah kembali
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
