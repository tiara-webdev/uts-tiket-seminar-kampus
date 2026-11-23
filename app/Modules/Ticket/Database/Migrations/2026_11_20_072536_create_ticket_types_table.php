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
        Schema::create('ticket_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id')->index(); // referensi ke Event, tanpa foreign key (beda modul)
            $table->string('name');
            $table->unsignedInteger('price');
            $table->unsignedInteger('quota');
            $table->unsignedInteger('reserved')->default(0);
            $table->timestamps();

            $table->unique(['event_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_types');
    }
};
