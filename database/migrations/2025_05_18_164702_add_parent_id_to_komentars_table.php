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
        Schema::table('komentars', function (Blueprint $table) {
            if (!Schema::hasColumn('komentars', 'parent_id')) {
                $table->foreignId('parent_id')->nullable()->constrained('komentars')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('komentars', function (Blueprint $table) {
            if (Schema::hasColumn('komentars', 'parent_id')) {
                $table->dropForeign(['parent_id']);
                $table->dropColumn('parent_id');
            }
        });
    }
};
