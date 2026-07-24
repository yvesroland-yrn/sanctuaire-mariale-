<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admins = [
            [
                'email' => 'admin@sanctuaire.local',
                'password' => 'password123',
                'nom' => 'Admin',
                'prenom' => 'Sanctuaire',
                'telephone' => '+225 07 00 00 00 28',
                'adresse' => 'Sassako, Côte d\'Ivoire',
            ],
            [
                'email' => 'admin@mudea.com',
                'password' => '12345',
                'nom' => 'Admin',
                'prenom' => 'MUDEA',
                'telephone' => '+225 07 00 00 00 28',
                'adresse' => 'Abidjan, Côte d\'Ivoire',
            ],
        ];

        foreach ($admins as $admin) {
            $payload = [
                'email' => $admin['email'],
                'password' => Hash::make($admin['password']),
                'email_verified_at' => now(),
                'updated_at' => now(),
                'created_at' => now(),
            ];

            foreach (['nom', 'prenom', 'telephone', 'role', 'statut', 'photo', 'adresse', 'last_login_at', 'remember_token', 'deleted_at'] as $column) {
                if (Schema::hasColumn('users', $column) && array_key_exists($column, $admin)) {
                    $payload[$column] = $admin[$column];
                }
            }

            if (Schema::hasColumn('users', 'role')) {
                $payload['role'] = 'admin';
            }

            if (Schema::hasColumn('users', 'statut')) {
                $payload['statut'] = 'actif';
            }

            DB::table('users')->updateOrInsert(
                ['email' => $admin['email']],
                $payload
            );
        }

        $this->command?->info('Comptes admin créés ou mis à jour avec succès');
        $this->command?->info('Email: admin@sanctuaire.local / Mot de passe: password123');
        $this->command?->info('Email: admin@mudea.com / Mot de passe: 12345');
    }
}
