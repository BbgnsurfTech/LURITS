@extends('layouts.admin')
@section('content')
<!-- Dashboard summery Start Here -->
                <div class="row gutters-20">
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required">Table</label>
                            <select class="form-control {{ $errors->has('table') ? 'is-invalid' : '' }}" name="parameter_table" id="parameter_table" required>
                                <option value disabled {{ old('table', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                               @foreach($tables as $table)
                               <option value="{{ $table }}" {{ old('table', '--') === $table ? 'selected' : '' }}>{{ $table }}</option>
                                @endforeach 
                            </select>
                    </div>
                </div>
<!-- Dashboard Content End Here -->
               

                
           
@endsection
@section('scripts')
<script type="text/javascript">
                </script>
@parent

@endsection