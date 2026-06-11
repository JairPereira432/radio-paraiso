<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->enum('type', ['peticion_musical','denuncia','nota_voz','contacto_general']);
            $table->text('message');
            $table->string('audio_file')->nullable();
            $table->boolean('read')->default(false);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('contacts'); }
};