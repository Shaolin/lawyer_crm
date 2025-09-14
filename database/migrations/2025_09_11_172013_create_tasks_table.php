<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();

            // due date & time
            $table->dateTime('due_date')->nullable();

            // task status
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');

            // type of task (court_date, meeting, reminder, etc.)
            $table->string('type')->default('general');

            // relationships
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // lawyer/creator
            $table->foreignId('legal_case_id')->nullable()->constrained('legal_cases')->onDelete('cascade');
            $table->foreignId('organization_id')->nullable()->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
