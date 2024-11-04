<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitasDisponiblesSeeder extends Seeder
{
    public function run()
    {
        $citas = [
            ['especialidad' => 'Terapia Narrativa', 'hora' => '08:00:00', 'lugar' => 'Consultorio A', 'fecha' => '2024-10-27'],
            ['especialidad' => 'Psicoanálisis', 'hora' => '09:00:00', 'lugar' => 'Consultorio B', 'fecha' => '2024-10-27'],
            ['especialidad' => 'Terapia psicodinámica', 'hora' => '10:00:00', 'lugar' => 'Consultorio A', 'fecha' => '2024-10-27'],
            ['especialidad' => 'Terapia sistémica', 'hora' => '11:00:00', 'lugar' => 'Consultorio C', 'fecha' => '2024-10-27'],
            ['especialidad' => 'Consulta general', 'hora' => '12:00:00', 'lugar' => 'Consultorio B', 'fecha' => '2024-10-27'],
            ['especialidad' => 'Terapia Narrativa', 'hora' => '13:00:00', 'lugar' => 'Consultorio A', 'fecha' => '2024-10-27'],
            ['especialidad' => 'Psicoanálisis', 'hora' => '14:00:00', 'lugar' => 'Consultorio C', 'fecha' => '2024-10-27'],
            ['especialidad' => 'Terapia psicodinámica', 'hora' => '15:00:00', 'lugar' => 'Consultorio B', 'fecha' => '2024-10-27'],
            ['especialidad' => 'Terapia sistémica', 'hora' => '16:00:00', 'lugar' => 'Consultorio A', 'fecha' => '2024-10-27'],
            ['especialidad' => 'Consulta general', 'hora' => '17:00:00', 'lugar' => 'Consultorio C', 'fecha' => '2024-10-27'],
        ];

        DB::table('citas_disponibles')->insert($citas);
    }
}
