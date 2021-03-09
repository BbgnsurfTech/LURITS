@extends('layouts.admin')
@section('content')
<section class="content">
<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.user.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.users.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">Name*</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.user.fields.email') }}*</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email') }}" required>
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="profile_img">{{ trans('cruds.user.fields.profile_img') }}</label>
                <div class="needsclick dropzone {{ $errors->has('profile_img') ? 'is-invalid' : '' }}" id="profile_img-dropzone">
                </div>
                @if($errors->has('profile_img'))
                    <span class="text-danger">{{ $errors->first('profile_img') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.profile_img_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="password">{{ trans('cruds.user.fields.password') }}*</label>
                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password" required>
                @if($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="roles">Role*</label>
                <select class="form-control {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="roles" id="roles" required>
                    <option disabled selected value="">Please Select</option>
                    @foreach($roles as $id => $roles)
                        <option value="{{ $id }}" {{ (old('roles', '')) ? 'selected' : '' }}>{{ $roles }}</option>
                    @endforeach
                </select>
                @if($errors->has('roles'))
                    <span class="text-danger">{{ $errors->first('roles') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
            </div>
            <div class="form-group" id="zone" style="display: none;">
                <label class="required" for="zone">Zone</label>
                <select class="form-control {{ $errors->has('zone') ? 'is-invalid' : '' }}" name="zone" id="zone" >
                    <option disabled selected value="">Please Select</option>
                    @foreach($zones as $zone)
                    <option value="{{ $zone->code_atlas_entity }}">{{ $zone->name_atlas_entity }}</option>
                    @endforeach
                </select>
                @if($errors->has('zone'))
                    <span class="text-danger">{{ $errors->first('zone') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
            </div>
            <div class="form-group" id="lga" style="display: none;">
                <label class="required" for="lga">LGA</label>
                <select class="form-control {{ $errors->has('lga') ? 'is-invalid' : '' }}" name="lga" id="lga" >
                    <option disabled selected value="">Please Select</option>
                </select>
                @if($errors->has('lga'))
                    <span class="text-danger">{{ $errors->first('lga') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
            </div>
            <div class="form-group" id="school_sector" style="display: none;">
                <label class="required" for="school_sector">Sector</label>
                <select class="form-control {{ $errors->has('school_sector') ? 'is-invalid' : '' }}" name="school_sector" id="school_sector" >
                    <option disabled selected value="">Please Select</option>
                </select>
                @if($errors->has('school_sector'))
                    <span class="text-danger">{{ $errors->first('school_sector') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
            </div>
            <div class="form-group" id="school" style="display: none;">
                <label class="required" for="school">School</label>
                <select class="form-control {{ $errors->has('school') ? 'is-invalid' : '' }}" name="school" id="school" >
                    <option disabled selected value="">Please Select</option>
                </select>
                @if($errors->has('school'))
                    <span class="text-danger">{{ $errors->first('school') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-primary mt-2" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
</section>
@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function() {
    $('select[name="roles"]').on('change', function(){
        var role = $(this).val();
        // alert(role);
        if (role == 3) {
            document.getElementById("zone").style.display = "inline";
            document.getElementById("lga").style.display = "none";
            document.getElementById("school_sector").style.display = "none";
            document.getElementById("school").style.display = "none";
        } else if (role == 4) {
            document.getElementById("zone").style.display = "inline";
            document.getElementById("lga").style.display = "inline";
            document.getElementById("school_sector").style.display = "none";
            document.getElementById("school").style.display = "none";
        } else if (role == 5) {
            document.getElementById("zone").style.display = "inline";
            document.getElementById("lga").style.display = "inline";
            document.getElementById("school_sector").style.display = "inline";
            document.getElementById("school").style.display = "inline";
        } else if (role == 6) {
            document.getElementById("zone").style.display = "inline";
            document.getElementById("lga").style.display = "inline";
            document.getElementById("school_sector").style.display = "inline";
            document.getElementById("school").style.display = "inline";
        } else {
            document.getElementById("zone").style.display = "none";
            document.getElementById("lga").style.display = "none";
            document.getElementById("school_sector").style.display = "none";
            document.getElementById("school").style.display = "none";
        }


        // if (role == 3 || role == 4) {
            
        //     document.getElementById("zone").style.display = "inline";
        //     document.getElementById("school_sector").style.display = "none";
        //     document.getElementById("school").style.display = "none";
        // } else if(role == 4) {
        //     document.getElementById("lga").style.display = "none";
        // } else if(role == 5 || role ==6) {
        //     document.getElementById("zone").style.display = "inline";
        //     document.getElementById("lga").style.display = "inline";
        //     document.getElementById("school_sector").style.display = "inline";
        //     document.getElementById("school").style.display = "inline";
        // } else {
        //     document.getElementById("zone").style.display = "none";
        //     document.getElementById("lga").style.display = "none";
        //     document.getElementById("school_sector").style.display = "none";
        //     document.getElementById("school").style.display = "none";
        // }
    });

    $('select[name="zone"]').on('change', function(){

        var role = $('select[name="roles"]').val();
        var zone = $('select[name="zone"]').val();
        // alert(role);
        if (role == 4 || role == 5 || role == 6) {
            if (role){
                $.ajax({
                    url: '/admin/lga/fetchLgas/'+zone,
                    type: 'GET',
                    dataType: 'json',
                    beforeSend: function () {
                     $('.spinner').show();
                    },
                    success: function(data){
                     $('.spinner').hide();
                         $('select[name="lga"]').empty();
                         $('select[name="lga"]').prepend(
                                '<option value="" disabled selected>'+ "Please Select" +'</option>'
                                );
                         $.each(data, function(key, value){
                            $('select[name="lga"]').append(
                                '<option value="'+key+'">'+ value +'</option>'
                                );
                         });
                    }
                });
             } else {
                $('select[name="lga"]').empty();
             }
            document.getElementById("lga").style.display = "inline";
        } else if(role == 3) {
            document.getElementById("lga").style.display = "none";
        }
    });

    // if(role == 5 || role == 6) {
    //     var role = $('select[name="roles"]').val();
    //     var zone = $('select[name="zone"]').val();
        
        $('select[name="lga"]').on('change', function(){
             var lga = $(this).val();
             var role = $('select[name="roles"]').val();
             // alert(lga);

             if(role == 5 || role == 6) {
                 if (lga){
                    $.ajax({
                        url: '/admin/lga/fetchSectors/',
                        type: 'GET',
                        dataType: 'json',
                        beforeSend: function () {
                            $('.spinner').show();
                        },
                        success: function(data){
                            $('.spinner').hide();
                             $('select[name="school_sector"]').empty();
                             $('select[name="school_sector"]').prepend(
                                    '<option disabled selected value="">'+ "Please Select" +'</option>'
                                    );
                             $.each(data, function(key, value){
                                $('select[name="school_sector"]').append(
                                    '<option value="'+value.id+'">'+ value.title +'</option>'
                                    );
                             });
                        }
                    });
                 } else {
                    $('select[name="school_sector"]').empty();
                 }
            }
        });

        $('select[name="school_sector"]').on('change', function(){
             var sector = $(this).val();
             var lga = $('select[name="lga"]').val();
             var role = $('select[name="roles"]').val();

             if(role == 5 || role == 6) {
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
                             $('select[name="school"]').empty();
                             $.each(data, function(key, value){
                                $('select[name="school"]').append(
                                    '<option value="'+key+'">'+ value +'</option>'
                                    );
                             });
                        }
                    });
                 } else {
                    $('select[name="school"]').empty();
                 }
            }
        });

});

</script>
<script>
    Dropzone.options.profileImgDropzone = {
    url: '{{ route('admin.users.storeMedia') }}',
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
      $('form').find('input[name="profile_img"]').remove()
      $('form').append('<input type="hidden" name="profile_img" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="profile_img"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($user) && $user->profile_img)
      var file = {!! json_encode($user->profile_img) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, '{{ $user->profile_img->getUrl('thumb') }}')
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="profile_img" value="' + file.file_name + '">')
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
@endsection