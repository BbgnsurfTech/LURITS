<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Incidence;
use Gate;
use Illuminate\Http\Request;
use DB;
use Auth;
use Symfony\Component\HttpFoundation\Response;

class IncidenceApiController extends Controller
{
    public function index()
    {

        $data = Incidence::where('school_id', Auth::User()->school_id)->get();
        return response($data);
    }

    public function store(Request $request)
    {
        $term_id = Term::where('active_status', 1)->pluck('id')->first();
        $session_id = Session::where('active_status', 1)->pluck('id')->first();
        
        if (Auth::User()->is_headTeacher) {
            $school = Auth::User()->school_id;
        } else {
            $school = $request->school;
        }
        
        $allData = $request->all();

        DB::beginTransaction();
        try {
        
            foreach ($allData as $modelData) {
                $data_id = Incidence::where('school_id', $school)->max('id') + 1;

                if ($data_id == 1) {
                    $model_id = str_pad($school, 15, "0", STR_PAD_RIGHT).$data_id;
                } else {
                    $model_id = $data_id;
                }

                if ($modelData['id'] == '' || $modelData['id'] == null) {
                    $data = new Incidence();
                } else {
                    $data = Incidence::find($modelData['id']);
                }

                $data->id = $model_id;
                $incidence->title = $request->title;
                $incidence->rate = $request->rate;
                $incidence->description = $request->incidence_body;
                $incidence->school_id = $school_id;
                // $incidence->photo = $input['imagename'];
                // $data->term_id = $term_id;
                // $data->session_id = $session_id;
                $data->school_id = $school;

                if ($modelData['id'] == '' || $modelData['id'] == null) {
                    $final = $data->save();
                } else {
                    $final = $data->update();
                }
                

                // if ($request->input('photos', false)) {
                //     $asset->addMedia(storage_path('tmp/uploads/' . $request->input('photos')))->toMediaCollection('photos');
                // }
            }

            DB::commit();

        } catch (Exception $e) {
            DB::rollback();
            return response($e);
        }

        if ($final) {
            $message = Incidence::where('school_id', $school_id)->get();
            return response($message);
        }
    }

    public function destroy(Incidence $incidence)
    {

        $final = $incidence->delete();

        if ($final) {
            return response([
                'success' => true,
                'message' => "Data Deleted Successfully",
            ], 200);
        } else {
            return response([
                'success' => false,
                'message' => "Operation Failed, Server Error!",
            ], 200);
        }
    }
}
