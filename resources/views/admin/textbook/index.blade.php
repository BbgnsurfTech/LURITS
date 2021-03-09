@extends('layouts.admin')
@section('content')
<section class="content">
	<div class="card">
		<div class="card-header">PUPIL/TEACHER BOOK</div>
		<div class="card-body">
			<form method="POST" action="{{ route("admin.textbooks.store") }}">
				@csrf
				<input type="hidden" name="school_id" value="{{ $school_id ?? '' }}">
				@foreach($user_textbook as $textbook)
				<div class="row">
					<div> <h1>{{ $textbook->title }}</h1> </div>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Subject Area</th>
								@foreach($classes as $class)
								<th colspan="3" style="text-align:center">{{ $class->dsClass[0]->title }}</th>
								@endforeach
								</tr>
						</thead>
						<tbody>
							@foreach($subjects as $subject)
							<tr>
								<td>{{ $subject->subjectName->ds_subject_title }}</td>
								@foreach($classes as $class)
								<td colspan="3" style="text-align:center">
									<input type="hidden" name="ids[]" value="{{ $textbook->id }}-{{ $subject->subjectName->id }}-{{ $class->dsClass[0]->id }}">
									<input type="hidden" name="id[]" value="{{ $data->where('ds_subjects_id', $subject->subjectName->id)->where('ds_class_id', $class->dsClass[0]->id)->where('ds_user_textbook_id', $textbook->id)->first()->id ?? '' }}">
									<input type="number" name="{{ $textbook->id }}-{{ $subject->subjectName->id }}-{{ $class->dsClass[0]->id }}" min="0" minlength="0" placeholder="{{ $subject->subjectName->ds_subject_title }}" value="{{ $data->where('ds_subjects_id', $subject->subjectName->id)->where('ds_class_id', $class->dsClass[0]->id)->where('ds_user_textbook_id', $textbook->id)->first()->number_textbooks ?? '' }}">
								</td>
								@endforeach
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				@endforeach
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