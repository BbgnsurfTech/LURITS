<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Asset;
use App\AssetCategory;
use App\AssetHistory;
use App\AssetStatus;
use App\Atlas;
use App\AtlasLink;
use App\AtlasUser;
use App\Attendance;
use App\Classroom;
use App\DsAcademicQualification;
use App\DsArms;
use App\DsBloodGroup;
use App\DsClass;
use App\DsClassroomCondition;
use App\DsClassSector;
use App\DsDisability;
use App\DsEconomicStatus;
use App\DsFlow;
use App\DsGender;
use App\DsMaritalStatus;
use App\DsPresentStatus;
use App\DsRank;
use App\DsReligion;
use App\DsSalarySource;
use App\DsSector;
use App\DsSubjectSector;
use App\DsTeachingQualification;
use App\DsTeachingType;
use App\DsTeachingTypePartTime;
use App\DsTypeStaff;
use App\DsTypeStaffSector;
use App\DsAuthority;
use App\DsClassroomFloorMaterial;
use App\DsClassroomRoofMaterial;
use App\DsClassroomWallMaterial;
use App\DsElectricitySource;
use App\DsHealthFacilities;
use App\DsSchoolLocation;
use App\DsSchoolOwnership;
use App\DsSchoolType;
use App\DsYesNo;
use App\Expense;
use App\ExpenseCategory;
use App\Income;
use App\IncomeCategory;
use App\Leave;
use App\Parents;
use App\Permission;
use App\Role;
use App\School;
use App\SchoolAtlas;
use App\Session;
use App\Subject;
use App\Term;
use App\User;
use App\DsParentalStatus;
use App\DsToilet;
use App\DsToiletUsage;
use App\DsUserTextbook;
use App\DsUserToilet;
use App\DsWaterSource;
use App\Models\Incidence;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAssetRequest;
use App\Http\Requests\UpdateAssetRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use DB;
use App\DsFacility;
use App\DsPlayRoom;
use App\DsPlayFacility;
use App\DsLearningMaterial;

class DataApiController extends Controller
{
    public function roles()
    {
        $roles = Role::all();
        return response($roles);
    }

    public function permissions()
    {

        $permissions = Permission::all();
        return response($permissions);
    }

    public function users()
    {
        $users = User::all();
        return response($users);
    }

    public function parameters()
    {
        return response([
            'parameters' => [
                'asset_categories' => AssetCategory::all(),
                'asset_statuses' => AssetStatus::all(),
                'ds_academic_qualification' => DsAcademicQualification::all(),
                'ds_arms' => DsArms::all(),
                'ds_authorities' => DsAuthority::all(),
                'ds_blood_group' => DsBloodGroup::all(),
                'ds_class' => DsClass::all(),
                'ds_classroom_conditions' => DsClassroomCondition::all(),
                'ds_classroom_floor_materials' => DsClassroomFloorMaterial::all(),
                'ds_classroom_wall_materials' => DsClassroomRoofMaterial::all(),
                'ds_classroom_roof_materials' => DsClassroomWallMaterial::all(),
                'ds_class_sector' => DsClassSector::all(),
                'ds_disabilities' => DsDisability::all(),
                'ds_economic_statuses' => DsEconomicStatus::all(),
                'ds_electricity_sources' => DsElectricitySource::all(),
                'ds_facilities' => DsFacility::all(),
                'ds_flow' => DsFlow::all(),
                'ds_gender' => DsGender::all(),
                'ds_health_facilities' => DsHealthFacilities::all(),
                'ds_learning_materials' => DsLearningMaterial::all(),
                'ds_marital_statuses' => DsMaritalStatus::all(),
                'ds_parental_statuses' => DsParentalStatus::all(),
                'ds_play_rooms' => DsPlayRoom::all(),
                'ds_play_facilities' => DsPlayFacility::all(),
                'ds_present_status' => DsPresentStatus::all(),
                'ds_ranks' => DsRank::all(),
                'ds_religion' => DsReligion::all(),
                'ds_salary_source' => DsSalarySource::all(),
                'ds_school_locations' => DsSchoolLocation::all(),
                'ds_school_ownerships' => DsSchoolOwnership::all(),
                'ds_school_types' => DsSchoolType::all(),
                'ds_sector' => DsSector::all(),
                'ds_subjects' => Subject::all(),
                'ds_subject_sector' => DsSubjectSector::all(),
                'ds_toilet' => DsToilet::all(),
                'ds_toilet_usage' => DsToiletUsage::all(),
                'ds_teaching_qualification' => DsTeachingQualification::all(),
                'ds_teaching_type' => DsTeachingType::all(),
                'ds_teaching_type_part_times' => DsTeachingTypePartTime::all(),
                'ds_term' => Term::all(),
                'ds_type_staff' => DsTypeStaff::all(),
                'ds_type_staff_sectors' => DsTypeStaffSector::all(),
                'ds_user_textbooks' => DsUserTextbook::all(),
                'ds_user_toilet' => DsUserToilet::all(),
                'ds_water_sources' => DsWaterSource::all(),
                'expense_categories' => ExpenseCategory::all(),
                'income_categories' => IncomeCategory::all(),
                'ds_yes_no' => DsYesNo::all(),
                'ds_year_session' => Session::all(),
            ],
            'atlas' => [
                'atlas_entity' => Atlas::all(),
                'atlas_link' => AtlasLink::all(),
                'atlas_users' => AtlasUser::all(),
                'school_atlas' =>  DB::select("select atlas_entity_1.code_atlas_entity as state_code, atlas_entity_1.name_atlas_entity as state_name, atlas_entity.code_atlas_entity as lga_code, atlas_entity.name_atlas_entity as lga_name, schools.id, schools.name, schools.pseudo_code, schools.nemis_code, schools.number_and_street, schools.school_community, schools.village_town, schools.email_address, schools.school_telephone, schools.code_type_sector,  schools.nearby_name_school from schools inner join ((atlas_entity inner join (atlas_link inner join atlas_entity as atlas_entity_1 on atlas_link.code_atlas_link = atlas_entity_1.code_atlas_entity) on atlas_entity.code_atlas_entity = atlas_link.code_atlas_entity) inner join school_atlas_entity on atlas_entity.code_atlas_entity = school_atlas_entity.code_atlas_entity) on schools.id = school_atlas_entity.school_id"),
            ],
        ]);
    }

    public function assetManagement()
    {
        return response([
            'assets' => Asset::with(["staff", "category", "status", "school", "assigned_to"])->get(),
            'asset_categories' => AssetCategory::all(),
            'asset_statuses' => AssetStatus::all(),
        ]);
    }

    public function expenseManagement()
    {
        return response([
            'expenses' => Expense::with(["expense_category", "school"])->get(),
            'expense_categories' => ExpenseCategory::all(),
            'incomes' => Income::with(["income_category", "school"])->get(),
            'income_categories' => IncomeCategory::all(),
        ]);
    }

    public function parents()
    {
        return response([
            'parents' => Parents::with(["incomeStatus", "school", "gender"])->get(),
        ]);
    }

    public function incidence()
    {
        return response([
            'incidence' => Incidence::with(["school"])->get(),
        ]);
    }

    public function classrooms()
    {
        return response([
            'classrooms' => Classroom::with(["school", "wall_material", "floor_material", "seating", "writing_board", "condition"])->get(),
        ]);
    }
    
}
