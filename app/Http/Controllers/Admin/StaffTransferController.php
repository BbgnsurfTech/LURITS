<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Atlas;
use App\Staff;
use App\School;
use App\User;
use Auth;
use Validator;
use App\SchoolAtlas;
use App\AtlasLink;
use App\Notifications\StaffTransferNotification;
use App\Term;
use App\Session;
use DB;
use App\StaffTransfer;

class StaffTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staffs = Staff::where('school_id', Auth::User()->school_id)->get();

        if (!Auth::User()->is_headTeacher) {
            return view('admin.staff-transfer.index');
        } else {
            $transfers = StaffTransfer::where('current_school', Auth::User()->school_id)->orWhere('target_school', Auth::User()->school_id)->get();
            //dd($transfers);
            return view('admin.staff-transfer.teacher', compact('staffs', 'transfers'));
        }
    }

    public function getStaff(Request $request)
    {
        if ($request->ajax()) {
            $data = Staff::where('school_id', $request->school)->select('id', 'first_name', 'middle_name', 'last_name', 'lga_staff_id')->get();
            return json_encode($data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $staffs = Staff::all();
        // $schools = School::all();
        // return view('admin.staff-transfer.create', compact('staffs', 'schools'));
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $term_id = Term::where('active_status', 1)->pluck('id')->first();
        $session_id = Session::where('active_status', 1)->pluck('id')->first();

        $request->validate([
            'staff' => "required",
            'destination_school' => "required"
        ]);

        if (!Auth::User()->is_headTeacher) {
            $school_id = $request->school;
        } else {
            $school_id = Auth::User()->school_id;
        }

        $old = School::where('id', $school_id)->firstOrFail();
        $new = School::where('id', $request->destination_school)->firstOrFail();
        // dd($old, $new);
        // where('type_staff_id' = 1('type_staff_id' = 4))
        // where('type_staff_id'in(1, 4))

        $oldH = Staff::where('school_id', $old->id)
             ->where(function($q) {
                 $q->where('type_staff_id', 1)
                   ->orWhere('type_staff_id', 7);
             })
             ->pluck('user_id')->first();

        $newH = Staff::where('school_id', $new->id)
             ->where(function($q) {
                 $q->where('type_staff_id', 1)
                   ->orWhere('type_staff_id', 7);
             })
             ->pluck('user_id')->first();

        // dd($old, $new);
        // dd($oldH, $newH);

        $staff = $request->staff;
        DB::beginTransaction();
        try {
            // Not necessary for staff transfer since it will be recorded only online
            // $data_id = StaffTransfer::where('school_id', $school_id)->max('id') + 1;
            // if ($data_id == 1) {
            //     $model_id = str_pad($school_id, 15, "0", STR_PAD_RIGHT).$data_id;
            // } else {
            //     $model_id = $data_id;
            // }

            $record = new StaffTransfer();
            // $record->id = $model_id;
            $record->staff_id = $staff;
            $record->current_school = $old->id;
            $record->target_school = $new->id;
            $record->session_id = $session_id;
            $record->term_id = $term_id;
            $record->save();
            $record->toArray();

            $transfer = Staff::where('id', $staff)->firstOrFail();
            $transfer->school_id = $request->destination_school;
            $final = $transfer->update();

            // $user1 = User::findOrFail($oldH);
            // $user2 = User::findOrFail($newH);
            
            // $user1->notify(new StaffTransferNotification(User::findOrFail($oldH)));
            // $user2->notify(new StaffTransferNotification(User::findOrFail($oldH)));
            
            DB::commit();
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            session()->flash('error', 'Operation Failed');
            return redirect()->back();
        }

        if ($final) {
            $message = 'Staff has been transferred from '. $old->name . ' to ' . $new->name;
            session()->flash('message', $message);
            return redirect()->route('admin.staff-transfer.index');
        }
    }

    public function init(Request $request)
    {
        
    }

    public function req()
    {
        
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = StaffTransfer::where('id', $id)->with(['staff', 'currentSchool', 'targetSchool'])->first();
        return view('admin.staff-transfer.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort(404);
    }
}
