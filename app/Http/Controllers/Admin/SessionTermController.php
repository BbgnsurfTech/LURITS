<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Session;
use App\Term;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Auth;

class SessionTermController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
       //abort_if(Gate::denies(''), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $currentSession = Session::where('active_status', 1)->first();
        $sessions = Session::all();
        $currentTerm = Term::where('active_status', 1)->first();
        $terms = Term::all();
        //dd($currentSession, $sessions);
        return view('admin.session.index', compact('currentSession', 'sessions', 'currentTerm', 'terms'));
    }

    public function store(Request $request)
    {

        $data = new Session();
        $data->year_session = $request->session;
        $data->starting_date = $request->starting_date;
        $data->ending_date = $request->ending_date;
        $data->active_status = 0;
        $final = $data->save();

        if ($final) {
            $notification = array(
                    'message' => 'Operation Successful'
                );
            return redirect()->route('admin.session.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Operation Failed'
                );
            return redirect()->back()->with($notification);
        }

    }
    
    public function editSession(Request $request, $id)
    {

        $data = Session::find($id);
        $data->year_session = $request->session;
        $data->starting_date = $request->starting_date;
        $data->ending_date = $request->ending_date;
        if ($data->active_status == 1) {
            $data->active_status = 1;
        } else {
            $data->active_status = 0;
        }
        
        $final = $data->update();

        if ($final) {
            $notification = array(
                    'message' => 'Operation Successful'
                );
            return redirect()->route('admin.session.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Operation Failed'
                );
            return redirect()->back()->with($notification);
        }

    }

    public function update(Request $request)
    {   
        //Update the current session's active status to 0(false)
        $currentSession = Session::where('active_status', 1)->get();
        $data = Session::find($currentSession[0]->id);
        $data->active_status = 0;
        $update = $data->update();

        //Update the selected session's active status to 1(true)
        $id = $request->session;
        $data = Session::find($id);
        // dd($data);
        $data->active_status = 1;
        $final = $data->update();

        if ($final) {
            $notification = array(
                    'message' => 'Operation Successful'
                );
            return redirect()->route('admin.session.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Operation Failed'
                );
            return redirect()->back()->with($notification);
        }

    }

    public function storeTerm(Request $request)
    {   
        $data = new Term();
        $data->name = $request->name;
        $data->active_status = 0;
        $final = $data->save();

        if ($final) {
            $notification = array(
                    'message' => 'Operation Successful'
                );
            return redirect()->route('admin.session.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Operation Failed'
                );
            return redirect()->back()->with($notification);
        }
    }

    public function editTerm(Request $request, $id)
    {   
        $data = Term::find($id);
        $data->name = $request->name;
        if ($data->active_status == 1) {
            $data->active_status = 1;
        } else {
            $data->active_status = 0;
        }
        
        $final = $data->save();

        if ($final) {
            $notification = array(
                    'message' => 'Operation Successful'
                );
            return redirect()->route('admin.session.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Operation Failed'
                );
            return redirect()->back()->with($notification);
        }
    }

    public function updateTerm(Request $request)
    {   
        //Update the current term's active status to 0(false)
        $currentSession = Term::where('active_status', 1)->get();
        $data = Term::find($currentSession[0]->id);
        $data->active_status = 0;
        $update = $data->update();

        //Update the selected term's active status to 1(true)
        $id = $request->term;
        $data = Term::find($id);
        // dd($data);
        $data->active_status = 1;
        $final = $data->update();

        if ($final) {
            $notification = array(
                    'message' => 'Operation Successful'
                );
            return redirect()->route('admin.session.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Operation Failed'
                );
            return redirect()->back()->with($notification);
        }

    }

    public function deleteSession($id)
    {
        $a = Session::find($id);
        $a->delete();
        $notification = array(
                    'message' => 'Operation Successful'
                );
        return redirect()->route('admin.session.index')->with($notification);
    }

    public function deleteTerm($id)
    {
        $a = Term::find($id);
        $a->delete();
        $notification = array(
                    'message' => 'Operation Successful'
                );
        return redirect()->route('admin.session.index')->with($notification);
    }
}
