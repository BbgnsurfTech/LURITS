@foreach($sections as $key => $value)
    @if($classschedule->section_id == $key)
        <option value="{{ $key }}" selected>{{ $value }}</option>
    @else
        <option value="{{ $key }}">{{ $value }}</option>
    @endif
@endforeach
