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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->date('donation_date');
            $table->string('name', 100);
            $table->string('mobile', 10);
            $table->string('email', 50)->nullable();
            $table->string('pan_number', 15)->nullable();
            $table->string('address')->nullable();
            $table->unsignedBigInteger('payment_mode');
            $table->foreign('payment_mode')->references('id')->on('payment_modes')->onDelete('cascade');
            $table->decimal('amount', 10, 2)->default(0);
            $table->string('bank_cheque')->comment('Bank name or cheque number if applicable')->nullable();
            $table->text('remarks')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
