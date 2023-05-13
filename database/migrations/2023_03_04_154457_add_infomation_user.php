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
            //
            $table->string('name_id')->unique();
            $table->string('image')->nullable();
            $table->boolean('banned')->nullable();
            $table->integer('ano_nascimento')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('name_id')->unique();
            $table->string('image')->nullable();
            $table->boolean('banned')->nullable();
            $table->integer('ano_nascimento')->nullable();
        });
    }
};
