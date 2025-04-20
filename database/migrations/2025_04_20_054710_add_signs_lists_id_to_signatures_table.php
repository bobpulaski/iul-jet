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
        Schema::table('signatures', function (Blueprint $table) {
            $table->unsignedBigInteger('signs_lists_id')->nullable()->after('id');

            // Установка внешнего ключа
            $table->foreign('signs_lists_id')
                  ->references('id')
                  ->on('signs_lists')
                  ->onDelete('cascade'); // Каскадное удаление
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('signatures', function (Blueprint $table) {
            $table->dropForeign(['signs_lists_id']); // Удаление внешнего ключа
            $table->dropColumn('signs_lists_id'); // Удаление колонки
        });
    }
};
