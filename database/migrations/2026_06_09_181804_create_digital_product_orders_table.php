<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('digital_product_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('digital_product_tier_id')->constrained()->onDelete('cascade');
            $table->string('email');
            $table->string('download_token')->unique();
            $table->boolean('token_used')->default(false);
            $table->timestamp('token_expires_at')->nullable();
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');
            $table->string('payment_reference')->nullable();
            $table->string('payment_gateway')->nullable();
            $table->decimal('amount_paid', 10, 2)->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('digital_product_orders'); }
};