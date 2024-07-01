<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->after('name'); // Add first_name column after 'name'
            $table->string('last_name')->nullable()->after('first_name'); // Add last_name column after 'first_name'
            $table->string('cell_phone')->nullable()->after('last_name'); // Add cell_phone column after 'last_name'
            $table->string('home_phone')->nullable()->after('cell_phone'); // Add home_phone column after 'cell_phone'
            $table->string('address')->nullable()->after('home_phone'); // Add address column after 'home_phone'
            $table->string('profile')->nullable()->after('address'); // Add profile column after 'address'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('cell_phone');
            $table->dropColumn('home_phone');
            $table->dropColumn('address');
            $table->dropColumn('profile');
        });
    }
};
