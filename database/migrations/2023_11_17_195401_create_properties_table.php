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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('categorie');
            $table->string('image');
            $table->string('description');
            // $table->foreignId('user_id')->constrained('users');
            $table->float('dimension_bien');
            $table->integer('nombre_chambre');
            $table->float('dimension_chambre');
            $table->integer('nombre_toillette');
            $table->integer('balcons');  
            $table->enum('space_vert',['oui','non'])->default('non');  
            $table->string('addresse');
            $table->string('status');
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
