@extends('layouts.admin')
@section('content')
<section class="content-header"><div style="margin-bottom: 10px;" class="row">
  <div class="col-lg-12">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
      Add Individually
    </button>  
  </div>

  <div class="modal fade" id="exampleModalCenter" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Individual Flow</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('admin.promotion.individual') }}" method="POST">
        @csrf
          <div class="modal-body">
            <div class="row">
            @include('partials.filter.class')
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="control-label">Student</label>
                    <select name="student" class="form-control input-lg dynamic" data-dependent="target_classs">
                        <option value="">Select Student</option>
                    </select>
                </div>
            </div>
            @if(Auth::User()->is_headTeacher)
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="control-label">Class</label>
                    <select name="clazz" class="form-control input-lg dynamic" data-dependent="student">
                        <option value="">Select Class</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label class="control-label">Student</label>
                    <select name="student" class="form-control input-lg dynamic" data-dependent="target_classs">
                        <option value="">Select Student</option>
                    </select>
                </div>
            </div>
            @endif
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="control-label">Target Class</label>
                    <select name="target_classs" class="form-control input-lg dynamic">
                        <option value="">Select Class</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-6">
              <div class="form-group">
                  <label class="control-label">Flow Type</label>
                  <select name="floww" class="form-control" id="floww" required>
                    <option value="" disabled selected>Please Select</option>
                    @foreach($flows as $id => $class)
                      <option value="{{ $id }}">{{ $class }}</option>
                    @endforeach
                  </select>
              </div>
            </div>

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                Students Flow
            </div>

            <div class="card-body">
                <form action="{{ route('admin.promotion.store') }}" method="POST" class="form" id="form">
                  @csrf
                  <div class="row">
                    <h4>Select Class</h4>
                    <hr>
                  </div>
                  @include('partials.filter.class')
                  <div class="row">
                    <h4>Select Target Class</h4>
                    <hr>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                          <label class="control-label">Class</label>
                          <select name="target_class" class="form-control" id="target_class" required>
                            <option value="" disabled selected>Please Select</option>
                            @foreach($classes as $target_class)
                              <option value="{{ $target_class->id }}">{{ $target_class["classTitle"]->title }} - {{ $target_class["armTitle"]->title }}</option>
                            @endforeach
                          </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                          <label class="control-label">Flow Type</label>
                          <select name="flow" class="form-control" id="flow" required>
                            <option value="" disabled selected>Please Select</option>
                            @foreach($flows as $id => $class)
                              <option value="{{ $id }}">{{ $class }}</option>
                            @endforeach
                          </select>
                      </div>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary" id="submit">Continue</button>
                </form>
            </div>
        </div>
    </div>
</section>
@section('scripts')
<script src="{{ asset('js/filter2.js') }}"></script>
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

    $(document).ready(function(){
        $('select[name="schooll"]').on('change', function(){
             var school = $(this).val();

             if (school){
                $.ajax({
                    url: '/admin/lga/fetchClasss/'+school,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                         $('select[name="clazz"]').empty();
                            $('select[name="clazz"]').prepend(
                            '<option value="">'+ "Please Select" +'</option>'
                            );
                         $.each(data, function(key, value){
                            $('select[name="clazz"]').append(
                                '<option value="'+value.id+'">'+ value.title + '</option>'
                                );
                         });
                    }
                });
             } else {
                $('select[name="clazz"]').empty();
             }
        });
    });

    $(document).ready(function(){
        $('select[name="clazz"]').on('change', function(){
             var school = $(this).val();

             if (school){
                $.ajax({
                    url: '/admin/lga/fetchStudent/'+school,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                         $('select[name="student"]').empty();
                            $('select[name="student"]').prepend(
                            '<option value="">'+ "Please Select" +'</option>'
                            );
                         $.each(data, function(key, value){
                            $('select[name="student"]').append(
                                '<option value="'+value.id+'">'+ value.child_name + ' ' + value.middle_name + ' ' + value.last_name + '</option>'
                                );
                         });
                    }
                });
             } else {
                $('select[name="student"]').empty();
             }
        });
    });

    $(document).ready(function(){
        $('select[name="student"]').on('change', function(){
             var school = $(this).val();

             if (school){
                $.ajax({
                    url: '/admin/lga/fetchClasss/'+school,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                         $('select[name="target_classs"]').empty();
                            $('select[name="target_classs"]').prepend(
                            '<option value="">'+ "Please Select" +'</option>'
                            );
                         $.each(data, function(key, value){
                            $('select[name="target_classs"]').append(
                                '<option value="'+value.id+'">'+ value.title + '</option>'
                                );
                         });
                    }
                });
             } else {
                $('select[name="target_classs"]').empty();
             }
        });
    });
</script>
@endsection
@endsection