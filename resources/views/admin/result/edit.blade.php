@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ 'Result' }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.result.update", [$result->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
               <label>Date</label>
                <input name="date" id="date" value="{{ old('date', $result->date) }}" type="text" placeholder="yyyy/mm/dd" data-date-format="yyyy/mm/dd" class="form-control air-datepicker" data-position='bottom right' autocomplete="off">
                <i class="far fa-calendar-alt"></i>
            </div>
            <div class="form-group">
                <label for="student_id">{{ 'Student' }}</label>
                <select class="form-control select2 {{ $errors->has('student_id') ? 'is-invalid' : '' }}" name="student_id" id="student_id">
                    @foreach($studentAdmission as $student)
                        <option value="{{ $student->id }}" {{ ($student->student_id ? $student->student_id->id : old('student_id')) == $student->id ? 'selected' : '' }}>{{ $student->child_name }} {{ $student->middle_name }} {{ $student->last_name }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                
            </div>
            <div class="form-group">
                <label for="class_id">{{ 'Class' }}</label>
                <select class="form-control select2 {{ $errors->has('class_id') ? 'is-invalid' : '' }}" name="class_id" id="class_id">
                    @foreach($classroom as $class)
                        <option value="{{ $class->id }}" {{ ($class->class_id ? $class->class_id->id : old('class_id')) == $class->id ? 'selected' : '' }}>{{ $class->class }} {{ $class->arms }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                
            </div>
            <div class="form-group">
                <label for="subject">{{ 'Subject' }}</label>
                <select class="form-control select2 {{ $errors->has('subject') ? 'is-invalid' : '' }}" name="subject" id="subject">
                    @foreach($subject as $subject_id)
                        <option value="{{ $subject_id->id }}" {{ ($subject_id->subject ? $subject->subject->id : old('subject')) == $subject_id->id ? 'selected' : '' }}>{{ $subject_id->ds_subject_name }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                
            </div>

            <div class="form-group">
                <label for="first_ca">{{ 'First CA' }}</label>
                <input class="form-control {{ $errors->has('first_ca') ? 'is-invalid' : '' }}" type="text" name="first_ca" id="first_ca" value="{{ old('first_ca', $result->first_ca) }}">
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                
            </div>
            <div class="form-group">
                <label for="second_ca">{{ 'Second CA' }}</label>
                <input class="form-control {{ $errors->has('second_ca') ? 'is-invalid' : '' }}" type="text" name="second_ca" id="second_ca" value="{{ old('second_ca', $result->second_ca) }}">
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                
            </div>            
            <div class="form-group">
                <label for="exam">{{ 'Exam' }}</label>
                <input class="form-control {{ $errors->has('exam') ? 'is-invalid' : '' }}" type="text" name="exam" id="exam" value="{{ old('exam', $result->exam) }}">
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                
            </div>                    
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
