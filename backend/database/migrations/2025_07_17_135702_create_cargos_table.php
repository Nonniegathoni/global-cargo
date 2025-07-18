<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cargo', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->decimal('weight', 10, 2)->nullable();
            $table->decimal('volume', 10, 2)->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->enum('cargo_type', ['perishable', 'dangerous', 'general', 'other']);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('set null');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('cargo');
    }
}; 