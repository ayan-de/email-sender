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
        Schema::create('send_email', function (Blueprint $table) {
            $table->id();
            $table->string('user_email');
            $table->string('subject')->nullable();
            $table->text('body')->nullable();
            $table->boolean('is_sent')->default(false);
            $table->integer('is_retry')->default(0);
            $table->timestamps();

            // Foreign key constraint to users table email column
            $table->foreign('user_email')
                  ->references('email')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('send_email');
    }
};
