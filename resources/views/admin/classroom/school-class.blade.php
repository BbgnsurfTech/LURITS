@extends('layouts.admin')
@section('content')
<section class="content-header">
  <div style="margin-bottom: 10px;" class="row">
      <div class="col-lg-12">
        <a class="btn btn-primary" data-toggle="modal" data-target="#add" style="color: white;">
          {{ trans('global.add') }} {{ 'New Class' }}
        </a>
      </div>
  </div>
</section>

<section class="content">
  <div class="card">
      <div class="card-header">
          School Classes
      </div>

      <div class="card-body">
        <div class="row">
          <table class="table">
            <thead>
              <th>#</th>
              <th>Class</th>
              <th>Arm</th>
              <th>Action</th>
            </thead>
            <tbody>
              
            </tbody>
          </table>
        </div>

        <div class="modal sign-up-modal fade" id="add" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <div class="close-btn">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form class="new-added-form" method="POST" action="{{ route("admin.classrooms.store") }}">
                @csrf
                  <div class="row">
                    <div class="col-12 form-group">
                        <label class="required" for="classs">Class</label>
                        <input class="form-control {{ $errors->has('classs') ? 'is-invalid' : '' }}" type="text" name="classs" id="classs" value="{{ old('classs', '') }}" placeholder="e.g Primary 1" required>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif   
                    </div>
                    <div class="col-12 form-group">
                        <label class="required" for="arm">Arm</label>
                        <select class="form-control" name="arm" id="arm">
                          <option value="" disabled selected>Please Select</option>
                          @foreach($arms as $arm)
                          <option value="{{ $arm->id }}">{{ $arm->title }}</option>
                          @endforeach
                        </select>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif   
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
          </div>
        </div>
      </div>
  </div>
</section>
@endsection