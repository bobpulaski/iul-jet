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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->boolean('is_title')->nullable()->default(true);
            $table->boolean('remember_signatures')->nullable()->default(true);
            $table->string('algorithm')->nullable()->default('md5');
            $table->boolean('is_footer')->nullable()->default(true);
            $table->string('file_type')->nullable()->default('pdf');
            $table->string('header_type')->nullable()->default('regular');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
