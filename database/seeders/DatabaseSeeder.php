<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Histories;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Crear el primer usuario
        User::create([
            'identification_number' => '1096251126',
            'first_name' => 'Brayan',
            'last_name' => 'Diaz',
            'email' => 'brayan@gmail.com',
            'phone_number' => '3182834018',
            'location' => 'Colombia',
            'password' => bcrypt('1096251126'), // Asegúrate de encriptar la contraseña
            'type' => 1,
        ]);

        // Crear el segundo usuario
        User::create([
            'identification_number' => '987654321',
            'first_name' => 'María',
            'last_name' => 'González',
            'email' => 'maria@example.com',
            'phone_number' => '555-123-4567',
            'location' => 'Bogotá, Colombia',
            'password' => bcrypt('987654321'), // Asegúrate de encriptar la contraseña
            'type' => 2,
        ]);

        Histories::create([
                'patient_id' => 2,
                'professional_id' => 1,
                'patient_info' => 'Información del paciente...',
                'date_time' => '2024-05-15 18:20:00',
                'consecutive_number' => 1,
                'patient_status' => 'Estado del paciente...',
                'medical_history' => 'Historia médica...',
                'final_evolution' => 'Evolución final...',
                'professional_concept' => 'Concepto profesional...',
                'recommendations' => 'Recomendaciones...'
            
        ]);
    }
}
