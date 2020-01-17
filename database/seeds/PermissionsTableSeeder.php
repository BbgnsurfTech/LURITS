<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => '1',
                'title' => 'user_management_access',
            ],
            [
                'id'    => '2',
                'title' => 'permission_create',
            ],
            [
                'id'    => '3',
                'title' => 'permission_edit',
            ],
            [
                'id'    => '4',
                'title' => 'permission_show',
            ],
            [
                'id'    => '5',
                'title' => 'permission_delete',
            ],
            [
                'id'    => '6',
                'title' => 'permission_access',
            ],
            [
                'id'    => '7',
                'title' => 'role_create',
            ],
            [
                'id'    => '8',
                'title' => 'role_edit',
            ],
            [
                'id'    => '9',
                'title' => 'role_show',
            ],
            [
                'id'    => '10',
                'title' => 'role_delete',
            ],
            [
                'id'    => '11',
                'title' => 'role_access',
            ],
            [
                'id'    => '12',
                'title' => 'user_create',
            ],
            [
                'id'    => '13',
                'title' => 'user_edit',
            ],
            [
                'id'    => '14',
                'title' => 'user_show',
            ],
            [
                'id'    => '15',
                'title' => 'user_delete',
            ],
            [
                'id'    => '16',
                'title' => 'user_access',
            ],
            [
                'id'    => '17',
                'title' => 'team_create',
            ],
            [
                'id'    => '18',
                'title' => 'team_edit',
            ],
            [
                'id'    => '19',
                'title' => 'team_show',
            ],
            [
                'id'    => '20',
                'title' => 'team_delete',
            ],
            [
                'id'    => '21',
                'title' => 'team_access',
            ],
            [
                'id'    => '22',
                'title' => 'school_management_access',
            ],
            [
                'id'    => '23',
                'title' => 'records_management_access',
            ],
            [
                'id'    => '24',
                'title' => 'student_admission_create',
            ],
            [
                'id'    => '25',
                'title' => 'student_admission_edit',
            ],
            [
                'id'    => '26',
                'title' => 'student_admission_show',
            ],
            [
                'id'    => '27',
                'title' => 'student_admission_delete',
            ],
            [
                'id'    => '28',
                'title' => 'student_admission_access',
            ],
            [
                'id'    => '29',
                'title' => 'attendance_create',
            ],
            [
                'id'    => '30',
                'title' => 'attendance_edit',
            ],
            [
                'id'    => '31',
                'title' => 'attendance_show',
            ],
            [
                'id'    => '32',
                'title' => 'attendance_delete',
            ],
            [
                'id'    => '33',
                'title' => 'attendance_access',
            ],
            [
                'id'    => '34',
                'title' => 'teacher_create',
            ],
            [
                'id'    => '35',
                'title' => 'teacher_edit',
            ],
            [
                'id'    => '36',
                'title' => 'teacher_show',
            ],
            [
                'id'    => '37',
                'title' => 'teacher_delete',
            ],
            [
                'id'    => '38',
                'title' => 'teacher_access',
            ],
            [
                'id'    => '39',
                'title' => 'teacher_attendance_create',
            ],
            [
                'id'    => '40',
                'title' => 'teacher_attendance_edit',
            ],
            [
                'id'    => '41',
                'title' => 'teacher_attendance_show',
            ],
            [
                'id'    => '42',
                'title' => 'teacher_attendance_delete',
            ],
            [
                'id'    => '43',
                'title' => 'teacher_attendance_access',
            ],
            [
                'id'    => '44',
                'title' => 'class_time_table_access',
            ],
            [
                'id'    => '45',
                'title' => 'parent_guardian_access',
            ],
            [
                'id'    => '46',
                'title' => 'parent_guardianregister_create',
            ],
            [
                'id'    => '47',
                'title' => 'parent_guardianregister_edit',
            ],
            [
                'id'    => '48',
                'title' => 'parent_guardianregister_show',
            ],
            [
                'id'    => '49',
                'title' => 'parent_guardianregister_delete',
            ],
            [
                'id'    => '50',
                'title' => 'parent_guardianregister_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
