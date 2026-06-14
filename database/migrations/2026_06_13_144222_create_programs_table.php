<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('host')->nullable();
            $table->string('image')->nullable();
            $table->enum('day_type', ['lunes_viernes','sabados','domingos','todos'])->default('todos');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('color')->default('#00d4aa');
            $table->boolean('active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('programs'); }
};