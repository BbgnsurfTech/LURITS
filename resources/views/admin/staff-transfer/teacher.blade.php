@extends('layouts.admin')
@section('content')
<section class="content">
    <div class="card">
        <div class="card-header">Transfer List</div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <th>ID</th>
                    <th>Date</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($transfers as $transfer)
                    <tr>
                        <td>{{ $transfer->id }}</td>
                        <td>{{ $transfer->created_at->diffForHumans() }}</td>
                        <td><a href="{{ route('admin.staff-transfer.show', $transfer->id) }}" class="btn btn-success">View</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
@section('scripts')
@parent
<script src="{{ asset('js/filter.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#inibtn').on('click', function(){
            document.getElementById("initiate").style.display = "inline";
            document.getElementById("request").style.display = "none";
            //document.getElementById("teacher").style.display = "none";
        });
    });

    $(document).ready(function(){
        $('#rqbtn').on('click', function(){
            document.getElementById("request").style.display = "inline";
            document.getElementById("initiate").style.display = "none";
            //document.getElementById("teacher").style.display = "none";
        });
    });

	$(document).ready(function(){
        $('select[name="school"]').on('change', function(){
            var school = $(this).val();

            if (school){
                $.ajax({
                    url: '/admin/staff-transfer/fetchStaffs/'+school,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                     $('select[name="stafff"]').empty();
                            $('select[name="stafff"]').prepend(
                            '<option value="">'+ "Please Select" +'</option>'
                            );
                         $.each(data, function(key, value){
                            $('select[name="stafff"]').append(
                                '<option value="'+value.id+'">'+ value.first_name + " " + value.middle_name + " "+ value.last_name +'</option>'
                                );
                         });
                    }
                });
             } else {
                $('select[name="stafff"]').empty();
             }
        });
    });

    $(document).ready(function(){
        $('select[name="zonee"]').on('change', function(){
             var zonee = $(this).val();
             
             if (zonee){
                $.ajax({
                    url: '/admin/lga/fetchLgas/'+zonee,
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
             var lgaa = $(this).val();

             if (lgaa){
                $.ajax({
                    url: '/admin/lga/fetchSchools/'+lgaa,
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
</script>
@endsection