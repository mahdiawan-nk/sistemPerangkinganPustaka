<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            // Anggota (nullable untuk non-anggota)
            $table->foreignId('member_id')
                ->nullable()
                ->constrained('members')
                ->nullOnDelete();

            // Non anggota
            $table->string('guest_name')->nullable();
            $table->string('guest_identity')->nullable(); // NIK / NIM luar / no kartu
            $table->string('guest_phone')->nullable();

            // Metadata kunjungan
            $table->date('visit_date');
            $table->time('visit_time');

            $table->string('purpose')->nullable(); // tujuan kunjungan
            $table->string('visit_type')->default('onsite'); // onsite | online
            $table->string('source')->nullable(); // qr | manual | api

            // Optional analytics
            $table->ipAddress('ip_address')->nullable();
            $table->string('user_agent')->nullable();

            $table->timestamps();

            // Indexing (penting untuk laporan)
            $table->index(['visit_date']);
            $table->index(['member_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
