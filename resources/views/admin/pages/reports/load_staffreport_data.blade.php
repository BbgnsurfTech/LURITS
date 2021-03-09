<table id="staffreporttb" class="table table-striped table-bordered table-hover table-condensed nowrap">
    <thead style="font-weight: bold;">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone No.</th>
            <th>School</th>
        </tr>
    </thead>
    <tbody>
        @foreach($staff as $staf)
            <tr>
                <td>{{$loop->index+1}}</td>
                <td>{{$staf->firstname}} {{isset($staf->middlename)?$staf->middlename.' ':''}}{{$staf->othername}}</td>               
                <td>{{$staf->email}}</td>
                <td>{{$staf->gsm}}</td>
                <td>{{$staf->school}}</td>
            </tr>
        @endforeach
      </tbody>
     </table>