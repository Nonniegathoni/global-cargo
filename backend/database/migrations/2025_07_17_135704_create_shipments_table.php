<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cargo_id');
            $table->unsignedBigInteger('ship_id');
            $table->unsignedBigInteger('origin_port_id')->nullable();
            $table->unsignedBigInteger('destination_port_id')->nullable();
            $table->date('departure_date')->nullable();
            $table->date('arrival_estimate')->nullable();
            $table->date('actual_arrival_date')->nullable();
            $table->enum('status', ['pending', 'in_transit', 'delivered', 'delayed'])->default('pending');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->foreign('cargo_id')->references('id')->on('cargo')->onDelete('cascade');
            $table->foreign('ship_id')->references('id')->on('ships')->onDelete('cascade');
            $table->foreign('origin_port_id')->references('id')->on('ports')->onDelete('set null');
            $table->foreign('destination_port_id')->references('id')->on('ports')->onDelete('set null');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
}; 