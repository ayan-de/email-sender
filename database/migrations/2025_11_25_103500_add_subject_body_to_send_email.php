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
            if (!Schema::hasColumn('send_email', 'subject')) {
                $table->string('subject')->nullable()->after('user_id');
            }
            if (!Schema::hasColumn('send_email', 'body')) {
                $table->text('body')->nullable()->after('subject');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('send_email', function (Blueprint $table) {
            if (Schema::hasColumn('send_email', 'body')) {
                $table->dropColumn('body');
            }
            if (Schema::hasColumn('send_email', 'subject')) {
                $table->dropColumn('subject');
            }
        });
    }
};
