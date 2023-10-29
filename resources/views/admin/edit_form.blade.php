@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Form</h1>

    @if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.form.update', $form->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Form Name:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $form->name) }}" class="form-control">
        </div>

        <div id="form-fields">
            <!-- Loop through the form fields for editing -->
            @foreach ($form->fields as $field)
            <div class="form-field">
                <div class="form-group">
                    <label for="field_label">Field Label:</label>
                    <input type="text" name="field_label[]" value="{{ old('field_label', $field->label) }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="field_type">Field Type:</label>
                    <select name="field_type[]" class="form-control">
                        <option value="Text" {{ old('field_type', $field->type) === 'Text' ? 'selected' : '' }}>Text</option>
                        <option value="Number" {{ old('field_type', $field->type) === 'Number' ? 'selected' : '' }}>Number</option>
                        <option value="Select" {{ old('field_type', $field->type) === 'Select' ? 'selected' : '' }}>Select</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="field_options">Field Options:</label>
                    <input type="text" name="field_options[]" value="{{ old('field_options', $field->options) }}" class="form-control">
                </div>
                <button type="button" class="btn btn-danger remove-field">Remove Field</button>
            </div>
            @endforeach
        </div>

        <div class="form-group">
            <button type="button" class="btn btn-success add-field">Add Field</button>
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>

<style>
    .form-field {
        border: 1px solid #ccc;
        padding: 15px;
        margin: 10px 0;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // JavaScript to add and remove form fields
    $(document).ready(function() {
        $(".add-field").click(function() {
            var formField = $(".form-field:first").clone();
            formField.find("input").val("");
            $("#form-fields").append(formField);
        });

        $(document).on('click', '.remove-field', function() {
            if ($('.form-field').length > 1) {
                $(this).closest('.form-field').remove();
            }
        });
    });
</script>
@endsection