<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsTable extends Migration
{
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->integer('age');
            $table->enum('previous_treatment', ['Sí', 'No']);
            $table->enum('stress_level', ['Bajo', 'Moderado', 'Alto']);
            $table->enum('stress_factors', ['Laborales', 'Financieros', 'Relacionales', 'Sociales']);
            $table->enum('symptom_intensity', ['Leve', 'Moderado', 'Grave']);
            $table->enum('symptom_frequency', ['Diario', 'Semanal', 'Mensual']);
            $table->enum('support_network', ['Amigos', 'Familia', 'Colegas', 'Terapia']);
            $table->enum('traumatic_events', ['Ninguno', 'Divorcio', 'Pérdida de empleo', 'Problemas familiares', 'Enfermedad propia']);
            $table->enum('self_harm', ['Sí', 'No']);
            $table->enum('suicidal_thoughts', ['Sí', 'No']);
            $table->string('medications')->nullable();
            $table->string('relaxation_methods')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tests');
    }
}
