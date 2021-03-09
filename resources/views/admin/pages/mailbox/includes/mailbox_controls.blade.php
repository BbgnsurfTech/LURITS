<div class="mailbox-controls">

    <!-- Check all button -->
    @if(Request::segment(3) != 'Trash')
        <button type="button" class="btn btn-default btn-sm checkbox-toggle">
            <i class="far fa-square"></i>
        </button>
    @endif
    <div class="btn-group">

        @if(Request::segment(3)==''||Request::segment(3)=='Inbox')
            <button type="button" class="btn btn-default btn-sm mailbox-star-all" title="toggle important state" style="display: inline">
                <i class="fa fa-star"></i>
            </button>

            <button type="button" class="btn btn-default btn-sm mailbox-trash-all" title="add to trash" style="display: inline">
                <i class="far fa-trash-alt"></i>
            </button>
            <button type="button" class="btn btn-default btn-sm mailbox-reply" title="reply" style="display: inline">
                <i class="fas fa-reply"></i>
            </button>
                    
            <button type="button" class="btn btn-default btn-sm mailbox-forward" title="forward" style="display: inline">
                <i class="fas fa-share"></i>
            </button>

        @elseif(Request::segment(3) == 'Sent')
                <button type="button" class="btn btn-default btn-sm mailbox-star-all" title="toggle important state" style="display: inline"><i class="fa fa-star"></i></button>

                <button type="button" class="btn btn-default btn-sm mailbox-trash-all" title="add to trash" style="display: inline"><i class="fa fa-trash-o"></i></button>

                <button type="button" class="btn btn-default btn-sm mailbox-forward" title="forward" style="display: inline"><i class="fa fa-mail-forward"></i></button>
        @elseif(Request::segment(3) == 'Drafts')
                <button type="button" class="btn btn-default btn-sm mailbox-star-all" title="toggle important state" style="display: inline"><i class="fa fa-star"></i></button>

                <button type="button" class="btn btn-default btn-sm mailbox-trash-all" title="add to trash" style="display: inline"><i class="fa fa-trash-o"></i></button>

                <button type="button" class="btn btn-default btn-sm mailbox-send" title="send" style="display: inline"><i class="fa fa-mail-forward"></i></button>
        @endif
    </div>

    <div class="float-right">
        {{$messages->currentPage()}}-{{$messages->perPage()}}/{{$messages->total()}}
            
            <!-- /.btn-group -->
    </div>
    <!-- /.float-right -->

</div>