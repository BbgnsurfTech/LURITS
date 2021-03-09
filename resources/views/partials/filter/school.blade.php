{{ csrf_field() }}
@if(Auth::User()->is_superAdmin || Auth::User()->is_admin)
<div class="row">
    <div class="col-sm-2">
        <div class="form-group">
            <label class="control-label">Country</label>
            <select name="country" class="form-control input-lg dynamic" id="country" data-dependent="state">
                <option value="" selected >Select Country</option>
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