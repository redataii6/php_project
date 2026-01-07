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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('note')->default(1);
            $table->string('nom');
            $table->string('prenom');
            $table->string('email');
            $table->string('phone_number');
            $table->text('message')->nullable();
            $table->boolean('accept_politique')->default(false);
            $table->string('ville');
            $table->boolean('visible')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
