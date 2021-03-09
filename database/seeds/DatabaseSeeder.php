<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            SchoolClassesTableSeeder::class,
            UsersTableSeeder::class,
            LessonsTableSeeder::class,
            RoleUserTableSeeder::class,
            AssetStatusTableSeeder::class,
            TaskStatusTableSeeder::class,
        ]);
    }
}
