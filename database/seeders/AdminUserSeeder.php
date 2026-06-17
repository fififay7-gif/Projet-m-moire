<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'first_name' => 'Ndeye Fatou',
            'last_name' => 'DIOP',
            'email' => 'administrateur@gmail.com',
            'profil' => 'administrateur', // Changé ici pour correspondre parfaitement
            'password' => Hash::make('fatoufaye'),
        ]);
    }
}
