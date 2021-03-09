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
            <select name="school" class="form-control input-lg dynamic select2" id="school" data-dependent="classs">
                <option disabled selected value="">Select School</option>
            </select>
        </div>
    </div>

    <div class="col-sm-2">
        <div class="form-group">
            <label class="control-label">Class</label>
            <select name="classs" class="form-control input-lg dynamic">
                <option disabled selected value="">Select Class</option>
            </select>
        </div>
    </div>
</div>
@endif
@if(Auth::User()->is_zeqa)
<div class="row">
    <div class="col-sm-2">
        <div class="form-group">
            <label class="control-label">LGA</label>
            <select name="lga" class="form-control input-lg dynamic" id="lga" data-dependent="school_sector">
                <option value="">Select LGA</option>
                @foreach($lga as $lga)
                <option value="{{ $lga->code_atlas_entity }}">{{ $lga->name_atlas_entity }}</option>
                @endforeach
            </select>
        </div>
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
            <select name="school" class="form-control input-lg dynamic" id="school">
                <option value="">Select School</option>
            </select>
        </div>
    </div>

    <div class="col-sm-2">
        <div class="form-group">
            <label class="control-label">Class</label>
            <select name="classs" class="form-control input-lg dynamic">
                <option disabled selected value="">Select Class</option>
            </select>
        </div>
    </div>
</div>
@endif
@if(Auth::User()->is_lgea)
<div class="row">
    <div class="col-sm-2">
        <div class="form-group">
            <label class="control-label">School</label>
            <select name="schooll" class="form-control input-lg dynamic" id="schooll">
                <option value="">Select School</option>
                @foreach($lgea as $lga)
                <option value="{{ $lga->id }}">{{ $lga->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-sm-2">
        <div class="form-group">
            <label class="control-label">Class</label>
            <select name="classs" class="form-control input-lg dynamic">
                <option disabled selected value="">Select Class</option>
            </select>
        </div>
    </div>
</div>
@endif
@if(Auth::User()->is_headTeacher)
    <div class="col-sm-2">
        <div class="form-group">
            <label class="control-label" for="classs">Class</label>
            <select class="form-control" name="classs" id="classs">
                <option value="" disabled selected>Please Select</option>
                @foreach($classroom as $class)
                <option value="{{ $class->id }}">{{ $class["classTitle"]->title }} - {{ $class["armTitle"]->title }}</option>
                @endforeach
            </select>
        </div>
    </div>
@endif
