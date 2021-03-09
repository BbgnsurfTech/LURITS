@extends('layouts.admin')
@section('content')
<div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
            <h3>{{ trans('global.add') }} {{'New'}} {{ trans('cruds.transfers.title_singular') }}</h3>
            </div>
        </div>

    
        <form class="new-added-form" method="POST" action="{{ route("admin.transfer.store") }}" enctype="multipart/form-data">
            @csrf
            @include('partials.filter.class')
            <div class="row">
              <div class="col-xl-3 col-lg-6 col-12 form-group">
                <div class="form-group">
                  <label class="control-label">Student</label>
                    <select name="student_id" class="form-control input-lg dynamic select2" required>
                      <option value="" disabled selected>Select Student</option>
                    </select>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label for="pupils_conduct">{{ trans('cruds.transfers.fields.pupils_conduct') }}</label>
                    <input class="form-control {{ $errors->has('pupils_conduct') ? 'is-invalid' : '' }}" type="text" name="pupils_conduct" id="pupils_conduct" value="{{ old('pupils_conduct', '') }}">
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif                
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label for="reason_for_leaving">{{ trans('cruds.transfers.fields.reason_for_leaving') }}</label>
                    <input class="form-control {{ $errors->has('reason_for_leaving') ? 'is-invalid' : '' }}" type="text" name="reason_for_leaving" id="reason_for_leaving" value="{{ old('reason_for_leaving', '') }}">
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif                
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                   <label>Last Date of Attendance</label>
                    <input name="last_attendance_date" id="last_attendance_date" value="{{ old('last_attendance_date', '') }}" type="text" placeholder="yyyy/mm/dd" data-date-format="yyyy/mm/dd" class="form-control air-datepicker" data-position='bottom right' autocomplete="off">
                    <i class="far fa-calendar-alt"></i>
                </div>
                @if(Auth::User()->is_headTeacher)
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label for="last_class_attended">{{ trans('cruds.transfers.fields.lcp') }}</label>
                    <select name="last_class_attended" class="form-control input-lg dynamic" id="last_class_attended">
                        <option value="" selected disabled>Select Class</option>
                        <option value="0">None</option>
                        @foreach($sector_classes as $last_class)
                            <option value="{{ $last_class->dsClass[0]->id }}">{{ $last_class->dsClass[0]->title }}</option>
                        @endforeach
                    </select>
                </div>
                @else
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label for="last_class_attended">{{ trans('cruds.transfers.fields.lcp') }}</label>
                    <select name="last_class_attended" class="form-control input-lg dynamic" id="last_class_attended">
                        <option value="" selected disabled>Select Class</option>
                    </select>
                </div>
                @endif
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required" for="headteacher_name">{{ trans('cruds.transfers.fields.ht_name') }}*</label>
                    <input class="form-control {{ $errors->has('headteacher_name') ? 'is-invalid' : '' }}" type="text" name="headteacher_name" id="headteacher_name" value="{{ old('headteacher_name', '') }}" required>
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif                
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required" for="headteacher_phone">{{ trans('cruds.transfers.fields.ht_phone') }}*</label>
                    <input class="form-control {{ $errors->has('headteacher_phone') ? 'is-invalid' : '' }}" type="text" name="headteacher_phone" id="headteacher_phone" value="{{ old('headteacher_phone', '') }}" maxlength="11" required>
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif                
                </div>
            </div>
            <div class="col-12">
                <hr>
                <h4>Select Target School</h4>
                <div class="row">
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="control-label">Country</label>
                            <select name="destination_country" class="form-control input-lg dynamic" id="destination_country" data-dependent="destination_state">
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
                            <select name="destination_state" class="form-control input-lg dynamic" id="destination_state" data-dependent="destination_lga">
                                <option value="" selected disabled>Select State</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="control-label">LGA</label>
                            <select name="destination_lga" class="form-control input-lg dynamic" id="destination_lga" data-dependent="destination_school_sector">
                                <option disabled selected value="">Select LGA</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="control-label">School Sector</label>
                            <select name="destination_school_sector" class="form-control input-lg dynamic" id="destination_school_sector" data-dependent="destination_school">
                                <option disabled selected value="">Select Sector</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="control-label">School</label>
                            <select name="destination_school" class="form-control input-lg dynamic select2" id="destination_school">
                                <option disabled selected value="">Select School</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <button class="btn btn-primary" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('js/filter2.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('select[name="school"]').on('change', function(){
            var school = $(this).val();

             if (school){
                $.ajax({
                    url: '/admin/lga/fetchSectorClasses/'+school,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                        // console.log(data);
                         $('select[name="last_class_attended"]').empty();
                            $('select[name="last_class_attended"]').prepend(
                            '<option value="" disabled selected>'+ "Please Select" +'</option>'
                            );
                            $('select[name="last_class_attended"]').prepend(
                            '<option value="0">'+ "None" +'</option>'
                            );
                         $.each(data, function(key, value){
                            $('select[name="last_class_attended"]').append(
                                '<option value="' + value.ds_class[0].id + '">'+ value.ds_class[0].title +'</option>'
                                );
                         });
                    }
                });
             } else {
                $('select[name="student_id"]').empty();
             }
        });
    });

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
                            '<option value="" disabled selected>'+ "Please Select" +'</option>'
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
<script>
    $(document).ready(function(){
    $('select[name="destination_country"]').on('change', function(){
         var destination_country = $(this).val();

         if (destination_country){
            $.ajax({
                url: '/admin/lga/fetchStates/'+destination_country,
                type: 'GET',
                dataType: 'json',
                beforeSend: function () {
                    $('.spinner').show();
                },
                success: function(data){
                    $('.spinner').hide();
                     $('select[name="destination_state"]').empty();
                     $('select[name="destination_state"]').prepend(
                            '<option disabled selected value="">'+ "Please Select" +'</option>'
                            );
                     $.each(data, function(key, value){
                        $('select[name="destination_state"]').append(
                            '<option value="'+key+'">'+ value +'</option>'
                            );
                     });
                }
            });
         } else {
            $('select[name="destination_state"]').empty();
         }
    });
});

$(document).ready(function(){
    $('select[name="destination_state"]').on('change', function(){
         var destination_state = $(this).val();
         
         if (destination_state){
            $.ajax({
                url: '/admin/lga/fetchLgas/'+destination_state,
                type: 'GET',
                dataType: 'json',
                beforeSend: function () {
                    $('.spinner').show();
                },
                success: function(data){
                    $('.spinner').hide();
                     $('select[name="destination_lga"]').empty();
                     $('select[name="destination_lga"]').prepend(
                            '<option disabled selected value="">'+ "Please Select" +'</option>'
                            );
                     $.each(data, function(key, value){
                        $('select[name="destination_lga"]').append(
                            '<option value="'+key+'">'+key+'-'+ value +'</option>'
                            );
                     });
                }
            });
         } else {
            $('select[name="destination_lga"]').empty();
         }
    });
});

$(document).ready(function(){
    $('select[name="destination_lga"]').on('change', function(){
         var destination_lga = $(this).val();

         if (destination_lga){
            $.ajax({
                url: '/admin/lga/fetchSectors/',
                type: 'GET',
                dataType: 'json',
                beforeSend: function () {
                    $('.spinner').show();
                },
                success: function(data){
                    $('.spinner').hide();
                     $('select[name="destination_school_sector"]').empty();
                     $('select[name="destination_school_sector"]').prepend(
                            '<option disabled selected value="">'+ "Please Select" +'</option>'
                            );
                     $.each(data, function(key, value){
                        $('select[name="destination_school_sector"]').append(
                            '<option value="'+value.id+'">'+ value.title +'</option>'
                            );
                     });
                }
            });
         } else {
            $('select[name="destination_school_sector"]').empty();
         }
    });
});

    $(document).ready(function(){
        $('select[name="destination_school_sector"]').on('change', function(){
             var sector = $(this).val();
             var lga = $('select[name="destination_lga"]').val();
             if (sector){
                $.ajax({
                    url: '/admin/lga/fetchSchools',
                    data: { lga: lga, sector: sector },
                    type: 'GET',
                    dataType: 'json',
                    beforeSend: function () {
                        $('.spinner').show();
                    },
                    success: function(data){
                        $('.spinner').hide();
                         $('select[name="destination_school"]').empty();
                         $.each(data, function(key, value){
                            $('select[name="destination_school"]').append(
                                '<option value="'+key+'">'+ value +'</option>'
                                );
                         });
                    }
                });
             } else {
                $('select[name="destination_school"]').empty();
             }
        });
    });
</script>
@endsection
