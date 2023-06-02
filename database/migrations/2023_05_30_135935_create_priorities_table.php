<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('priorities', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('priorities')->insert([
            [
                'slug' => 'high',
                'name' => 'High Priority',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'medium',
                'name' => 'Medium Priority',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'low',
                'name' => 'Low Priority',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('priorities');
    }
};
