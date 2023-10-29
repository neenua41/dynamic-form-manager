<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\FormField;
use Illuminate\Validation\Rule;
use App\Jobs\FormCreatedNotification;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    public function index()
    {
        $forms = Form::with('fields')->get();

        return view('admin.index', compact('forms'));
    }
    public function create()
    {
        return view('admin.create_form');
    }

    public function storeForm(Request $request)
    {
        $request->validate([
            'form_name' => 'required|string|max:255',
            'fields' => 'required|array',
            'fields.*.label' => 'required|string|max:255',
            'fields.*.type' => [
                'required',
                Rule::in(['text', 'number', 'select']),
            ],
            'fields.*.options' => 'nullable|string',
        ]);
        $form = Form::create([
            'name' => $request->input('form_name'),
        ]);
        foreach ($request->input('fields') as $fieldData) {
            FormField::create([
                'form_id' => $form->id,
                'label' => $fieldData['label'],
                'type' => $fieldData['type'],
                'options' => $fieldData['options'],
            ]);
        }
        //send mail via job
        $email = 'adminuser@gmail.com';
        dispatch(new FormCreatedNotification($email));
        return redirect()->route('admin.index')
            ->with('success', 'Form created successfully');
    }

    public function edit($id)
    {
        $form = Form::find($id);

        if (!$form) {
            return redirect()->route('admin.forms.index')->with('error', 'Form not found');
        }
        return view('admin.edit_form', compact('form'));
    }

    public function update(Request $request, Form $form)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'field_label.*' => 'required|string|max:255',
            'field_type.*' => 'required|in:Text,Number,Select',
            'field_options.*' => 'nullable|string',
        ]);
        $form->update([
            'name' => $request->input('name'),
        ]);

        $fieldLabels = $request->input('field_label');
        $fieldTypes = $request->input('field_type');
        $fieldOptions = $request->input('field_options');

        foreach ($fieldLabels as $key => $fieldLabel) {
            $field = FormField::updateOrCreate(
                ['form_id' => $form->id, 'label' => $fieldLabel],
                [
                    'type' => $fieldTypes[$key],
                    'options' => $fieldOptions[$key],
                ]
            );
        }

        $form->fields()->whereNotIn('label', $fieldLabels)->delete();

        return redirect()->route('admin.index')->with('success', 'Form updated successfully');
    }

    public function destroy(Form $form)
    {
        $form->fields()->delete();
        $form->delete();

        return redirect()->route('admin.index')->with('success', 'Form deleted successfully');
    }
    public function show($id)
    {
    }
}
