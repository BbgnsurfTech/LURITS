@extends('layouts.admin')
@section('content')
<section class="content">
    <div class="card height-auto">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.transfers.title_singular') }}
        </div>
        <div class="card-body">
             <form class="new-added-form" method="POST" action="{{ route("admin.transfer.update", [$transfer->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                @include('partials.filter.class')
                <div class="row">
                  <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <div class="form-group">
                      <label class="control-label">Student</label>
                        <select name="student_id" class="form-control input-lg dynamic" required>
                          <option value="{{ $transfer->student_id }}">{{ $transfer->student->child_name }} {{ $transfer->student->middle_name }} {{ $transfer->student->last_name }}</option>
                        </select>
                    </div>
                  </div>
                </div>
                <hr>
                @if(Auth::User()->is_headTeacher)
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label for="child_name">Student</label>
                    <select class="form-control select2 {{ $errors->has('child_name') ? 'is-invalid' : '' }}" name="child_name" id="child_name">
                        <option disabled selected value="">{{ trans('global.pleaseSelect') }}</option>
                        @foreach($studentAdmission as $child)
                            <option value="{{ $child->id }}" {{ old('child_name') == $child->id ? 'selected' : '' }}>{{ $child->child_name }} {{ $child->middle_name }} {{ $child->last_name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.transfers.fields.child_name_helper') }}</span>
                </div>
                @endif
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label for="pupils_conduct">{{ 'Pupils Conduct' }}</label>
                        <input class="form-control {{ $errors->has('pupils_conduct') ? 'is-invalid' : '' }}" type="text" name="pupils_conduct" id="pupils_conduct" value="{{ old('pupils_conduct', $transfer->pupils_conduct) }}">
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                        
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label for="reason_for_leaving">{{ 'Reason For Leaving' }}</label>
                        <input class="form-control {{ $errors->has('reason_for_leaving') ? 'is-invalid' : '' }}" type="text" name="reason_for_leaving" id="reason_for_leaving" value="{{ old('reason_for_leaving', $transfer->reason_for_leaving) }}">
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                        
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                       <label>Last Date of Attendance {{ $transfer->last_attendance_date }}</label>
                        <input name="last_attendance_date" id="last_attendance_date" value="{{ old('last_attendance_date', $transfer->last_attendance_date) }}" type="text" placeholder="yyyy/mm/dd" data-date-format="yyyy/mm/dd" class="form-control air-datepicker" data-position='bottom right'>
                        <i class="far fa-calendar-alt"></i>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label for="last_class_attended">{{ trans('cruds.transfers.fields.lcp') }}</label>
                        <input class="form-control {{ $errors->has('last_class_attended') ? 'is-invalid' : '' }}" type="text" name="last_class_attended" id="last_class_attended" value="{{ old('last_class_attended', $transfer->last_class_attended) }}">
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif             
                    </div>            
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label for="headteacher_name">{{ 'Head Teacher Name' }}</label>
                        <input class="form-control {{ $errors->has('headteacher_name') ? 'is-invalid' : '' }}" type="text" name="headteacher_name" id="headteacher_name" value="{{ old('headteacher_name', $transfer->headteacher_name) }}">
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                        
                    </div>            
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label for="headteacher_phone">{{ 'Head Teacher Phone' }}</label>
                        <input class="form-control {{ $errors->has('headteacher_phone') ? 'is-invalid' : '' }}" type="text" name="headteacher_phone" id="headteacher_phone" value="{{ old('headteacher_phone', $transfer->headteacher_phone) }}">
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                        
                    </div>
                </div>
                <div class="col-12">
                    <hr>
                    <h4>Select Target School</h4>
                    @if(Auth::User()->is_superAdmin || Auth::User()->is_admin)
                    <div class="row">
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label class="required">Country</label>
                            <select name="country" class="form-control input-lg dynamic" id="country" data-dependent="state">
                                <option value="" selected disabled>Select Country</option>
                                @foreach($country_list as $country)
                                <option value="{{ $country->code_atlas_entity }}">{{ $country->name_atlas_entity }}</option>
                                @endforeach
                            </select>
                            @if($errors->has(''))
                                <span class="text-danger">{{ $errors->first('') }}</span>
                            @endif
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label class="control-label">State</label>
                            <select name="state" class="form-control input-lg dynamic" id="state" data-dependent="lga">
                                <option value="" selected disabled>Select State</option>
                            </select>
                            @if($errors->has(''))
                                <span class="text-danger">{{ $errors->first('') }}</span>
                            @endif
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label class="control-label">LGA</label>
                            <select name="lga" class="form-control input-lg dynamic" id="lga" data-dependent="school_sector">
                                <option disabled selected value="">Select LGA</option>
                            </select>
                            @if($errors->has(''))
                                <span class="text-danger">{{ $errors->first('') }}</span>
                            @endif
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label class="control-label">School Sector</label>
                            <select name="school_sector" class="form-control input-lg dynamic" id="school_sector" data-dependent="school">
                                <option disabled selected value="">Select Sector</option>
                            </select>
                            @if($errors->has(''))
                                <span class="text-danger">{{ $errors->first('') }}</span>
                            @endif
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label class="required">School*</label>
                            <select name="school" class="form-control input-lg dynamic" id="school" data-dependent="parent_guardian_id" required>
                                <option value="{{ $transfer->school }}">{{ $transfer->school }}</option>
                            </select>
                            @if($errors->has(''))
                                <span class="text-danger">{{ $errors->first('') }}</span>
                            @endif
                        </div>
                    </div>
                    @endif
                    @if(Auth::User()->is_zeqa)
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="control-label">LGA</label>
                                <select name="lga" class="form-control input-lg dynamic" id="lga" data-dependent="school">
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
                                <select name="school" class="form-control input-lg dynamic" id="school" data-dependent="classs">
                                    <option value="">Select School</option>
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
                                <select name="school" class="form-control input-lg dynamic" id="school" data-dependent="classs">
                                    <option value="">Select School</option>
                                    @foreach($lgea as $lga)
                                    <option value="{{ $lga->id }}">{{ $lga->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @endif


                    <div class="row">

                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <div class="form-group">
                                <label class="control-label">LGA</label>
                                <select name="lgaa" class="form-control input-lg dynamic" id="lgaa" data-dependent="schooll">
                                    <option value="">Select LGA</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <div class="form-group">
                                <label class="control-label">School</label>
                                <select name="schooll" class="form-control input-lg dynamic" id="schooll" required>
                                    <option value="{{ $transfer->new_school }}">Select School</option>
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
<script>
    $(document).ready(function(){
        $('select[name="zonee"]').on('change', function(){
             var zone = $(this).val();
             
             if (zone){
                $.ajax({
                    url: '/admin/lga/fetchLgas/'+zone,
                    type: 'GET',
                    dataType: 'json',
                    beforeSend: function () {
                    $("body").addClass("loading"); 
                    },
                    success: function(data){
                    $("body").removeClass("loading"); 
                         $('select[name="lgaa"]').empty();
                         $.each(data, function(key, value){
                            $('select[name="lgaa"]').append(
                                '<option value="'+key+'">'+ value +'</option>'
                                );
                         });
                    }
                });
             } else {
                $('select[name="lgaa"]').empty();
             }
        });
    });

    $(document).ready(function(){
        $('select[name="lgaa"]').on('change', function(){
             var lga = $(this).val();

             if (lga){
                $.ajax({
                    url: '/admin/lga/fetchSchools/'+lga,
                    type: 'GET',
                    dataType: 'json',
                    beforeSend: function () {
                    $("body").addClass("loading"); 
                    },
                    success: function(data){
                    $("body").removeClass("loading"); 
                         $('select[name="schooll"]').empty();
                         $.each(data, function(key, value){
                            $('select[name="schooll"]').append(
                                '<option value="'+key+'">'+ value +'</option>'
                                );
                         });
                    }
                });
             } else {
                $('select[name="schooll"]').empty();
             }
        });
    });
</script>
@endsection