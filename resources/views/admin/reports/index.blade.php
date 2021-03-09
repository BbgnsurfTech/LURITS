@extends('layouts.admin')
@section('content')

	<div class="card height-02">
		<div class="card-header"><h1>Reports</h1></div>
		<div class="card-body">
			<form method="POST" action="{{ route('admin.reports.generate') }}" target="blank">
				@csrf
				@if(Auth::User()->is_superAdmin || Auth::User()->is_admin)
	        <div class="row">
    <div class="col-sm-2">
        <div class="form-group">
            <label class="control-label">Country</label>
            <select name="country" class="form-control input-lg dynamic" id="country" data-dependent="state">
                <option value="" selected disabled>Select Country</option>
                @foreach($country_list as $country)
                <option value="{{ $country->code_atlas_entity }}">{{ $country->name_atlas_entity }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-sm-2">
        <div class="form-group">
            <label class="control-label">State</label>
            <select name="state" class="form-control input-lg dynamic" id="state" data-dependent="lga">
                <option value="" selected disabled>Select State</option>
            </select>
        </div>
    </div>

    <div class="col-sm-2">
        <div class="form-group">
            <label class="control-label">LGA</label>
            <select name="lga" class="form-control input-lg dynamic" id="lga" data-dependent="school_sector">
                <option disabled selected value="">Select LGA</option>
            </select>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 col-12">
        <div class="form-group">
            <label class="control-label">School Sector</label>
            <select name="school_sector" class="form-control input-lg dynamic" id="school_sector" data-dependent="school">
                <option disabled selected value="">Select Sector</option>
            </select>
        </div>
    </div>
    
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="form-group">
            <label class="control-label">School</label>
            <select name="school" class="form-control input-lg dynamic select2" id="school">
                <option disabled selected value="">Select School</option>
            </select>
        </div>
    </div>
</div>
@endif
@if(Auth::User()->is_zeqa)
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label class="required">LGA</label>
            <select name="lga" class="form-control input-lg dynamic" id="lga" required>
                <option disabled selected value="">Select LGA</option>
                @foreach($lga as $lga)
                    <option value="{{ $lga->code_atlas_entity }}">{{ $lga->name_atlas_entity }}</option>
                @endforeach
            </select>
            @if($errors->has(''))
                <span class="text-danger">{{ $errors->first('') }}</span>
            @endif
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label class="control-label">School Sector</label>
                <select name="school_sector" class="form-control input-lg dynamic" id="school_sector" data-dependent="school">
                    <option disabled selected value="">Select Sector</option>
                </select>
            </div>
        </div>
        
        <div class="col-sm-2">
            <div class="form-group">
                <label class="control-label">School</label>
                <select name="school" class="form-control input-lg dynamic select2" id="school">
                    <option disabled selected value="">Select School</option>
                </select>
            </div>
        </div>
    </div>
    <hr>
@endif
@if(Auth::User()->is_lgea)
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label class="required">School*</label>
            <select name="school" class="form-control input-lg dynamic" id="school" required>
                <option disabled selected value="">Select School</option>
                @foreach($lgea as $lga)
                    <option value="{{ $lga->id }}">{{ $lga->name }}</option>
                @endforeach
            </select>
            @if($errors->has(''))
                <span class="text-danger">{{ $errors->first('') }}</span>
            @endif
        </div>
    </div>
    <hr>
@endif

			    <div class=" col-sm-6 col-md-6 col-lg-6">
			        <div class="form-group">
			            <label class="control-label">Report</label>
			            <select name="report" class="form-control input-lg" id="school" required>
			                <option disabled selected value="">Select Report</option>
			                <option value="school1">Number of schools</option>
			                <option value="enrolment1">Enrolment by class</option>
			                <option value="enrolment2">Enrolment by age</option>
			                <option value="disabilities">Students with disabilities</option>
			                <option value="staff1">Staffs by Type of Staff</option>
			                <option value="staff2">Staffs by Academic Qualification</option>
			                <option value="staff3">Staffs by Teaching Qualification</option>
			                <option value="report_card">Report Card</option>
			                <option value="teacher_deployment_index">Teacher Deployment Consistency Index</option>
			            </select>
			        </div>
			    </div>
			</div>
	        <button class="btn btn-primary" type="submit">Generate Report</button>
			</form>
			
			<!-- <div id="accordion">
			 <div class="card">
			    <div class="card-header" id="headingOne">
			      <h5 class="mb-0">
			        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
			          School
			        </button>
			      </h5>
			    </div>

			    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
			      <div class="card-body">
			        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
			      </div>
			    </div>
			  </div>
			  <div class="card">
			    <div class="card-header" id="headingTwo">
			      <h5 class="mb-0">
			        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
			          Enrolment
			        </button>
			      </h5>
			    </div>
			    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
			      <div class="card-body">
			      	<ul>
			      		<li><a href="#">Enrollment by class</a></li>
			      		<li><a href="#">Enrollment by class and age</a></li>
			      	</ul>
			      </div>
			    </div>
			  </div>
			  <div class="card">
			    <div class="card-header" id="headingThree">
			      <h5 class="mb-0">
			        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
			          Staff
			        </button>
			      </h5>
			    </div>
			    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
			      <div class="card-body">
			        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
			      </div>
			    </div>
			  </div>
			  <div class="card">
			    <div class="card-header" id="headingThree">
			      <h5 class="mb-0">
			        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
			          Classroom
			        </button>
			      </h5>
			    </div>
			    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
			      <div class="card-body">
			        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
			      </div>
			    </div>
			  </div>
			</div> -->
		</div>
@endsection
@section('scripts')
<script src="{{ asset('js/filter2.js') }}"></script>
@endsection