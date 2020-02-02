@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.studentAdmission.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.student-admissions.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="child_name">{{ trans('cruds.studentAdmission.fields.child_name') }}</label>
                <input class="form-control {{ $errors->has('child_name') ? 'is-invalid' : '' }}" type="text" name="child_name" id="child_name" value="{{ old('child_name', '') }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.studentAdmission.fields.child_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="middle_name">{{ trans('cruds.studentAdmission.fields.middle_name') }}</label>
                <input class="form-control {{ $errors->has('middle_name') ? 'is-invalid' : '' }}" type="text" name="middle_name" id="middle_name" value="{{ old('middle_name', '') }}">
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.studentAdmission.fields.middle_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="last_name">{{ trans('cruds.studentAdmission.fields.last_name') }}</label>
                <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', '') }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.studentAdmission.fields.last_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="admission">{{ trans('cruds.studentAdmission.fields.admission') }}</label>
                <input class="form-control {{ $errors->has('admission') ? 'is-invalid' : '' }}" type="number" name="admission" id="admission" value="{{ old('admission') }}" step="1" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.studentAdmission.fields.admission_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.studentAdmission.fields.gender') }}</label>
                <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender" required>
                    <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\StudentAdmission::GENDER_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('gender', '255') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.studentAdmission.fields.gender_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.studentAdmission.fields.state_origin') }}</label>
                <select class="form-control {{ $errors->has('state_origin') ? 'is-invalid' : '' }}" name="state_origin" id="state_origin" required>
                    <option value disabled {{ old('state_origin', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\StudentAdmission::STATE_ORIGIN_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('state_origin', '255') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.studentAdmission.fields.state_origin_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.studentAdmission.fields.nationality_1') }}</label>
                <select class="form-control {{ $errors->has('nationality_1') ? 'is-invalid' : '' }}" name="nationality_1" id="nationality_1" required>
                    <option value disabled {{ old('nationality_1', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\StudentAdmission::NATIONALITY_1_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('nationality_1', '255') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.studentAdmission.fields.nationality_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="hubby">{{ trans('cruds.studentAdmission.fields.hubby') }}</label>
                <input class="form-control {{ $errors->has('hubby') ? 'is-invalid' : '' }}" type="text" name="hubby" id="hubby" value="{{ old('hubby', '') }}">
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.studentAdmission.fields.hubby_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="student_picture">{{ trans('cruds.studentAdmission.fields.student_picture') }}</label>
                <div class="needsclick dropzone {{ $errors->has('student_picture') ? 'is-invalid' : '' }}" id="student_picture-dropzone">
                </div>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.studentAdmission.fields.student_picture_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="student_document">{{ trans('cruds.studentAdmission.fields.student_document') }}</label>
                <div class="needsclick dropzone {{ $errors->has('student_document') ? 'is-invalid' : '' }}" id="student_document-dropzone">
                </div>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.studentAdmission.fields.student_document_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="school_enrolled_id">{{ trans('cruds.studentAdmission.fields.school_enrolled') }}</label>
                <select class="form-control select2 {{ $errors->has('school_enrolled') ? 'is-invalid' : '' }}" name="school_enrolled_id" id="school_enrolled_id">
                    @foreach($school_enrolleds as $id => $school_enrolled)
                        <option value="{{ $id }}" {{ old('school_enrolled_id') == $id ? 'selected' : '' }}>{{ $school_enrolled }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.studentAdmission.fields.school_enrolled_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="parent_guardian_id">{{ trans('cruds.studentAdmission.fields.parent_guardian') }}</label>
                <select class="form-control select2 {{ $errors->has('parent_guardian') ? 'is-invalid' : '' }}" name="parent_guardian_id" id="parent_guardian_id">
                    @foreach($parent_guardians as $id => $parent_guardian)
                        <option value="{{ $id }}" {{ old('parent_guardian_id') == $id ? 'selected' : '' }}>{{ $parent_guardian }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.studentAdmission.fields.parent_guardian_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
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