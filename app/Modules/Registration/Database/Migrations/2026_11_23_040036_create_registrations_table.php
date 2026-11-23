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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            // Referensi ke modul lain: kolom biasa tanpa foreign key
            $table->unsignedBigInteger('event_id')->index();
            $table->unsignedBigInteger('ticket_type_id')->index();

            // Snapshot data saat memesan
            $table->string('event_title');
            $table->string('ticket_type_name');
            $table->unsignedInteger('unit_price');
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('total_price');

            $table->string('status')->default('pending'); // pending / confirmed / cancelled / checked_in
            $table->string('ticket_code')->nullable()->unique();
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('checked_in_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
