<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, remove duplicate send_email records, keeping only the most recent one for each user
        DB::statement('
            DELETE se1 FROM send_email se1
            INNER JOIN send_email se2 
            WHERE se1.user_id = se2.user_id 
            AND se1.id < se2.id
        ');
        
        Schema::table('send_email', function (Blueprint $table) {
            // Add unique constraint to user_id to enforce one-to-one relationship
            $table->unique('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('send_email', function (Blueprint $table) {
            // Drop the unique constraint
            $table->dropUnique(['user_id']);
        });
    }
};
