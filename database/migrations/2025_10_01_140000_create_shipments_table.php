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
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_number')->unique();
            
            // Shipper Information
            $table->string('shipper_name');
            $table->string('shipper_phone');
            $table->text('shipper_address');
            $table->string('shipper_email');
            
            // Receiver Information
            $table->string('receiver_name');
            $table->string('receiver_phone');
            $table->text('receiver_address');
            $table->string('receiver_email');
            
            // Shipment Details
            $table->string('agent_name')->nullable();
            $table->string('type_of_shipment')->nullable(); // select
            $table->string('weight')->nullable();
            $table->string('courier')->nullable();
            $table->string('packages')->nullable();
            $table->string('mode')->nullable(); // select
            $table->string('product')->nullable();
            $table->string('quantity')->nullable();
            
            // Payment & Freight
            $table->string('payment_mode')->nullable(); // select
            $table->string('total_freight')->nullable();
            
            // Carrier Information
            $table->string('carrier')->nullable(); // select
            $table->string('carrier_reference_no')->nullable();
            
            // Timing Information
            $table->time('departure_time')->nullable();
            $table->string('origin')->nullable(); // select
            $table->string('destination')->nullable(); // select
            $table->date('pickup_date')->nullable();
            $table->time('pickup_time')->nullable();
            $table->string('status')->default('pending'); // select
            $table->date('expected_delivery_date')->nullable();
            
            // Additional Information
            $table->text('comments')->nullable();
            $table->json('tracking_events')->nullable(); // array of tracking events
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
