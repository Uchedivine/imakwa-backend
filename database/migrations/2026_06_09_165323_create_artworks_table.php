<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('artworks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artist_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('medium')->nullable();
            $table->string('dimensions')->nullable();
            $table->integer('year')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('currency')->default('USD');
            $table->enum('status', ['available', 'sold', 'reserved'])->default('available');
            $table->enum('site_context', ['gallery', 'worldcup', 'both'])->default('gallery');
            $table->string('category')->nullable();
            $table->string('region')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_approved')->default(false);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('artworks'); }
};