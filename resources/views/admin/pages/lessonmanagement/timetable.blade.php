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
                    <td rowspan="{{ $value['rowspan'] }}" class="align-middle text-center" style="background-color:#f0f0f0">
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
