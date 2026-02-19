<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear o recuperar usuario administrador
        $admin = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // Crear equipo para el administrador si no tiene uno
        if (!$admin->currentTeam) {
            $adminTeam = Team::forceCreate([
                'user_id' => $admin->id,
                'name' => explode(' ', $admin->name, 2)[0]."'s Team",
                'personal_team' => true,
            ]);
            $admin->current_team_id = $adminTeam->id;
            $admin->save();
        }

        // Crear o recuperar usuario regular de ejemplo
        $user = User::firstOrCreate(
            ['email' => 'user@user.com'],
            [
                'name' => 'Usuario',
                'password' => Hash::make('password'),
                'role' => 'user',
                'email_verified_at' => now(),
            ]
        );

        // Crear equipo para el usuario regular si no tiene uno
        if (!$user->currentTeam) {
            $userTeam = Team::forceCreate([
                'user_id' => $user->id,
                'name' => explode(' ', $user->name, 2)[0]."'s Team",
                'personal_team' => true,
            ]);
            $user->current_team_id = $userTeam->id;
            $user->save();
        }
    }
}
