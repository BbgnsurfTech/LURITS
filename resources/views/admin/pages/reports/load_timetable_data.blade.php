<!-- /.card-header -->
<div class="card-body">
    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-bordered">
                    <thead>
                    <th width="125">Time</th>
                    @foreach($week_days as $day)
                        <th>{{ $day }}</th>
                    @endforeach
                    </thead>
                    <tbody>
                    @foreach($time_table_data as $time => $days)
                        <tr>
                            <td>
                                {{ $time }}
                            </td>
                            @foreach($days as $value)
                                @if (is_array($value))
                                    <td rowspan="{{ $value['rowspan'] }}" class="align-middle text-center"
                                        style="background-color:#f0f0f0">
                                        {{ $value['section_name'] }}<br>
                                        {{ $value['subject_name'] }}<br>
                                        {{ $value['teacher_name'] }}
                                    </td>
                                @elseif ($value === 1)
                                    <td></td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
<!-- /.card-body -->
<!-- /.card-body -->
<div class="card-footer clearfix">
    <div class="row no-print">
        <div class="col-12">
            <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i
                    class="fas fa-print"></i> Print</a>
            <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                <i class="fas fa-download"></i> Generate PDF
            </button>
        </div>
    </div>
</div>
