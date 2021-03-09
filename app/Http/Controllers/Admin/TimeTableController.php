<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassSchedule;
use App\Models\Subject;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Redirect;
use Response;

class TimeTableController extends Controller
{
    public function index(Request $request){
        $week_days     = ClassSchedule::WEEK_DAYS;
        $time_table_data = $this->generateTimeTableData($week_days);

        $view = View('admin.pages.lessonmanagement.timetable', compact('week_days', 'time_table_data'))->render();
        return Response::json(['html' => $view]);
     }

    public function generateTimeTableData($week_days){

        $timeTableData = [];
        $timeRange = $this->generateTimeRange('08:00', '16:00');
        $schedules   = ClassSchedule::with('section', 'staff')
            ->TimeTableByRoleOrSectionId()
            ->get();

         foreach ($timeRange as $time)
        {
            $timeText = $time['start'] . ' - ' . $time['end'];
            $timeTableData[$timeText] = [];

            foreach ($week_days as $index => $day)
            {
               $schedule = $schedules->where('day_of_week', $index)->where('start_time', $time['start'])->first();
                if ($schedule)
                {
                    array_push($timeTableData[$timeText], [
                        'teacher_name' => $schedule->staff->full_name,
                        'subject_name' => DsSubject::find($schedule->subject_id)->name,
                        'rowspan'      => $schedule->difference/30 ?? ''
                    ]);
                }
                else if (!$schedules->where('day_of_week', $index)->where('start_time', '<', $time['start'])->where('end_time', '>=', $time['end'])->count())
                {
                    array_push($timeTableData[$timeText], 1);
                }
                else
                {
                    array_push($timeTableData[$timeText], 0);
                }
            }
        }

         return $timeTableData;
    }

    public function generateTimeRange($from, $to)
    {
        $time = Carbon::parse($from);
        $timeRange = [];

        do
        {
            array_push($timeRange, [
                'start' => $time->format("H:i"),
                'end' => $time->addMinutes(30)->format("H:i")
            ]);
        } while ($time->format("H:i") !== $to);

        return $timeRange;
    }
}
