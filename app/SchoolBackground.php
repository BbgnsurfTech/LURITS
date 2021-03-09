<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolBackground extends Model
{
   protected $primaryKey = 'school_id';
    
    protected $fillable = [
    	'school_id',
		'year_establishment',
		'location',
		'code_type_school',
		'shift_system',
		'shared_facility',
		'no_shared_facilities',
		'multigrade_teaching',
		'distance_from_community',
		'distance_from_lga',
		'no_students_distance_to_school',
		'no_students_boarding_male',
		'no_students_boarding_female',
		'sdp',
		'sbmc',
		'pta',
		'date_last_inspection',
		'no_inspection',
		'authority_last_inspection',
		'conditional_cash_transfer',
		'school_grants',
		'security_guard',
		'ownership',
		'source_of_water',
		'source_of_electricity',
		'health_facility',
		'fence_wall',
		'no_usable_toilets',
		'no_unusable_toilets',
		'no_usable_computers',
		'no_unusable_computers',
		'no_usable_water_sources',
		'no_unusable_water_sources',
		'no_usable_laboratories',
		'no_unusable_laboratories',
		'no_usable_classrooms',
		'no_unusable_classrooms',
		'no_usable_libraries',
		'no_unusable_libraries',
		'no_usable_play_grounds',
		'no_unusable_play_grounds',
		'no_usable_hand_wash_facilities',
		'no_unusable_hand_wash_facilities',
      'security',
      'no_staff_rooms',
      'no_office',
      'no_library',
      'no_laboratories',
      'no_store_room',
      'no_other_rooms',
      'sbmc_chair_name',
      'sbmc_chair_phone_number',
      'sbmc_chair_position',
    ];

    public function schoolLocation()
   	{
   		return $this->hasOne(DsSchoolLocation::class, 'id', 'location');
   	}

   	public function schoolType()
   	{
   		return $this->hasOne(DsSchoolType::class, 'id', 'code_type_school');
   	}

   	public function schoolAuthority()
   	{
   		return $this->hasOne(DsAuthority::class, 'id', 'authority_last_inspection');
   	}

   	public function schoolOwnership()
   	{
   		return $this->hasOne(DsSchoolOwnership::class, 'id', 'ownership');
   	}

   	public function waterSource()
   	{
   		return $this->hasOne(DsWaterSource::class, 'id', 'source_of_water');
   	}

   	public function electricitySource()
   	{
   		return $this->hasOne(DsElectricitySource::class, 'id', 'source_of_electricity');
   	}

   	public function healthFacility()
   	{
   		return $this->hasOne(DsHealthFacilities::class, 'id', 'health_facility');
   	}

   	public function shiftSystem()
   	{
   		return $this->hasOne(DsYesNo::class, 'id', 'shift_system');
   	}

   	public function shareFacilities()
   	{
   		return $this->hasOne(DsYesNo::class, 'id', 'shared_facility');
   	}

   	public function multigradeTeaching()
   	{
   		return $this->hasOne(DsYesNo::class, 'id', 'multigrade_teaching');
   	}

   	public function sdpYesNo()
   	{
   		return $this->hasOne(DsYesNo::class, 'id', 'sdp');
   	}

   	public function sbmcYesNo()
   	{
   		return $this->hasOne(DsYesNo::class, 'id', 'sbmc');
   	}

   	public function ptaYesNo()
   	{
   		return $this->hasOne(DsYesNo::class, 'id', 'pta');
   	}

   	public function schoolGrants()
   	{
   		return $this->hasOne(DsYesNo::class, 'id', 'school_grants');
   	}

   	public function securityGuard()
   	{
   		return $this->hasOne(DsYesNo::class, 'id', 'security_guard');
   	}

   	public function fenceWall()
   	{
   		return $this->hasOne(DsYesNo::class, 'id', 'fence_wall');
   	}

      public function securityChallange()
      {
         return $this->hasOne(DsYesNo::class, 'id', 'security');
      }
}
