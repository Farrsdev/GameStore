<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Note: This migration was a no-op because games table never had a genre column
     * (uses game_genre pivot table instead)
     */
    public function up()
    {
        // No-op: genre column was never in games table
        // Games uses pivot table (game_genre) for many-to-many relationship
    }

    public function down()
    {
        // No-op
    }
};
