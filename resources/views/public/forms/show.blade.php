@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Form: {{ $form->name }}</h1>

    <form method="post" action="{{ route('public.forms.storeResponse', $form->id) }}">
        @csrf
        @foreach ($form->fields as $field)
        <div class="form-group">
            <label for="{{ $field->label }}">{{ $field->label }}</label>
            @if (strtolower($field->type) === 'text')
            <input type="text" name="{{ $field->label }}" class="form-control">
            @elseif (strtolower($field->type) === 'number')
            <input type="number" name="{{ $field->label }}" class="form-control">
            @elseif (strtolower($field->type) === 'select')
            <select name="{{ $field->label }}" class="form-control">
                @if (!empty($field->options))
                @foreach (explode(',', $field->options) as $option)
                <option value="{{ $option }}">{{ $option }}</option>
                @endforeach
                @endif
            </select>
            @endif
        </div>
        @endforeach
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection