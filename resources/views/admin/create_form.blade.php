@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Dynamic Form</h1>

    <form method="post" action="{{ route('admin.store.form') }}">
        @csrf

        <div class="form-group">
            <label for="form_name">Form Name:</label>
            <input type="text" name="form_name" id="form_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="fields">Add Fields:</label>
            <button type="button" id="add-field" class="btn btn-primary">Add Field</button>
        </div>

        <div id="field-container" style="padding: 10px;">
        </div>

        <button type="submit" class="btn btn-primary">Create Form</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    var fieldCount = 0;

    $('#add-field').on('click', function() {
        fieldCount++;
        var newField = `
            <div class="form-field">
                <label for="field_label_${fieldCount}">Field Label:</label>
                <input type="text" name="fields[${fieldCount}][label]" id="field_label_${fieldCount}" class="form-control" required>

                <label for="field_type_${fieldCount}">Field Type:</label>
                <select name="fields[${fieldCount}][type]" id="field_type_${fieldCount}" class="form-control" required>
                    <option value="text">Text</option>
                    <option value="number">Number</option>
                    <option value="select">Select</option>
                </select>

                <label for="field_options_${fieldCount}">Options (for Select):</label>
                <input type="text" name="fields[${fieldCount}][options]" id="field_options_${fieldCount}" class="form-control" placeholder="Option 1, Option 2, Option 3">

                <button type="button" class="btn btn-danger remove-field">Remove Field</button>
            </div>
        `;

        $('#field-container').append(newField);
    });
    $('#field-container').on('click', '.remove-field', function() {
        $(this).closest('.form-field').remove();
    });
</script>
@endsection