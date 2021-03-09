<?php

namespace App\Http\Controllers\Admin\Staff;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Staff\MailSMSTemplate;
use DataTables;
use Redirect;
use Response;

class MailSMSTemplateController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $mailsmstemplates = MailSMSTemplate::latest()->get();
        //dd($mailsmstemplates);
        if ($request->ajax()) {
            return Datatables::of($mailsmstemplates)
                ->addIndexColumn()
                ->addColumn('message', function ($row){
                    return'<html>'.$row->message.'</html>';
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editMailSMSTemplate"><i class="fa fa-pencil-alt"></i>&nbsp;Edit</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteMailSMSTemplate"><i class="fa fa-trash-alt"></i>&nbsp;Delete</a>';
                    return $btn;
                })

                ->rawColumns(['action', 'message'])
                ->make(true);
        }

        return view('admin.pages.managemailsmstemplates', compact('mailsmstemplates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $r=$request->validate([
            'title' => 'required',
            'message' => 'required',
            'message_type'  =>'required',
        ]);

        $mailsmstemplateId = $request->mailsmstemplate_id;
        MailSMSTemplate::updateOrCreate(['id' => $mailsmstemplateId],['title' => $request->title, 'message' => $request->message, 'type' => $request->message_type]);
        if(empty($request->mailsmstemplate_id))
            $msg['message']  = 'Mail/SMS Template created successfully.';
        else
            $msg['message']  = 'Mail/SMS Template data is updated successfully';
        return Response::json($msg);
        return redirect()->route('mailsmstemplates.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $mailsmstemplate = MailSMSTemplate::where($where)->first();
        return Response::json($mailsmstemplate);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mailsmstemplate = MailSMSTemplate::where('id',$id)->delete();
        return Response::json($mailsmstemplate);
    }
}