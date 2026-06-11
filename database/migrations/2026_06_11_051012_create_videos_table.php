<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('youtube_id')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('category')->nullable();
            $table->boolean('featured')->default(false);
            $table->integer('views')->default(0);
            $table->enum('status', ['draft','published'])->default('published');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('videos'); }
};