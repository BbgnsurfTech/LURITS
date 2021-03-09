<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ClassSchedule extends Model
{
    protected $table = 'class_schedules';
    protected $fillable = [
        'school_id',
        'class_id',
        'subject_id',
        'staff_id',
        'day_of_week',
        'start_time',
        'end_time'
    ];

    const WEEK_DAYS = [
        '1' => 'Monday',
        '2' => 'Tuesday',
        '3' => 'Wednesday',
        '4' => 'Thursday',
        '5' => 'Friday',
        '6' => 'Saturday',
        '7' => 'Sunday',
    ];

    public function getDifferenceAttribute()
    {
        return Carbon::parse($this->end_time)->diffInMinutes($this->start_time);
    }

    public function getStartTimeAttribute($value)
    {
        return $value ? Carbon::createFromFormat('H:i:s', $value)->format('H:i') : null;
    }

    public function setStartTimeAttribute($value)
    {
        $this->attributes['start_time'] = $value ? Carbon::createFromFormat('H:i',
            $value)->format('H:i:s') : null;
    }

    public function getEndTimeAttribute($value)
    {
        return $value ? Carbon::createFromFormat('H:i:s', $value)->format('H:i') : null;
    }

    public function setEndTimeAttribute($value)
    {
        $this->attributes['end_time'] = $value ? Carbon::createFromFormat('H:i',
            $value)->format('H:i:s') : null;
    }

    public function section(){
        return $this->belongsTo('App\Models\Section');
    }

    public function subject(){
        return $this->belongsTo('App\Models\Subject');
    }

    public function staff(){
        return $this->belongsTo('App\Staff');
    }

    public static function isTimeAvailable($weekday, $startTime, $endTime, $section, $teacher, $schedule)
    {
        $lessons = self::where('day_of_week', $weekday)
            ->when($schedule, function ($query) use ($schedule) {
                $query->where('id', '!=', $schedule);
            })
            ->where(function ($query) use ($section, $teacher) {
                $query->where('section_id', $section)
                    ->orWhere('staff_id', $teacher);
            })
            ->where([
                ['start_time', '<', $endTime],
                ['end_time', '>', $startTime],
            ])
            ->count();

        return !$lessons;
    }

    public function scopeTimeTableByRoleOrSectionId($query)
    {
        // return $query->when(!request()->input('section_id'), function ($query) {
        //     $query->when(Auth::guard('staff')->user()->hasRole('teacher'), function ($query) {
        //         $query->where('staff_id', Auth::guard('staff')->user()->id);
        //     })
        //         ->when(Auth::guard('student')->user()->hasRole('student'), function ($query) {
        //             $query->where('section_id', Auth::guard('staff')->user()->section_id ?? '0');
        //         });
        // })

        //    ->when(request()->input('section_id'), function ($query) {
        //         $query->where('section_id', request()->input('section_id'));
        //     });
    }


}
