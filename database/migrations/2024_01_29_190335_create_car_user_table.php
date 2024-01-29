<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('car_user', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained(
                table: 'users',
                indexName: 'pivot_user_id'
            );

            $table->foreignId('car_id')->constrained(
                table: 'cars',
                indexName: 'pivot_car_id'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_cars');
    }
};
