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
            [
                'id'    => '51',
                'title' => 'task_management_access',
            ],
            [
                'id'    => '52',
                'title' => 'task_status_create',
            ],
            [
                'id'    => '53',
                'title' => 'task_status_edit',
            ],
            [
                'id'    => '54',
                'title' => 'task_status_show',
            ],
            [
                'id'    => '55',
                'title' => 'task_status_delete',
            ],
            [
                'id'    => '56',
                'title' => 'task_status_access',
            ],
            [
                'id'    => '57',
                'title' => 'task_tag_create',
            ],
            [
                'id'    => '58',
                'title' => 'task_tag_edit',
            ],
            [
                'id'    => '59',
                'title' => 'task_tag_show',
            ],
            [
                'id'    => '60',
                'title' => 'task_tag_delete',
            ],
            [
                'id'    => '61',
                'title' => 'task_tag_access',
            ],
            [
                'id'    => '62',
                'title' => 'task_create',
            ],
            [
                'id'    => '63',
                'title' => 'task_edit',
            ],
            [
                'id'    => '64',
                'title' => 'task_show',
            ],
            [
                'id'    => '65',
                'title' => 'task_delete',
            ],
            [
                'id'    => '66',
                'title' => 'task_access',
            ],
            [
                'id'    => '67',
                'title' => 'tasks_calendar_access',
            ],
            [
                'id'    => '68',
                'title' => 'asset_management_access',
            ],
            [
                'id'    => '69',
                'title' => 'asset_category_create',
            ],
            [
                'id'    => '70',
                'title' => 'asset_category_edit',
            ],
            [
                'id'    => '71',
                'title' => 'asset_category_show',
            ],
            [
                'id'    => '72',
                'title' => 'asset_category_delete',
            ],
            [
                'id'    => '73',
                'title' => 'asset_category_access',
            ],
            [
                'id'    => '74',
                'title' => 'asset_location_create',
            ],
            [
                'id'    => '75',
                'title' => 'asset_location_edit',
            ],
            [
                'id'    => '76',
                'title' => 'asset_location_show',
            ],
            [
                'id'    => '77',
                'title' => 'asset_location_delete',
            ],
            [
                'id'    => '78',
                'title' => 'asset_location_access',
            ],
            [
                'id'    => '79',
                'title' => 'asset_status_create',
            ],
            [
                'id'    => '80',
                'title' => 'asset_status_edit',
            ],
            [
                'id'    => '81',
                'title' => 'asset_status_show',
            ],
            [
                'id'    => '82',
                'title' => 'asset_status_delete',
            ],
            [
                'id'    => '83',
                'title' => 'asset_status_access',
            ],
            [
                'id'    => '84',
                'title' => 'asset_create',
            ],
            [
                'id'    => '85',
                'title' => 'asset_edit',
            ],
            [
                'id'    => '86',
                'title' => 'asset_show',
            ],
            [
                'id'    => '87',
                'title' => 'asset_delete',
            ],
            [
                'id'    => '88',
                'title' => 'asset_access',
            ],
            [
                'id'    => '89',
                'title' => 'assets_history_access',
            ],
            [
                'id'    => '90',
                'title' => 'audit_log_show',
            ],
            [
                'id'    => '91',
                'title' => 'audit_log_access',
            ],
            [
                'id'    => '92',
                'title' => 'contact_management_access',
            ],
            [
                'id'    => '93',
                'title' => 'contact_company_create',
            ],
            [
                'id'    => '94',
                'title' => 'contact_company_edit',
            ],
            [
                'id'    => '95',
                'title' => 'contact_company_show',
            ],
            [
                'id'    => '96',
                'title' => 'contact_company_delete',
            ],
            [
                'id'    => '97',
                'title' => 'contact_company_access',
            ],
            [
                'id'    => '98',
                'title' => 'contact_contact_create',
            ],
            [
                'id'    => '99',
                'title' => 'contact_contact_edit',
            ],
            [
                'id'    => '100',
                'title' => 'contact_contact_show',
            ],
            [
                'id'    => '101',
                'title' => 'contact_contact_delete',
            ],
            [
                'id'    => '102',
                'title' => 'contact_contact_access',
            ],
            [
                'id'    => '103',
                'title' => 'expense_management_access',
            ],
            [
                'id'    => '104',
                'title' => 'expense_category_create',
            ],
            [
                'id'    => '105',
                'title' => 'expense_category_edit',
            ],
            [
                'id'    => '106',
                'title' => 'expense_category_show',
            ],
            [
                'id'    => '107',
                'title' => 'expense_category_delete',
            ],
            [
                'id'    => '108',
                'title' => 'expense_category_access',
            ],
            [
                'id'    => '109',
                'title' => 'income_category_create',
            ],
            [
                'id'    => '110',
                'title' => 'income_category_edit',
            ],
            [
                'id'    => '111',
                'title' => 'income_category_show',
            ],
            [
                'id'    => '112',
                'title' => 'income_category_delete',
            ],
            [
                'id'    => '113',
                'title' => 'income_category_access',
            ],
            [
                'id'    => '114',
                'title' => 'expense_create',
            ],
            [
                'id'    => '115',
                'title' => 'expense_edit',
            ],
            [
                'id'    => '116',
                'title' => 'expense_show',
            ],
            [
                'id'    => '117',
                'title' => 'expense_delete',
            ],
            [
                'id'    => '118',
                'title' => 'expense_access',
            ],
            [
                'id'    => '119',
                'title' => 'income_create',
            ],
            [
                'id'    => '120',
                'title' => 'income_edit',
            ],
            [
                'id'    => '121',
                'title' => 'income_show',
            ],
            [
                'id'    => '122',
                'title' => 'income_delete',
            ],
            [
                'id'    => '123',
                'title' => 'income_access',
            ],
            [
                'id'    => '124',
                'title' => 'expense_report_create',
            ],
            [
                'id'    => '125',
                'title' => 'expense_report_edit',
            ],
            [
                'id'    => '126',
                'title' => 'expense_report_show',
            ],
            [
                'id'    => '127',
                'title' => 'expense_report_delete',
            ],
            [
                'id'    => '128',
                'title' => 'expense_report_access',
            ],
            [
                'id'    => '129',
                'title' => 'content_management_access',
            ],
            [
                'id'    => '130',
                'title' => 'content_category_create',
            ],
            [
                'id'    => '131',
                'title' => 'content_category_edit',
            ],
            [
                'id'    => '132',
                'title' => 'content_category_show',
            ],
            [
                'id'    => '133',
                'title' => 'content_category_delete',
            ],
            [
                'id'    => '134',
                'title' => 'content_category_access',
            ],
            [
                'id'    => '135',
                'title' => 'content_tag_create',
            ],
            [
                'id'    => '136',
                'title' => 'content_tag_edit',
            ],
            [
                'id'    => '137',
                'title' => 'content_tag_show',
            ],
            [
                'id'    => '138',
                'title' => 'content_tag_delete',
            ],
            [
                'id'    => '139',
                'title' => 'content_tag_access',
            ],
            [
                'id'    => '140',
                'title' => 'content_page_create',
            ],
            [
                'id'    => '141',
                'title' => 'content_page_edit',
            ],
            [
                'id'    => '142',
                'title' => 'content_page_show',
            ],
            [
                'id'    => '143',
                'title' => 'content_page_delete',
            ],
            [
                'id'    => '144',
                'title' => 'content_page_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
