<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$Zfns3W7doMxpSHimCPdtO.0jyaV7k6nTaZ5o1/bc3rs51PomhbpO.',
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}
