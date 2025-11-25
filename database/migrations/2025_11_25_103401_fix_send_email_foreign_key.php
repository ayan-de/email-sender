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
        Schema::table('send_email', function (Blueprint $table) {
            // Drop the old foreign key constraint
            $table->dropForeign(['user_email']);
            
            // Add new user_id column
            $table->unsignedBigInteger('user_id')->after('id');
            
            // Add foreign key constraint using user_id
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            
            // Drop the old user_email column
            $table->dropColumn('user_email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('send_email', function (Blueprint $table) {
            // Drop the new foreign key
            $table->dropForeign(['user_id']);
            
            // Re-add user_email column
            $table->string('user_email')->after('id');
            
            // Re-add old foreign key constraint
            $table->foreign('user_email')
                  ->references('email')
                  ->on('users')
                  ->onDelete('cascade');
            
            // Drop user_id column
            $table->dropColumn('user_id');
        });
    }
};
