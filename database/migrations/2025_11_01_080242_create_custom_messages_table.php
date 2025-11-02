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
        Schema::create('custom_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('message_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('phone_code', 5)->nullable();
            $table->string('mobile', 15);
            $table->integer('letter_head')->nullable();
            $table->string('title')->nullable();
            $table->longText('message')->nullable();
            $table->text('wa_msg_id')->nullable();
            $table->foreignId('created_by')->constrained('users', 'id')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_messages');
    }
};
