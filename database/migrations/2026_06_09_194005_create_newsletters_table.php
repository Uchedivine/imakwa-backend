<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('newsletters', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->longText('body');
            $table->enum('list', ['inner_circle', 'general', 'all'])->default('all');
            $table->enum('status', ['draft', 'sent'])->default('draft');
            $table->timestamp('sent_at')->nullable();
            $table->integer('recipient_count')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('newsletters'); }
};