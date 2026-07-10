<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            
            // Business information
            $table->string('business_name');
            $table->string('account_number');
            $table->text('business_address');
            $table->string('phone', 20);
            $table->text('note')->nullable();
            
            // Financial details
            $table->decimal('amount', 10, 2);
            $table->decimal('delivery_charge', 10, 2);
            
            // Receiver information
            $table->string('receiver_name');
            $table->text('receiver_address');
            
            // Delivery details
            $table->date('delivery_date');
            $table->string('invoice_code')->unique();
            $table->string('driver_name')->nullable();
            
            // Status
            $table->enum('status', ['pending', 'done', 'cancelled'])->default('pending');
            
            // Foreign key
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            $table->timestamps();
            
            // Indexes for performance
            $table->index('invoice_code');
            $table->index('status');
            $table->index('delivery_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};