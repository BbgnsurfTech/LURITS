<?php

return [
    'userManagement'         => [
        'title'          => 'Gestion des utilisateurs',
        'title_singular' => 'Gestion des utilisateurs',
    ],
    'permission'             => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'title'             => 'Title',
            'title_helper'      => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'role'                   => [
        'title'          => 'Rôles',
        'title_singular' => 'Rôle',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'title'              => 'Title',
            'title_helper'       => '',
            'permissions'        => 'Permissions',
            'permissions_helper' => '',
            'created_at'         => 'Created at',
            'created_at_helper'  => '',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => '',
        ],
    ],
    'user'                   => [
        'title'          => 'Utilisateurs',
        'title_singular' => 'Utilisateur',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => '',
            'name'                     => 'First Name',
            'name_helper'              => '',
            'email'                    => 'Email',
            'email_helper'             => '',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => '',
            'password'                 => 'Password',
            'password_helper'          => '',
            'roles'                    => 'Roles',
            'roles_helper'             => '',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => '',
            'created_at'               => 'Created at',
            'created_at_helper'        => '',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => '',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => '',
            'team'                     => 'Team',
            'team_helper'              => '',
            'middle_name'              => 'Middle Name',
            'middle_name_helper'       => '',
            'last_name'                => 'Last Name',
            'last_name_helper'         => '',
            'profile_img'              => 'Profile Image',
            'profile_img_helper'       => '',
        ],
    ],
    'team'                   => [
        'title'          => 'Schools',
        'title_singular' => 'School',
        'fields'         => [
            'id'                        => 'ID',
            'id_helper'                 => '',
            'created_at'                => 'Created at',
            'created_at_helper'         => '',
            'updated_at'                => 'Updated At',
            'updated_at_helper'         => '',
            'deleted_at'                => 'Deleted At',
            'deleted_at_helper'         => '',
            'name'                      => 'School Name',
            'name_helper'               => '',
            'team'                      => 'School Name',
            'team_helper'               => '',
            'pseudo_code'               => 'School Pseudo Code',
            'pseudo_code_helper'        => '',
            'nemis_code'                => 'School NEMIS Code',
            'nemis_code_helper'         => '',
            'number_and_street'         => 'Number and street address',
            'number_and_street_helper'  => '',
            'school_community'          => 'School Community',
            'school_community_helper'   => 'Nearby community',
            'village_town'              => 'Village Town name',
            'village_town_helper'       => '',
            'email_address'             => 'Email Address',
            'email_address_helper'      => 'School official email address',
            'school_telephone'          => 'School official telephone',
            'school_telephone_helper'   => '',
            'code_type_sector'          => 'School Sector',
            'code_type_sector_helper'   => '',
            'latitude_north'            => 'Latitude North',
            'latitude_north_helper'     => '',
            'longitude_east'            => 'Longitude East',
            'longitude_east_helper'     => '',
            'ward'                      => 'Ward',
            'ward_helper'               => '',
            'nearby_name_school'        => 'Nearby School name',
            'nearby_name_school_helper' => '',
        ],
    ],
    'schoolManagement'       => [
        'title'          => 'School Management',
        'title_singular' => 'School Management',
    ],
    'recordsManagement'      => [
        'title'          => 'Records Management',
        'title_singular' => 'Records Management',
    ],
    'studentAdmission'       => [
        'title'          => 'Student Admission',
        'title_singular' => 'Student Admission',
        'fields'         => [
            'id'                      => 'ID',
            'id_helper'               => '',
            'child_name'              => 'First name',
            'child_name_helper'       => 'Child first name',
            'created_at'              => 'Created at',
            'created_at_helper'       => '',
            'updated_at'              => 'Updated at',
            'updated_at_helper'       => '',
            'deleted_at'              => 'Deleted at',
            'deleted_at_helper'       => '',
            'middle_name'             => 'Middle Name',
            'middle_name_helper'      => 'Child middle name if any',
            'last_name'               => 'Last Name',
            'last_name_helper'        => 'Child surname/last name (family name)',
            'admission'               => 'Admission',
            'admission_helper'        => '',
            'gender'                  => 'Gender',
            'gender_helper'           => 'Male/Female',
            'state_origin'            => 'State Origin',
            'state_origin_helper'     => 'State of Origin',
            'nationality_1'           => 'Nationality 1',
            'nationality_1_helper'    => '',
            'hubby'                   => 'Hubby',
            'hubby_helper'            => 'Football, reading, traveling e.t.c',
            'student_picture'         => 'Student Picture',
            'student_picture_helper'  => 'Student passport',
            'student_document'        => 'Student Document',
            'student_document_helper' => 'Upload any relevant documentation file',
            'school_enrolled'         => 'School Enrolled',
            'school_enrolled_helper'  => '',
            'parent_guardian'         => 'Parent/Guardian',
            'parent_guardian_helper'  => '',
            'team'                    => 'Team',
            'team_helper'             => '',
        ],
    ],
    'attendance'             => [
        'title'          => 'Student Attendance',
        'title_singular' => 'Student Attendance',
        'fields'         => [
            'id'                                 => 'ID',
            'id_helper'                          => '',
            'admission'                          => 'Admission',
            'admission_helper'                   => '',
            'attendance_status_morninig'         => 'Attendance Status Morninig',
            'attendance_status_morninig_helper'  => '',
            'attendance_status_afternoon'        => 'Attendance Status Afternoon',
            'attendance_status_afternoon_helper' => '',
            'late_status_y_n'                    => 'Late Status Y/N',
            'late_status_y_n_helper'             => '',
            'created_at'                         => 'Created at',
            'created_at_helper'                  => '',
            'updated_at'                         => 'Updated at',
            'updated_at_helper'                  => '',
            'deleted_at'                         => 'Deleted at',
            'deleted_at_helper'                  => '',
            'team'                               => 'Team',
            'team_helper'                        => '',
        ],
    ],
    'teacher'                => [
        'title'          => 'Teachers',
        'title_singular' => 'Teacher',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => '',
            'first_name'          => 'First Name',
            'first_name_helper'   => '',
            'middle_name'         => 'Middle Name',
            'middle_name_helper'  => '',
            'last_name'           => 'Last Name',
            'last_name_helper'    => '',
            'email'               => 'Email',
            'email_helper'        => '',
            'phone_number'        => 'Phone Number',
            'phone_number_helper' => '',
            'created_at'          => 'Created at',
            'created_at_helper'   => '',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => '',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => '',
            'team'                => 'Team',
            'team_helper'         => '',
        ],
    ],
    'teacherAttendance'      => [
        'title'          => 'Teacher Attendance',
        'title_singular' => 'Teacher Attendance',
        'fields'         => [
            'id'                                 => 'ID',
            'id_helper'                          => '',
            'admission'                          => 'Admission',
            'admission_helper'                   => '',
            'attendance_status_morninig'         => 'Attendance Status Morninig',
            'attendance_status_morninig_helper'  => '',
            'attendance_status_afternoon'        => 'Attendance Status Afternoon',
            'attendance_status_afternoon_helper' => '',
            'late_status_y_n'                    => 'Late Status Y/N',
            'late_status_y_n_helper'             => '',
            'created_at'                         => 'Created at',
            'created_at_helper'                  => '',
            'updated_at'                         => 'Updated at',
            'updated_at_helper'                  => '',
            'deleted_at'                         => 'Deleted at',
            'deleted_at_helper'                  => '',
            'team'                               => 'Team',
            'team_helper'                        => '',
        ],
    ],
    'classTimeTable'         => [
        'title'          => 'Class time table',
        'title_singular' => 'Class time table',
    ],
    'parentGuardian'         => [
        'title'          => 'Parent/Guardian',
        'title_singular' => 'Parent/Guardian',
    ],
    'parentGuardianregister' => [
        'title'          => 'Parent Guardian register',
        'title_singular' => 'Parent Guardian register',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => '',
            'first_name'          => 'First Name',
            'first_name_helper'   => '',
            'middle_name'         => 'Middle Name',
            'middle_name_helper'  => '',
            'last_name'           => 'Last Name',
            'last_name_helper'    => '',
            'email'               => 'Email',
            'email_helper'        => '',
            'phone_number'        => 'Phone Number',
            'phone_number_helper' => '',
            'created_at'          => 'Created at',
            'created_at_helper'   => '',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => '',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => '',
            'team'                => 'Team',
            'team_helper'         => '',
        ],
    ],
    'taskManagement'         => [
        'title'          => 'Task management',
        'title_singular' => 'Task management',
    ],
    'taskStatus'             => [
        'title'          => 'Statuses',
        'title_singular' => 'Status',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => '',
            'team'              => 'Team',
            'team_helper'       => '',
        ],
    ],
    'taskTag'                => [
        'title'          => 'Tags',
        'title_singular' => 'Tag',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => '',
        ],
    ],
    'task'                   => [
        'title'          => 'Tasks',
        'title_singular' => 'Task',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'name'               => 'Name',
            'name_helper'        => '',
            'description'        => 'Description',
            'description_helper' => '',
            'status'             => 'Status',
            'status_helper'      => '',
            'tag'                => 'Tags',
            'tag_helper'         => '',
            'attachment'         => 'Attachment',
            'attachment_helper'  => '',
            'due_date'           => 'Due date',
            'due_date_helper'    => '',
            'assigned_to'        => 'Assigned to',
            'assigned_to_helper' => '',
            'created_at'         => 'Created at',
            'created_at_helper'  => '',
            'updated_at'         => 'Updated At',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Deleted At',
            'deleted_at_helper'  => '',
            'team'               => 'Team',
            'team_helper'        => '',
        ],
    ],
    'tasksCalendar'          => [
        'title'          => 'Calendar',
        'title_singular' => 'Calendar',
    ],
    'assetManagement'        => [
        'title'          => 'Asset management',
        'title_singular' => 'Asset management',
    ],
    'assetCategory'          => [
        'title'          => 'Categories',
        'title_singular' => 'Category',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => '',
        ],
    ],
    'assetLocation'          => [
        'title'          => 'Locations',
        'title_singular' => 'Location',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => '',
            'team'              => 'Team',
            'team_helper'       => '',
        ],
    ],
    'assetStatus'            => [
        'title'          => 'Statuses',
        'title_singular' => 'Status',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => '',
        ],
    ],
    'asset'                  => [
        'title'          => 'Assets',
        'title_singular' => 'Asset',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => '',
            'category'             => 'Category',
            'category_helper'      => '',
            'serial_number'        => 'Serial Number',
            'serial_number_helper' => '',
            'name'                 => 'Name',
            'name_helper'          => '',
            'photos'               => 'Photos',
            'photos_helper'        => '',
            'status'               => 'Status',
            'status_helper'        => '',
            'location'             => 'Location',
            'location_helper'      => '',
            'notes'                => 'Notes',
            'notes_helper'         => '',
            'assigned_to'          => 'Assigned to',
            'assigned_to_helper'   => '',
            'created_at'           => 'Created at',
            'created_at_helper'    => '',
            'updated_at'           => 'Updated At',
            'updated_at_helper'    => '',
            'deleted_at'           => 'Deleted At',
            'deleted_at_helper'    => '',
            'team'                 => 'Team',
            'team_helper'          => '',
        ],
    ],
    'assetsHistory'          => [
        'title'          => 'Assets History',
        'title_singular' => 'Assets History',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => '',
            'asset'                => 'Asset',
            'asset_helper'         => '',
            'status'               => 'Status',
            'status_helper'        => '',
            'location'             => 'Location',
            'location_helper'      => '',
            'assigned_user'        => 'Assigned User',
            'assigned_user_helper' => '',
            'created_at'           => 'Created at',
            'created_at_helper'    => '',
            'updated_at'           => 'Updated At',
            'updated_at_helper'    => '',
            'team'                 => 'Team',
            'team_helper'          => '',
        ],
    ],
    'auditLog'               => [
        'title'          => 'Audit Logs',
        'title_singular' => 'Audit Log',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => '',
            'description'         => 'Description',
            'description_helper'  => '',
            'subject_id'          => 'Subject ID',
            'subject_id_helper'   => '',
            'subject_type'        => 'Subject Type',
            'subject_type_helper' => '',
            'user_id'             => 'User ID',
            'user_id_helper'      => '',
            'properties'          => 'Properties',
            'properties_helper'   => '',
            'host'                => 'Host',
            'host_helper'         => '',
            'created_at'          => 'Created at',
            'created_at_helper'   => '',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => '',
        ],
    ],
    'contactManagement'      => [
        'title'          => 'Contact management',
        'title_singular' => 'Contact management',
    ],
    'contactCompany'         => [
        'title'          => 'Companies',
        'title_singular' => 'Company',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => '',
            'company_name'           => 'Company name',
            'company_name_helper'    => '',
            'company_address'        => 'Address',
            'company_address_helper' => '',
            'company_website'        => 'Website',
            'company_website_helper' => '',
            'company_email'          => 'Email',
            'company_email_helper'   => '',
            'created_at'             => 'Created at',
            'created_at_helper'      => '',
            'updated_at'             => 'Updated At',
            'updated_at_helper'      => '',
            'deleted_at'             => 'Deleted At',
            'deleted_at_helper'      => '',
            'team'                   => 'Team',
            'team_helper'            => '',
        ],
    ],
    'contactContact'         => [
        'title'          => 'Contact Book',
        'title_singular' => 'Contact Book',
        'fields'         => [
            'id'                        => 'ID',
            'id_helper'                 => '',
            'company'                   => 'Company',
            'company_helper'            => '',
            'contact_first_name'        => 'First name',
            'contact_first_name_helper' => '',
            'contact_last_name'         => 'Last name',
            'contact_last_name_helper'  => '',
            'contact_phone_1'           => 'Phone 1',
            'contact_phone_1_helper'    => '',
            'contact_phone_2'           => 'Phone 2',
            'contact_phone_2_helper'    => '',
            'contact_email'             => 'Email',
            'contact_email_helper'      => '',
            'contact_skype'             => 'Skype',
            'contact_skype_helper'      => '',
            'contact_address'           => 'Address',
            'contact_address_helper'    => '',
            'created_at'                => 'Created at',
            'created_at_helper'         => '',
            'updated_at'                => 'Updated At',
            'updated_at_helper'         => '',
            'deleted_at'                => 'Deleted At',
            'deleted_at_helper'         => '',
            'team'                      => 'Team',
            'team_helper'               => '',
        ],
    ],
    'expenseManagement'      => [
        'title'          => 'Gestion des dépenses',
        'title_singular' => 'Gestion des dépenses',
    ],
    'expenseCategory'        => [
        'title'          => 'Catégories de dépenses',
        'title_singular' => 'Catégorie de dépenses',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => '',
        ],
    ],
    'incomeCategory'         => [
        'title'          => 'Catégories de revenu',
        'title_singular' => 'Catégorie de revenu',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => '',
        ],
    ],
    'expense'                => [
        'title'          => 'Dépenses',
        'title_singular' => 'Dépense',
        'fields'         => [
            'id'                      => 'ID',
            'id_helper'               => '',
            'expense_category'        => 'Expense Category',
            'expense_category_helper' => '',
            'entry_date'              => 'Entry Date',
            'entry_date_helper'       => '',
            'amount'                  => 'Amount',
            'amount_helper'           => '',
            'description'             => 'Description',
            'description_helper'      => '',
            'created_at'              => 'Created at',
            'created_at_helper'       => '',
            'updated_at'              => 'Updated At',
            'updated_at_helper'       => '',
            'deleted_at'              => 'Deleted At',
            'deleted_at_helper'       => '',
            'team'                    => 'Team',
            'team_helper'             => '',
        ],
    ],
    'income'                 => [
        'title'          => 'Revenus',
        'title_singular' => 'Revenus',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => '',
            'income_category'        => 'Income Category',
            'income_category_helper' => '',
            'entry_date'             => 'Entry Date',
            'entry_date_helper'      => '',
            'amount'                 => 'Amount',
            'amount_helper'          => '',
            'description'            => 'Description',
            'description_helper'     => '',
            'created_at'             => 'Created at',
            'created_at_helper'      => '',
            'updated_at'             => 'Updated At',
            'updated_at_helper'      => '',
            'deleted_at'             => 'Deleted At',
            'deleted_at_helper'      => '',
            'team'                   => 'Team',
            'team_helper'            => '',
        ],
    ],
    'expenseReport'          => [
        'title'          => 'Rapport mensuel',
        'title_singular' => 'Rapport mensuel',
        'reports'        => [
            'title'             => 'Etats',
            'title_singular'    => 'Etat',
            'incomeReport'      => 'Rapport de revenus',
            'incomeByCategory'  => 'Revenu par catégorie',
            'expenseByCategory' => 'Dépenses par catégorie',
            'income'            => 'Revenus',
            'expense'           => 'Dépense',
            'profit'            => 'Gains',
        ],
    ],
    'contentManagement'      => [
        'title'          => 'Content management',
        'title_singular' => 'Content management',
    ],
    'contentCategory'        => [
        'title'          => 'Categories',
        'title_singular' => 'Category',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'slug'              => 'Slug',
            'slug_helper'       => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => '',
        ],
    ],
    'contentTag'             => [
        'title'          => 'Tags',
        'title_singular' => 'Tag',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'slug'              => 'Slug',
            'slug_helper'       => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => '',
        ],
    ],
    'contentPage'            => [
        'title'          => 'Pages',
        'title_singular' => 'Page',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => '',
            'title'                 => 'Title',
            'title_helper'          => '',
            'category'              => 'Categories',
            'category_helper'       => '',
            'tag'                   => 'Tags',
            'tag_helper'            => '',
            'page_text'             => 'Full Text',
            'page_text_helper'      => '',
            'excerpt'               => 'Excerpt',
            'excerpt_helper'        => '',
            'featured_image'        => 'Featured Image',
            'featured_image_helper' => '',
            'created_at'            => 'Created at',
            'created_at_helper'     => '',
            'updated_at'            => 'Updated At',
            'updated_at_helper'     => '',
            'deleted_at'            => 'Deleted At',
            'deleted_at_helper'     => '',
        ],
    ],
];
