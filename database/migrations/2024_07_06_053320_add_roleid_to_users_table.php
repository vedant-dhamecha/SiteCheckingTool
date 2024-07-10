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
        Schema::table('users', function (Blueprint $table) {
            // Add role_id column after the profile column, adjust as needed
            $table->unsignedBigInteger('role_id')->nullable()->after('profile');

            // Add foreign key constraint to role_id column
            $table->foreign('role_id')->references('role_id')->on('roles')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the foreign key first
            $table->dropForeign(['role_id']);
            // Then drop the role_id column
            $table->dropColumn('role_id');
        });
    }
};
