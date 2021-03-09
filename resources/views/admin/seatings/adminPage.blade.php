@extends('layouts.admin')
@section('content')
<div class="card">
	<div class="card-header">Select School</div>
	<div class="card-body">
		<form action="{{ route("admin.textbooks.index") }}">
			@include('partials.filter.school')
			<div class="form-group">
				<button class="btn btn-primary" type="submit">
					Continue
				</button>
			</div>
		</form>
	</div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('js/filter.js') }}"></script>
@endsection