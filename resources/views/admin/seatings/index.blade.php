@extends('layouts.admin')
@section('content')
<section class="content">
	<div class="card">
		<div class="card-header">Seatings available by grade</div>
		<div class="card-body">
			<form method="POST" action="{{ route("admin.seatings.store") }}">
				@csrf
				<input type="hidden" name="school_id" value="{{ $school_id ?? '' }}">

				<div class="row">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Class / Seating available</th>
								@foreach($seatings as $ds_seatings)
								<th colspan="3" style="text-align:center">{{ $ds_seatings->ds_seating_title }}</th>
								@endforeach
								</tr>
						</thead>
						<tbody>
							@foreach($classes as $ds_class)
							<tr>
								<td>{{ $ds_class->dsClass[0]->title }}</td>
								@foreach($seatings as $ds_seatings)
								<td colspan="3" style="text-align:center">
									<input type="hidden" name="ids[]" value="{{ $ds_class->dsClass[0]->id }}-{{ $ds_seatings->id }}">
									<input type="hidden" name="id[]" value="{{ $data->where('ds_seating_id', $ds_class->dsClass[0]->id)->where('ds_class_id', $ds_seatings->id)->first()->id ?? '' }}">
									<input type="number" name="{{ $ds_class->dsClass[0]->id }}-{{ $ds_seatings->id }}" min="0" minlength="0" placeholder="{{ $ds_class->dsClass[0]->title }}" value="{{ $data->where('ds_seating_id', $ds_class->dsClass[0]->id)->where('ds_class_id', $ds_seatings->id)->first()->no_seats ?? '' }}">
								</td>
								@endforeach
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>

				<div class="form-group">
					<button class="btn btn-primary" type="submit">
						{{ trans('global.save') }}
					</button>
				</div>
			</form>
		</div>
	</div>
</section>
@endsection