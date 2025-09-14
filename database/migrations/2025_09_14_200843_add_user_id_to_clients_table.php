<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
{
    Schema::table('clients', function (Blueprint $table) {
        $table->foreignId('user_id')
              ->after('organization_id')
              ->nullable()
              ->constrained()
              ->onDelete('cascade');
    });

    // backfill
    DB::table('clients')->update(['user_id' => 1]);
    
    Schema::table('clients', function (Blueprint $table) {
        $table->foreignId('user_id')->nullable(false)->change();
    });
}


    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');
        });
    }
};
