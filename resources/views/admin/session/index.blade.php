@extends('layouts.admin')
@section('content')
<section class="content-header">
  <div style="margin-bottom: 10px;" class="row">
      <div class="col-lg-12">
        <a class="btn btn-primary" data-toggle="modal" data-target="#add" style="color: white;">
          {{ trans('global.add') }} {{ 'New Session' }}
        </a>
        <a class="btn btn-primary ml-auto" data-toggle="modal" data-target="#add2" style="color: white;">
          {{ trans('global.add') }} {{ 'New Term' }}
        </a>
      </div>
  </div>
</section>

<section class="content">
  <div class="card">
      <div class="card-header">
          {{ 'Session && Term' }}
      </div>

      <div class="card-body">
      Current Session: {{ $currentSession->year_session }} <br>
      Current Term: {{ $currentTerm->name }}
      <hr>
      
      <div class="row">
        <div class="col-6">
          <form method="POST" action="{{ route("admin.session.update") }}">
            @method('PUT')
            @csrf
            <div class="form-group col-6">
                <label for="session">Choose Current Session</label>
                <select class="form-control select2 {{ $errors->has('session') ? 'is-invalid' : '' }}" name="session" id="session">
                <option value="" disabled selected>Please Select</option>
                  @foreach($sessions as $session)
                      <option value="{{ $session->id }}">{{ $session->year_session }} @if($session->active_status == 1) - Current Section @endif</option>
                  @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">
                    {{ trans('global.update') }}
                </button>
            </div>
          </form>
        </div>
        <div class="col-6">
          <form method="POST" action="{{ route("admin.term.update") }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group col-6">
                <label for="term">Choose Current Term</label>
                <select class="form-control select2 {{ $errors->has('term') ? 'is-invalid' : '' }}" name="term" id="term">
                <option value="" disabled selected>Please Select</option>
                  @foreach($terms as $term)
                      <option value="{{ $term->id }}">{{ $term->name }} @if($term->active_status == 1) - Current Term @endif</option>
                  @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">
                    {{ trans('global.update') }}
                </button>
            </div>
          </form>
        </div>
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
                <form class="new-added-form" method="POST" action="{{ route("admin.session.store") }}">
                @csrf
                  <div class="row">
                    <div class="col-12 form-group">
                        <label class="required" for="session">Session</label>
                        <input class="form-control {{ $errors->has('session') ? 'is-invalid' : '' }}" type="text" name="session" id="session" value="{{ old('session', '') }}" placeholder="e.g 2018/2019" required>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif   
                    </div>
                    <div class="col-12 form-group">
                      <label>Starting Date</label>
                      <input name="starting_date" id="starting_date" value="{{ old('starting_date', '') }}" type="text" placeholder="yyyy/mm/dd" data-date-format="yyyy/mm/dd" class="form-control" data-position='bottom right' autocomplete="off">
                      <i class="far fa-calendar-alt"></i>   
                    </div>
                    <div class="col-12 form-group">
                      <label>Ending Date</label>
                      <input name="ending_date" id="ending_date" value="{{ old('ending_date', '') }}" type="text" placeholder="yyyy/mm/dd" data-date-format="yyyy/mm/dd" class="form-control" data-position='bottom right' autocomplete="off">
                      <i class="far fa-calendar-alt"></i>   
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
        <div class="modal sign-up-modal fade" id="add2" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <div class="close-btn">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form class="new-added-form" method="POST" action="{{ route("admin.term.store") }}">
                @csrf
                  <div class="row">
                    <div class="col-12 form-group">
                        <label class="required" for="name">Term Name</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" placeholder="e.g First Term" required>
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

  <div class="card">
    <div class="card-header">Manage Session && Term</div>
    <div class="card-body">
      <div class="row">
        <div class="col-6">
          <h4>Session</h4>
          <br>
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="card">
                    <div class="card-header">
                      <div class="container-fluid">
                        <div class="row">
                          <h3 class="card-title">List of Sessions</h3>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                          <div class="col-sm-12">
                            <table id="dataTable" class="table table-striped table-bordered">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Title</th>
                                  <th width="280px">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($sessions as $session)
                                <tr>
                                    <td>{{ $session->id }}</td>
                                    <td>{{ $session->year_session }}</td>
                                    <td width="280px">
                                      <a class="btn btn-primary" data-toggle="modal" data-target="#edit-{{$session->id}}" style="height: 30px; font-size: 12px; color: white;">
                                        Edit
                                      </a>
                                      @if($session->active_status == 0)
                                      <a class="btn btn-danger" data-toggle="modal" data-target="#delete-session-{{$session->id}}" style="height: 30px; font-size: 12px; color: white;">
                                        Edit
                                      </a>
                                      @else
                                      <i class="mdi mdi-circle text-success">Active</i>
                                      @endif
                                    </td>
                                </tr>
              <div class="modal sign-up-modal fade" id="edit-{{$session->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-body">
                      <div class="close-btn">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form class="new-added-form" method="POST" action="{{ route('admin.session.edit', $session->id) }}">
                      @csrf
                      @method('PUT')
                        <div class="row">
                          <div class="col-12 form-group">
                              <label class="required" for="session">Session</label>
                              <input class="form-control {{ $errors->has('session') ? 'is-invalid' : '' }}" type="text" name="session" id="session" value="{{ old('session', $session->year_session) }}" placeholder="e.g 2018/2019" required>
                              @if($errors->has(''))
                                  <span class="text-danger">{{ $errors->first('') }}</span>
                              @endif   
                          </div>
                          <div class="col-12 form-group">
                            <label>Starting Date</label>
                            <input name="starting_date" id="starting_date" value="{{ old('starting_date', $session->starting_date) }}" type="text" placeholder="yyyy/mm/dd" data-date-format="yyyy/mm/dd" class="form-control" data-position='bottom right' autocomplete="off">
                            <i class="far fa-calendar-alt"></i>   
                          </div>
                          <div class="col-12 form-group">
                            <label>Ending Date</label>
                            <input name="ending_date" id="ending_date" value="{{ old('ending_date', $session->ending_date) }}" type="text" placeholder="yyyy/mm/dd" data-date-format="yyyy/mm/dd" class="form-control" data-position='bottom right' autocomplete="off">
                            <i class="far fa-calendar-alt"></i>   
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
              <div class="modal sign-up-modal fade" id="delete-session-{{$term->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-body">
                      <div class="close-btn">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form class="new-added-form" method="POST" action="{{ route('admin.session.delete', $term->id) }}">
                      @csrf
                      @method('DELETE')
                          <p class="text-danger">Are you sure you want to proceed?</p>
                          <div class="col-xl-3 col-lg-6 col-12 form-group">
                              <button class="btn btn-primary" type="submit">
                                  {{ trans('global.yes') }}
                              </button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-6">
          <h4>Term</h4>
          <br>
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="card">
                    <div class="card-header">
                      <div class="container-fluid">
                        <div class="row">
                          <h3 class="card-title">List of Terms</h3>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                          <div class="col-sm-12">
                            <table id="dataTable" class="table table-striped table-bordered">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Title</th>
                                  <th width="280px">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($terms as $term)
                                <tr>
                                    <td>{{ $term->id }}</td>
                                    <td>{{ $term->name }}</td>
                                    <td width="280px">
                                      <a class="btn btn-primary" data-toggle="modal" data-target="#edit-term-{{$term->id}}" style="height: 30px; font-size: 12px; color: white;">
                                        Edit
                                      </a>
                                      @if($term->active_status == 0)
                                      <a class="btn btn-danger" data-toggle="modal" data-target="#delete-term-{{$term->id}}" style="height: 30px; font-size: 12px; color: white;">
                                        Delete
                                      </a>
                                      @else
                                      <i class="mdi mdi-circle text-success">Active</i>
                                      @endif
                                    </td>
                                </tr>
              <div class="modal sign-up-modal fade" id="edit-term-{{$term->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-body">
                      <div class="close-btn">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form class="new-added-form" method="POST" action="{{ route('admin.term.edit', $term->id) }}">
                      @csrf
                      @method('PUT')
                        <div class="row">
                          <div class="col-12 form-group">
                              <label class="required" for="name">Session</label>
                              <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $term->name) }}" placeholder="e.g 2018/2019" required>
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
              <div class="modal sign-up-modal fade" id="delete-term-{{$term->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-body">
                      <div class="close-btn">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form class="new-added-form" method="POST" action="{{ route('admin.term.delete', $term->id) }}">
                      @csrf
                      @method('DELETE')
                          <p class="text-danger">Are you sure you want to proceed?</p>
                          <div class="col-xl-3 col-lg-6 col-12 form-group">
                              <button class="btn btn-primary" type="submit">
                                  {{ trans('global.yes') }}
                              </button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>  
  </div>
</section>
@endsection