
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // e.g. "Affidavit", "Court Filing"
            $table->text('description')->nullable();
            $table->string('file_path'); // stored path to the uploaded file

            // Relations
            $table->foreignId('client_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('legal_case_id')->nullable()->constrained('legal_cases')->nullOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // uploaded by
            $table->foreignId('organization_id')->nullable()->constrained()->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
