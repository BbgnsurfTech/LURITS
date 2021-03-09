<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Textbook;
use App\DsClassSector;
use App\DsSubjectSector;
use Auth;
use App\DsUserTextbook;
use App\School;

class TextbookController extends Controller
{
    public function index(Request $request)
    {
    	if (!Auth::User()->is_headTeacher) {
    		$data = $request->all();
    		
    		if (empty($data)) {
    			return view('admin.textbook.adminPage');
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
			    	$subjects = DsSubjectSector::where('sector_id', $school->code_type_sector)->with(['subjectName'])->get();
			    	$data = Textbook::where('school_id', $school_id)->get();
			    	// dd($data);
			    	$user_textbook = DsUserTextbook::all();

			    	return view('admin.textbook.index', compact('classes', 'data', 'subjects', 'user_textbook', 'school_id'));
    			}
    		}
            
        } else {
            $classes = DsClassSector::where('sector_id', Auth::User()->school->code_type_sector)->with(['dsClass'])->get();
	    	$subjects = DsSubjectSector::where('sector_id', Auth::User()->school->code_type_sector)->with(['subjectName'])->get();
	    	$data = Textbook::where('school_id', Auth::User()->school_id)->get();
	    	// dd($data);
	    	$user_textbook = DsUserTextbook::all();

	    	return view('admin.textbook.index', compact('classes', 'data', 'subjects', 'user_textbook'));
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
    	// dd($data['id'][0]);
    	if ($data['id'][0] != null) {
    		$condition = true; 
    	} else {
    		$condition = false;
    	}
    	// dd($condition);
    	// dd($data['ids']);
    	foreach ($data['ids'] as $subjectData) {
    		// dd($subjectData);
    		// foreach ($data['class_id'] as $value) {

    			// $a = $subjectData.'-'.$value;
    			$b = $data[$subjectData];
    			// dd($b);
    			$c = str_split($subjectData);
    			// dd($c);
    			$data_id = Textbook::where('school_id', $school_id)->max('id') + 1;
	            // dd($data_id);
	            if ($data_id == 1) {
	                $model_id = str_pad($school_id, 15, "0", STR_PAD_RIGHT).$data_id;
	            } else {
	                $model_id = $data_id;
	            }

    			if ($condition) {
    				// dd($data);
    				// foreach ($data['id'] as $dataID) {
    					$textbook = Textbook::where('school_id', $school_id)
    					->where('ds_subjects_id', $c[2])
    					->where('ds_class_id', $c[4])
    					->where('ds_user_textbook_id', $c[0])
    					->first();
		    			$textbook->number_textbooks = $b;
		    			// dd($textbook);
		    			$result = $textbook->update();
    				// }
    			} else {
    				$textbook = new Textbook();
    				$textbook->id = $model_id;
	    			$textbook->ds_user_textbook_id = $c[0];
	    			$textbook->ds_subjects_id = $c[2];
	    			$textbook->ds_class_id = $c[4];
	    			$textbook->number_textbooks = $b;
	    			$textbook->school_id = $school_id;
	    			$result = $textbook->save();
    			}
    	}

    	if ($result) {
            session()->flash('message', $condition ? 'Textbook Data Updated Successfully' : 'Textbook Data Inserted Successfully');
            if (!Auth::User()->is_headTeacher) {
	            return redirect()->route('admin.textbooks.index');
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
