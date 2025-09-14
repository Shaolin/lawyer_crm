<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('legal_cases', function (Blueprint $table) {
            $table->id();
            
            // Basic Case Information
            $table->string('title');
            $table->text('description')->nullable();
            
            // Case status
            $table->enum('status', ['open', 'in_progress', 'closed'])->default('open');
            
            // Relations
            $table->foreignId('user_id')->constrained()->onDelete('cascade');   // lawyer handling the case
            $table->foreignId('client_id')->constrained()->onDelete('cascade'); // client involved in the case
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('legal_cases');
    }
};
