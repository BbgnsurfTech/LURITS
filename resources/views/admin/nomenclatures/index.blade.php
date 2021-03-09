@extends('layouts.admin')
@section('content')
<div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
            <h3>{{'View nomenclature type of'}} </h3>
            </div>
        </div>

    
        <form class="new-added-form" method="POST" action="#" enctype="multipart/form-data">
            @csrf
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label class="required">Table</label>
                <select class="form-control {{ $errors->has('table') ? 'is-invalid' : '' }}" name="parameter_table" id="parameter_table" required onchange="changeRoute()">
                    <option value disabled {{ old('table', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                   @foreach($tables as $table)
                   <option value="{{ $table }}" {{ old('table', '--') === $table ? 'selected' : '' }}>{{ $table }}</option>
                    @endforeach 
                </select>
            </div>
        </div>
        </form>
    </div>
</div>

               

                
           
@endsection
@section('scripts')
<script type="text/javascript">
    function changeRoute(){
      // bind change event to select

          var table_i = document.getElementById("parameter_table").value; // get selected value
          var table_f = table_i.replace(/ds_/gi, "");; // replace first 3 character of selected value
          if (table_f) { // require a URL
              window.location = table_f; // redirect
          }
          return false;
      
    };
</script>
@parent

@endsection