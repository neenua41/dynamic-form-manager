@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <div class="mb-3">
        <a href="{{ route('admin.form.create') }}" class="btn btn-primary">Create New Form</a>
    </div>

    @if ($forms->isEmpty())
    <p>No forms available.</p>
    @else
    @foreach ($forms as $form)
    <div class="card mb-3">
        <div class="card-header">
            <h2>Form Name: {{ $form->name }}</h2>
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route('admin.form.edit', $form->id) }}" class="btn btn-primary">Edit Form</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('admin.form.destroy', $form->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this form?')">Delete Form</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if ($form->fields->isEmpty())
            <p>No fields available for this form.</p>
            @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Label</th>
                        <th>Type</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($form->fields as $field)
                    <tr>
                        <td>{{ $field->label }}</td>
                        <td>{{ $field->type }}</td>
                        <td>{{ $field->options }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>

    </div>
    @endforeach
    @endif
</div>

<style>
    .btn {
        margin-right: 10px;
    }

    .card {
        margin-bottom: 20px;
    }
</style>
@endsection