@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <h1>Public Forms</h1>
    @if ($forms->isEmpty())
    <p>No forms available.</p>
    @else
    <ul>
        @foreach ($forms as $form)
        <li>
            <a href="{{ route('public.forms.show', $form->id) }}">{{ $form->name }}</a>
        </li>
        @endforeach
    </ul>
    @endif
</div>
@endsection