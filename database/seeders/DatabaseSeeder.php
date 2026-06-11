<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Administrador',
            'email'    => 'admin@radioparaiso.com',
            'password' => 'Admin1234!', // Se hashea automáticamente
            'role'     => 'admin',
        ]);
    }
}
