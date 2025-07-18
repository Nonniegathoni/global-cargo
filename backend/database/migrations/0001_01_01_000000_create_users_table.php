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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 150);
            $table->string('last_name', 150);
            $table->string('email_address', 150)->nullable();
            $table->string('phone_number', 50)->nullable();
            $table->text('address')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('ships', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('registration_number', 200)->unique();
            $table->decimal('capacity_in_tonnes', 10, 2)->nullable();
            $table->enum('type', ['cargo ship', 'passenger ship', 'military ship', 'icebreaker', 'fishing vessel', 'barge ship'])->default('cargo ship');
            $table->enum('status', ['active', 'under maintenance', 'decommissioned'])->default('active');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('crew', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ship_id')->nullable()->constrained('ships')->nullOnDelete();
            $table->string('first_name', 150);
            $table->string('last_name', 150);
            $table->enum('role', [
                'Captain', 'Chief Officer', 'Able Seaman', 'Ordinary Seaman',
                'Engine Cadet', 'Radio Officer', 'Chief Cook', 'Steward', 'Deckhand'
            ])->default('Captain');
            $table->string('phone_number', 30);
            $table->string('nationality', 100)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('ports', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('country', 100);
            $table->string('port_type', 100)->nullable();
            $table->string('coordinates', 50)->nullable();
            $table->float('depth')->nullable();
            $table->integer('docking_capacity')->nullable();
            $table->float('max_vessel_size')->nullable();
            $table->string('security_level', 50)->nullable();
            $table->boolean('customs_authorized')->nullable();
            $table->string('operational_hours', 50)->nullable();
            $table->string('port_manager', 255)->nullable();
            $table->string('port_contact_info', 255)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('cargo', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable();
            $table->decimal('weight', 10, 2)->nullable();
            $table->decimal('volume', 10, 2)->nullable();
            $table->foreignId('client_id')->nullable()->constrained('clients')->nullOnDelete();
            $table->enum('cargo_type', ['perishable', 'dangerous', 'general', 'other'])->default('general');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cargo_id')->nullable()->constrained('cargo')->nullOnDelete();
            $table->foreignId('ship_id')->nullable()->constrained('ships')->nullOnDelete();
            $table->foreignId('origin_port_id')->nullable()->constrained('ports')->nullOnDelete();
            $table->foreignId('destination_port_id')->nullable()->constrained('ports')->nullOnDelete();
            $table->date('departure_date')->nullable();
            $table->date('arrival_estimate')->nullable();
            $table->date('actual_arrival_date')->nullable();
            $table->enum('status', ['pending', 'in_transit', 'delivered', 'delayed'])->default('pending');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
        Schema::dropIfExists('ships');
        Schema::dropIfExists('crew');
        Schema::dropIfExists('ports');
        Schema::dropIfExists('cargo');
        Schema::dropIfExists('shipments');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
