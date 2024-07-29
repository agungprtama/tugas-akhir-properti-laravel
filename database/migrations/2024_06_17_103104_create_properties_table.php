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
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // relasi ke tabel users
            $table->enum('offer_type', ['jual', 'sewa']);
            $table->date('rental_start_date')->nullable();
            $table->date('rental_end_date')->nullable();
            $table->enum('property_type', ['rumah', 'apartement', 'tanah']);
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 15, 2);
            $table->enum('furnished', ['ya', 'tidak', 'semi']);
            $table->integer('jumlah_lantai');
            $table->integer('bedrooms');
            $table->integer('bathrooms');
            $table->integer('building_area');
            $table->integer('land_area');
            $table->integer('garage')->nullable();
            $table->string('province');
            $table->string('city');
            $table->string('district');
            $table->string('address');
            $table->string('gmaps_link')->nullable();
            $table->string('image')->nullable();
            $table->string('other_links')->nullable();
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
