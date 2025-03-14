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
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // Связь один-ко-многим
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Основная информация
            $table->string('name')->nullable(); // Наименование объекта*
            $table->integer('order_number')->nullable(); // № п/п
            $table->string('document_designation')->nullable(); // Обозначение документа*
            $table->string('document_name')->nullable(); // Наименование документа*
            $table->integer('version_number')->nullable(); // № версии*

            $table->json('responsible_persons')->nullable(); // Подписи

            $table->string('hash')->nullable();
            $table->string('file_name')->nullable();
            $table->string('formatted_date')->nullable();
            $table->integer('file_size')->nullable();


            $table->string('algorithm')->nullable();

            $table->string('description')->nullable(); // Обозначение
            $table->tinyInteger('page')->nullable(); // Лист
            $table->tinyInteger('pages')->nullable(); // Листов

            $table->boolean('is_title')->nullable()->default(true);
            $table->string('header_type')->nullable()->default('regular');
            $table->boolean('is_footer')->nullable()->default(true);

            $table->boolean('remember_signatures')->nullable()->default(true);
            $table->string('file_type')->nullable()->default('pdf');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
