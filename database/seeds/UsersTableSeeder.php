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
                'password'       => '$2y$10$RM.pVOa3m1ncChELrH0FDeoEsDcNLfipR1A2jS8wdbgavaLH5y2Ji',
                'remember_token' => null,
                'middle_name'    => '',
                'last_name'      => '',
            ],
        ];

        User::insert($users);
    }
}
