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
        Schema::table('nodes', function (Blueprint $table) {
            $table->string('containerText')->default('container@coramtix~')->after('name');
            $table->string('daemonText')->default('[CoRamTix Daemon]:')->after('containerText');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nodes', function (Blueprint $table) {
            $table->dropColumn('containerText');
            $table->dropColumn('daemonText');
        });
    }
};
