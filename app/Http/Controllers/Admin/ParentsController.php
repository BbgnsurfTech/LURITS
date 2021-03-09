<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Parents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Redirect;
use Response;
use File;
use App\DsEconomicStatus;
use Carbon\Carbon;
use App\Atlas;


class ParentsController extends Controller
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
        $parents = Parents::where('school_id', Auth::User()->school_id)->with(["incomeStatus", "gender"])->get();
        $status = DsEconomicStatus::all();

        //dd($parents);
        if ($request->ajax()) {
            return Datatables::of($parents)
                ->addIndexColumn()
                ->addColumn('photo', function ($row){
                    $logo = '<img src="storage/images/parents/'.$row->photo.'" class="img-thumbnail" width="50" height="35" />';
                     return $logo;
                })
                ->addColumn('name', function($row){
                    return Parents::find($row->id)->first_name." ".Parents::find($row->id)->middle_name." ".Parents::find($row->id)->last_name;
                })
                ->addColumn('status', function($row){
                    if (Parents::find($row->id)->activated==1)
                    return '<span class="badge badge-success">Active</span>';
                    else
                    return '<span class="badge badge-danger">Inactive</span>';
                })
                ->addColumn('action', function($row){
                                                           
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="View" class="edit btn btn-success btn-sm viewParent"><i class="fa fa-eye"></i>&nbsp;View&nbsp;</a>';
                    
                    
                    if (Auth::User()->is_headTeacher) {
                        $btn = $btn." ".'<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editParent"><i class="fa fa-pencil-alt"></i>&nbsp;Edit</a>';
                        $btn = $btn.'<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteParent"><i class="fa fa-trash-alt"></i>&nbsp;Delete</a>';
                    }
                    return $btn;
                })

                ->rawColumns(['action', 'name', 'status', 'photo'])
                ->make(true);
        }
        //dd($parents);
        return view('admin.pages.manageparents', compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'profession' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        if ($files = $request->file('photo')) {

            //delete old file
            File::delete('uploads/parents/'.$request->hidden_image);

            //insert new file
            $destinationPath = 'storage/images/parents/'; // upload path
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
         }
         //Carbon::parse($request->dateofbirth)->format('YYYY-mm-dd')
        $profileImage=isset($profileImage)?$profileImage:$request->hidden_image;
        $parent_id = $request->parent_id;
        // Parents::updateOrCreate(['id' => $parent_id],['first_name' => $request->firstName, 'middle_name' => $request->middleName, 'last_name' => $request->lastName, 'email' => $request->email, 'gender_id' => $request->gender, 'date_of_birth' => $request->dateofbirth, 'phone_number' => $request->phoneNumber, 'address' => $request->address, 'profession' => $request->profession, 'school_id' => Auth::User()->school_id, 'income' => $request->income,
        // 'photo' => $profileImage]);

        $data_id = Parents::where('school_id', $school)->max('id') + 1;
        // dd($data_id);
        if ($data_id == 1) {
            $model_id = str_pad($school, 15, "0", STR_PAD_RIGHT).$data_id;
        } else {
            $model_id = $data_id;
        }

        if(empty($request->parent_id)){
            $parent = new Parents();
            $parent->id = $model_id;
            $parent->first_name = $request->firstName;
            $parent->middle_name = $request->middleName;
            $parent->last_name = $request->lastName;
            $parent->email = $request->email;
            $parent->income = $request->income;
            $parent->gender_id = $request->gender;
            if(!empty($request->dateofbirth)){
                $parent->date_of_birth = Carbon::createFromFormat('d/m/Y', $request->dateofbirth);
            }
            $parent->phone_number = $request->phoneNumber;
            $parent->address = $request->address;
            $parent->profession = $request->profession;
            $parent->photo = $profileImage;
            $parent->school_id = Auth::User()->school_id;
            $parent->save();
        }else{
            $parent = Parents::find($parent_id);
            $parent->first_name = $request->firstName;
            $parent->middle_name = $request->middleName;
            $parent->last_name = $request->lastName;
            $parent->email = $request->email;
            $parent->income = $request->income;
            $parent->gender_id = $request->gender;
            if(!empty($request->dateofbirth)){
                $parent->date_of_birth = Carbon::createFromFormat('d/m/Y', $request->dateofbirth);
            }
            $parent->phone_number = $request->phoneNumber;
            $parent->address = $request->address;
            $parent->profession = $request->profession;
            $parent->photo = $profileImage;
            $parent->school_id = Auth::User()->school_id;
            $parent->update();
        }


        if(empty($request->parent_id))
            $msg['message'] = 'Parent created successfully.';
        else
            $msg['message'] = 'Parent data is updated successfully';

        return Response::json($msg);
        return redirect()->route('sections.index');
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
        $parent = Parents::where($where)->first();
        return Response::json($parent);
    }

    public function show($id)
    {
        $where = array('id' => $id);
        $parent = Parents::where($where)->with(["incomeStatus", "gender"])->first();
        return Response::json($parent);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $parent = Parents::where('id',$id)->delete();
        return Response::json($parent);
    }
}
