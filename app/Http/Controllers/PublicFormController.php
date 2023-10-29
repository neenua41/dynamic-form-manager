<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormResponse;
use App\Models\Form;
use App\Models\FormField;

class PublicFormController extends Controller
{
    public function showForm(Form $form)
    {
        $forms = Form::all();
        return view('public.forms.list', compact('forms'));
    }
    public function storeResponse(Request $request, Form $form)
    { //todo validations
        foreach ($form->fields as $field) {
            $response = new FormResponse();
            $response->form_id = $form->id;
            $response->field_label = $field->label;
            $response->response = $request->input($field->label);
            $response->save();
        }

        return redirect()->route('public.forms.index')->with('success', 'Response submitted successfully');
    }
    public function show(Form $form)
    {
        return view('public.forms.show', compact('form'));
    }
}
