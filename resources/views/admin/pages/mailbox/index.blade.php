@extends('layouts.master')

@section('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection



@section('content')
    <div class="content-wrapper" style="min-height: 1249.6px;">
    <!-- Page title -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Voice Calls</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Settings</a></li>
                        <li class="breadcrumb-item active">Manage  Voice Calls</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <a href="{{ url('admin/mailbox-create') }}" class="btn btn-primary btn-block mb-3">Compose</a>


          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Folders</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <ul class="nav nav-pills flex-column">
                <li class="nav-item active">
                  <a href="#" class="nav-link">
                    <i class="fas fa-inbox"></i> Inbox
                      @if($unreadMessages)
                      <span class="badge bg-primary float-right">
                        <small>{{$unreadMessages}} new messages</small>
                        </span>
                      @else
                      <span class="float-right">
                      {{$messages->total()}}
                      </span>

                      @endif
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-envelope"></i> Sent
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-file-alt"></i> Drafts
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-trash-alt"></i> Trash
                  </a>
                </li>
              </ul>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Inbox</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm">
                  <input type="text" class="form-control" placeholder="Search Mail">
                  <div class="input-group-append">
                    <div class="btn btn-primary">
                      <i class="fas fa-search"></i>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->




            
            @if(!$messages->isEmpty())

            <div class="card-body p-0">
              
            @include('admin.pages.mailbox.includes.mailbox_controls')

              <div class="table-responsive mailbox-messages">
                    <table class="table table-hover table-striped">
                        <tbody>
                            @foreach($messages as $message)
                                <tr data-mailbox-id="{{ $message->id }}" data-mailbox-flag-id="{{ $message->mailbox_flag_id }}" data-user-folder-id="{{ $message->mailbox_folder_id }}">
                                    <td>
                                      @if(Request::segment(3) != 'Trash')
                                        <input type="checkbox" value="1" data-mailbox-id="{{ $message->id }}" data-mailbox-flag-id="{{ $message->mailbox_flag_id }}" class="check-message">
                                      @endif
                                    </td>
                                    @if(Request::segment(3) != 'Trash')
                                    <td class="mailbox-star">
                                      <a href="#"><i class="{{ $message->is_important==1?'fas fa-star':'far fa-star' }} text-yellow"></i></a>
                                    </td>
                                    @endif
                                    
                                    <td class="mailbox-subject">
                                      @if($message->is_unread == 1)
                                        <b>{{ $message->subject }}</b>
                                      @else
                                            {{ $message->subject }}
                                      @endif
                                    </td>
                                    <td class="mailbox-attachment">
                                      @if($message->attachments->count() > 0)
                                        <i class="fa fa-paperclip"></i>
                                      @endif
                                    </td>
                                    <td class="mailbox-date">@if($message->time_sent) {{ Carbon\Carbon::parse($message->time_sent)->diffForHumans()}} @else {{ "not sent yet" }}  @endif</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- /.table -->
                </div>
                <!-- /.mail-box-messages -->


            </div>
            <!-- /.card-body -->
            <div class="card-footer p-0">

            @include('admin.pages.mailbox.includes.mailbox_controls')
            
            </div>
            @else
            <div class="card-body p-3">
                <p>No messages found</p>
              </div>
            @endif
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

    </div>
@endsection

@section('scripts')
    <!-- DataTables -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script> 
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
@endsection
