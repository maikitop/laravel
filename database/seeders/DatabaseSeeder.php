<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'fio' => 'Администратор Системы',
            'login' => 'admin',
            'email' => 'admin@test.ru',
            'phone' => '+7(999)999-99-99',
            'password' => Hash::make('adm123'),
            'role' => 'admin'
        ]);
    }
}
