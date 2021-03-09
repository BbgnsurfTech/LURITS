@extends('layouts.admin')
@section('content')
<section class="content">
	<div class="card">
		<div class="card-header">Staff Transfer Letter</div>
		<div class="card-body">
            <div class="row">
            	<div class="col-6">
            		<h4>Name: {{ $data["staff"]->first_name }} {{ $data["staff"]->middle_name ?? '' }} {{ $data["staff"]->last_name }}</h4>
            		<h4>Date: {{ Carbon\Carbon::parse($data->created_at)->format('Y/m/d') }} </h4>
            		<h4>Old School: {{ $data["currentSchool"]->name }} </h4>
            		<h4>New School: {{ $data["targetSchool"]->name }} </h4>
            	</div>
            </div>
		</div>
	</div>
</section>
@endsection
