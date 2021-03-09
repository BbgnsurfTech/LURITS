@extends('layouts.admin')
@section('content')
<section class="content">
<div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
            <h3>{{ trans('global.add') }} New Admission</h3>
            </div>
        </div>

    <form method="POST" id="student-form" action="{{ route("admin.student-admissions.store") }}" enctype="multipart/form-data">
         @csrf
        <div class="tab-content mt-4">
            @include('partials.filter.school')
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label for="parent_guardian_id">{{ trans('cruds.studentAdmission.fields.parent_guardian') }}</label>
                    <select class="form-control select2 {{ $errors->has('parent_guardian') ? 'is-invalid' : '' }}" name="parent_guardian_id" id="parent_guardian_id">
                        <option value="" selected disabled>Please Select</option>
                        @foreach($parent_guardians->where('school_id', Auth::User()->school_id) as $parent_guardian)
                        <option value="{{ $parent_guardian->id }}" {{ old('parent_guardian_id') == $parent_guardian->id ? 'selected' : '' }}>{{ $parent_guardian->first_name }} {{ $parent_guardian->middle_name }} {{ $parent_guardian->last_name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.studentAdmission.fields.parent_guardian_helper') }}</span>
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label for="parental_status">Parental Status</label>
                    <select class="form-control select2 {{ $errors->has('parental_status') ? 'is-invalid' : '' }}" name="parental_status" id="parental_status">
                        <option value="" selected disabled>Please Select</option>
                        @foreach($parental_statuses as $parental_status)
                        <option value="{{ $parental_status->id }}" {{ old('parental_status') == $parental_status->id ? 'selected' : '' }}>{{ $parental_status->title }}</option>
                        @endforeach
                    </select>
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.studentAdmission.fields.parent_guardian_helper') }}</span>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required" for="child_name">{{ trans('cruds.studentAdmission.fields.child_name') }}*</label>
                        <input class="form-control {{ $errors->has('child_name') ? 'is-invalid' : '' }}" type="text" name="child_name" id="child_name" value="{{ old('child_name', '') }}" required>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label for="middle_name">{{ trans('cruds.studentAdmission.fields.middle_name') }}</label>
                        <input class="form-control {{ $errors->has('middle_name') ? 'is-invalid' : '' }}" type="text" name="middle_name" id="middle_name" value="{{ old('middle_name', '') }}">
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required" for="last_name">{{ trans('cruds.studentAdmission.fields.last_name') }}*</label>
                        <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', '') }}" required>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required">{{ trans('cruds.studentAdmission.fields.gender') }}*</label>
                        <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender" required>
                            <option disabled selected value="">{{ trans('global.pleaseSelect') }}</option>
                            @foreach($genders as $gender)
                                <option value="{{ $gender->id }}" {{ old('gender', '255') === (string) $gender->id ? 'selected' : '' }}>{{ $gender->title }}</option>
                            @endforeach
                        </select>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                       <label class="required">Date of Birth*</label>
                        <input name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', '') }}" type="text" placeholder="yyyy/mm/dd" data-date-format="yyyy/mm/dd" class="form-control air-datepicker" data-position='bottom right' autocomplete="off" required>
                        <i class="far fa-calendar-alt"></i>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                       <label class="required">Date of Admission*</label>
                        <input name="date_of_admission" id="date_of_admission" value="{{ old('date_of_admission', '') }}" type="text" placeholder="yyyy/mm/dd" data-date-format="yyyy/mm/dd" class="form-control air-datepicker" data-position='bottom right' autocomplete="off" required>
                        <i class="far fa-calendar-alt"></i>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required">Blood Group</label>
                        <select class="form-control {{ $errors->has('blood_group') ? 'is-invalid' : '' }}" name="blood_group" id="blood_group">
                            <option value disabled {{ old('blood_group', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                            @foreach($blood_groups as $blood_group)
                                <option value="{{ $blood_group->id }}" {{ old('blood_group', '255') === (string) $blood_group->id ? 'selected' : '' }}>{{ $blood_group->title }}</option>
                            @endforeach
                        </select>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif    
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required">Marital Status*</label>
                        <select class="form-control {{ $errors->has('marital_status') ? 'is-invalid' : '' }}" name="marital_status" id="marital_status" required>
                            <option value disabled {{ old('marital_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                            @foreach($marital_status as $marital)
                                <option value="{{ $marital->id }}" {{ old('marital_status', '255') === (string) $marital->id ? 'selected' : '' }}>{{ $marital->title }}</option>
                            @endforeach
                        </select>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required">Special Needs*</label>
                        <select class="form-control {{ $errors->has('disability') ? 'is-invalid' : '' }}" name="disability" id="disability" data-dependent="lga_origin" required>
                            <option value disabled {{ old('disability', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                            @foreach($disabilities as $status)
                                <option value="{{ $status->id }}" {{ old('disability', '255') === (string) $status->id ? 'selected' : '' }}>{{ $status->title }}</option>
                            @endforeach
                        </select>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label for="hobby">{{ trans('cruds.studentAdmission.fields.hubby') }}</label>
                        <input class="form-control {{ $errors->has('hobby') ? 'is-invalid' : '' }}" type="text" name="hobby" id="hobby" value="{{ old('hobby', '') }}">
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.studentAdmission.fields.hubby_helper') }}</span>
                    </div>
                </div>
<div class="row">
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required">State of Origin*</label>
                        <select class="form-control {{ $errors->has('state_origin') ? 'is-invalid' : '' }}" name="state_origin" id="state_origin" data-dependent="lga_origin" required>
                            <option value disabled {{ old('state_origin', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                            @foreach($atlas->where('code_ds_atlas_entity', 2) as $state)
                                <option value="{{ $state->code_atlas_entity }}" {{ old('state_origin', '255') === (string) $state->code_atlas_entity ? 'selected' : '' }}>{{ $state->name_atlas_entity }}</option>
                            @endforeach
                        </select>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required">LGA of Origin*</label>
                        <select name="lga_origin" required="" class="form-control input-lg dynamic" id="lga_origin">
                            <option value="">Select LGA</option>
                        </select>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif    
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required">{{ trans('cruds.studentAdmission.fields.religion') }}*</label>
                        <select class="form-control {{ $errors->has('religion') ? 'is-invalid' : '' }}" name="religion" id="religion" required>
                            <option value disabled {{ old('religion', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                            @foreach($religions as $religion)
                                <option value="{{ $religion->id }}" {{ old('religion', '255') === (string) $religion->id ? 'selected' : '' }}>{{ $religion->title }}</option>
                            @endforeach
                        </select>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                    </div>
                    @if(Auth::User()->is_headTeacher)
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label for="class_id">{{ trans('cruds.studentAdmission.fields.class') }}*</label>
                        <select class="form-control {{ $errors->has('class_id') ? 'is-invalid' : '' }}" name="class_id" id="class_id">
                            <option disabled selected value="">Please Select</option>
                            @foreach($classroom as $class)
                                <option value="{{ $class->id }}">{{ $class["classTitle"]->title }} - {{ $class["armTitle"]->title }}</option>
                            @endforeach
                        </select>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.studentAdmission.fields.class_helper') }}</span>
                    </div>
                    @else
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label for="class_id">{{ trans('cruds.studentAdmission.fields.class') }}*</label>
                        <select class="form-control {{ $errors->has('class_id') ? 'is-invalid' : '' }}" name="class_id" id="class_id">
                            <option disabled selected value="">Please Select</option>
                        </select>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.studentAdmission.fields.class_helper') }}</span>
                    </div>
                    @endif
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required" for="address">{{ trans('cruds.studentAdmission.fields.address') }}*</label>
                        <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', '') }}" required>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif 
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required">Did Student Attended ECCD?*</label>
                        <select class="form-control {{ $errors->has('eccd') ? 'is-invalid' : '' }}" name="eccd" id="eccd" required>
                            <option value disabled {{ old('eccd', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                            @foreach($ds_yes_no as $yes_no)
                                <option value="{{ $yes_no->id }}" {{ old('eccd', '255') === (string) $yes_no->id ? 'selected' : '' }}>{{ $yes_no->title }}</option>
                            @endforeach
                        </select>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required">Did Student Completed Primary 6?*</label>
                        <select class="form-control {{ $errors->has('comp_p6_yes_no') ? 'is-invalid' : '' }}" name="comp_p6_yes_no" id="comp_p6_yes_no" required>
                            <option value disabled {{ old('comp_p6_yes_no', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                            @foreach($ds_yes_no as $yes_no)
                                <option value="{{ $yes_no->id }}" {{ old('comp_p6_yes_no', '255') === (string) $yes_no->id ? 'selected' : '' }}>{{ $yes_no->title }}</option>
                            @endforeach
                        </select>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required" for="student_picture">{{ trans('cruds.studentAdmission.fields.student_picture') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('student_picture') ? 'is-invalid' : '' }}" id="student_picture-dropzone">
                        </div>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.studentAdmission.fields.student_picture_helper') }}</span>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label for="student_document">{{ trans('cruds.studentAdmission.fields.student_document') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('student_document') ? 'is-invalid' : '' }}" id="student_document-dropzone">
                        </div>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.studentAdmission.fields.student_document_helper') }}</span>
                    </div>
                </div>
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
    </div>
</div>
</section>
@endsection
@section('scripts')
<script src="{{ asset('js/filter.js') }}"></script>
<script>
    $(document).ready(function(){
        $('select[name="school"]').on('change', function(){
             var school = $(this).val();

             if (school){
                $.ajax({
                    url: '/admin/student-admissions/fetchParents/'+school,
                    type: 'GET',
                    dataType: 'json',
                    beforeSend: function () {
                    $('.spinner').show();
                    },
                    success: function(data){ 
                        $('.spinner').hide();
                        $('select[name="parent_guardian_id"]').empty();
                        $('select[name="parent_guardian_id"]').prepend('<option selected disabled value="">Please Select</option>');
                        $('select[name="parent_guardian_id"]').append('<option value="1">Please </option>');
                        $.each(data, function(key, value){
                            $('select[name="parent_guardian_id"]').append(
                                '<option value="'+value.id+'">'+ value.first_name + ' ' + value.middle_name + ' ' + value.last_name +'</option>'
                            );
                        });
                    }
                });
             } else {
                $('select[name="parent_guardian_id"]').empty();
             }

             if (school){
                $.ajax({
                    url: '/admin/student-admissions/fetchClass/'+school,
                    type: 'GET',
                    dataType: 'json',
                    beforeSend: function () {
                    $('.spinner').show();
                    },
                    success: function(data){ 
                        $('.spinner').hide();
                        $('select[name="class_id"]').empty();
                        $('select[name="class_id"]').prepend('<option selected disabled value="">Please Select</option>');
                        $('select[name="class_id"]').append('<option value="1">Please </option>');
                        $.each(data, function(key, value){
                            console.log(value);
                            $('select[name="class_id"]').append(
                                '<option value="'+value.id+'">'+ value.class_title.title + ' - ' + value.arm_title.title +'</option>'
                            );
                        });
                    }
                });
             } else {
                $('select[name="class_id"]').empty();
             }
        });
    });

    $(document).ready(function() {
        $('select[name="state_origin"]').on('change', function(){
            var lga = $(this).val();
            if (lga){
                $.ajax({
                    url: '/admin/lga/fetchLgas/'+lga,
                    type: 'GET',
                    dataType: 'json',
                    beforeSend: function () {
                    $('.spinner').show();
                    },
                    success: function(data){
                        $('.spinner').hide();
                         $('select[name="lga_origin"]').empty();
                         $('select[name="lga_origin"]').prepend('<option selected disabled value="">Please Select</option>');
                         $.each(data, function(key, value){
                            $('select[name="lga_origin"]').append(
                                '<option value="'+key+'">'+ value +'</option>'
                                );
                         });
                    }
                });
             } else {
                $('select[name="lga_origin"]').empty();
             }
        });
    });
</script>
<script>
    Dropzone.options.studentPictureDropzone = {
    url: '{{ route('admin.student-admissions.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="student_picture"]').remove()
      $('form').append('<input type="hidden" name="student_picture" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="student_picture"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($studentAdmission) && $studentAdmission->student_picture)
      var file = {!! json_encode($studentAdmission->student_picture) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, '{{ $studentAdmission->student_picture->getUrl('thumb') }}')
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="student_picture" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
<script>
    var uploadedStudentDocumentMap = {}
    Dropzone.options.studentDocumentDropzone = {
    url: '{{ route('admin.student-admissions.storeMedia') }}',
    maxFilesize: 8, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 8
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="student_document[]" value="' + response.name + '">')
      uploadedStudentDocumentMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedStudentDocumentMap[file.name]
      }
      $('form').find('input[name="student_document[]"][value="' + name + '"]').remove()
    },
    init: function () {
    @if(isset($studentAdmission) && $studentAdmission->student_document)
              var files =
                {!! json_encode($studentAdmission->student_document) !!}
                  for (var i in files) {
                  var file = files[i]
                  this.options.addedfile.call(this, file)
                  file.previewElement.classList.add('dz-complete')
                  $('form').append('<input type="hidden" name="student_document[]" value="' + file.file_name + '">')
                }
    @endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection