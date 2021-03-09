@extends('layouts.admin')
@section('content')
<section class="content">
<div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
            <h3>Request New Transfer</h3>
            </div>
        </div>

    
        <form class="new-added-form" method="POST" action="{{ route("admin.transfer.request.store") }}" enctype="multipart/form-data">
            @csrf
        <div class="row">   
            <div class="col-12">
                <hr>
                <h4>Select Former School</h4>
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
                <h4>Select Student</h4><br>
                <div class="form-group">
                  <select class="form-control select2" name="student_id" id="student_id">
                    <option disabled selected value="">Please Select</option>
                  </select>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <button class="btn btn-primary" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </div>
        </form>
    </div>
</div>
</section>
@endsection
@section('scripts')
<script src="{{ asset('js/filter2.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('select[name="classs"]').on('change', function(){
            var classs = $(this).val();

             if (classs){
                $.ajax({
                    url: '/admin/lga/fetchStudent/'+classs,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                         $('select[name="student_id"]').empty();
                            $('select[name="student_id"]').prepend(
                            '<option value="">'+ "Please Select" +'</option>'
                            );
                         $.each(data, function(key, value){
                            $('select[name="student_id"]').append(
                                '<option value="'+value.id+'">'+ value.child_name + ' ' + value.middle_name + ' ' + value.last_name +'</option>'
                                );
                         });
                    }
                });
             } else {
                $('select[name="student_id"]').empty();
             }
        });
    });
</script>
@endsection
