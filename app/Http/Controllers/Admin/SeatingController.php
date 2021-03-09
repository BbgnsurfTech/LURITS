<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Seating;
use App\School;
use Illuminate\Http\Request;
use Auth;
use App\DsSeating;
use App\DsClassSector;

class SeatingController extends Controller
{
     public function index(Request $request)
    {
        if (!Auth::User()->is_headTeacher) {
            $data = $request->all();
            
            if (empty($data)) {
                return view('admin.seatings.adminPage');
            } else {
                // dd($data);
                if (empty($data['school'])) {
                    session()->flash('error','School field is required');
                    return redirect()->back();
                } else {
                    // dd($data['school']);
                    $school_id = $data['school'];
                    $school = School::find($school_id);
                    // dd($school->code_type_sector);
                    $classes = DsClassSector::where('sector_id', $school->code_type_sector)->with(['dsClass'])->get();
                    $seatings = DsSeating::all();
                    $data = Seating::where('school_id', $school_id)->get();

                    return view('admin.seatings.index', compact('classes', 'seatings', 'data', 'school_id'));
                }
            }
            
        } else {
            $classes = DsClassSector::where('sector_id', Auth::User()->school->code_type_sector)->with(['dsClass'])->get();
            // dd($classes[0]->dsClass);
            $seatings = DsSeating::all();
            $data = Seating::where('school_id', Auth::User()->school_id)->get();
            // dd($data);

            return view('admin.seatings.index', compact('classes', 'seatings', 'data'));
        }
        
    }

    public function store(Request $request)
    {
        if (!Auth::User()->is_headTeacher) {
            $school_id = $request->school_id;
        } else {
            $school_id = Auth::User()->school_id;
        }

        $data = $request->all();

        if ($data['id'][0] != null) {
            $condition = true; 
        } else {
            $condition = false;
        }

        foreach ($data['ids'] as $seatingData) {

            $b = $data[$seatingData];
            // dd($b);
            $c = str_split($seatingData);
            // dd($c);
            $data_id = Seating::where('school_id', $school_id)->max('id') + 1;
            // dd($data_id);
            if ($data_id == 1) {
                $model_id = str_pad($school_id, 15, "0", STR_PAD_RIGHT).$data_id;
            } else {
                $model_id = $data_id;
            }
            // dd($model_id);
            if ($condition) {
                $seating = Seating::where('school_id', $school_id)
                ->where('ds_class_id', $c[2])
                ->where('ds_seating_id', $c[0])
                ->first();
                $seating->no_seats = $b;
                // dd($seating);
                $result = $seating->update();
            } else {
                $seating = new Seating();
                $seating->id = $model_id;
                $seating->ds_class_id = $c[2];
                $seating->ds_seating_id = $c[0];
                $seating->no_seats = $b;
                $seating->school_id = $school_id;
                // dd($seating);
                $result = $seating->save();
            }
        }

        if ($result) {
            session()->flash('message', $condition ? 'Seating Data Updated Successfully' : 'Seating Data Inserted Successfully');
            if (!Auth::User()->is_headTeacher) {
                return redirect()->route('admin.seatings.index');
            } else {
               return redirect()->back();
            }
            
        } else {
            session()->flash('error', 'Operation Failed');
            return redirect()->back();
        }
        
        // split(pattern, string);
    }
}
