<?php

namespace App\Http\Controllers\Admin\Staff;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Staff\MailSMS;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Redirect;
use Response;

class MailSMSController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth:staff');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dd(Auth::user()->id);
        //$users = User::find(Auth::user()->id);

        $mailsms = MailSMS::latest()->get();
        //dd($mailsms);
        if ($request->ajax()) {
            return Datatables::of($mailsms)
                ->addIndexColumn()
                ->addColumn('sender', function($row){
                    return MailSMS::find($row->id)->sender ? MailSMS::find($row->id)->sender->first_name:"";
                }) 
                ->addColumn('receiver', function ($row){
                    return MailSMS::find($row->id)->receiver ? MailSMS::find($row->id)->receiver->first_name:"";
                })
                ->addColumn('message', function ($row){
                    return'<html>'.$row->message.'</html>';
                })
                ->rawColumns(['sender', 'receiver', 'message'])
                ->make(true);
        }
        return view('admin.pages.managemailsms', compact('mailsms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $r=$request->validate([
            'staff_to' => 'required',
            'subject' => 'required',
            'message_type' => 'required',
            'message_body' => 'required',
        ]);

        $mailsmsId = $request->mailsms_id;
        MailSMS::updateOrCreate(['id' => $mailsmsId],['subject' => $request->subject, 'message' => $request->message_body,  'message_type' => $request->message_type, 'sender_id' => Auth::user()->id, 'receiver_id' => $request->staff_to]);

        if(empty($request->mailsms_id))
            $msg['message']  = 'Mail/SMS successfully sent.';
        
        return Response::json($msg);
        return redirect()->route('mailsms.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}