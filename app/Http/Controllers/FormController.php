<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Form;
use App\Models\Organization;
use Illuminate\Http\Request;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('form.index', [
            'forms' => Form::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('form.create', [
            'organizations' => Organization::select('id', 'name')->get(),
            'categories' => Category::select('id', 'name')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
       try {
         // Validate the form data
         $request->validate([
            'form.*.field_type' => 'required',
            'form.*.field_name' => 'required',
            'form.*.is_required' => 'required|in:true,false',
            'form.*.level_name' => 'required',
        ]);

        foreach ($request->form as $formData) {
            if (isset($formData['options']) && is_array($formData['options'])) {
                Form::create([
                    'organization_id' => $request->organization_id,
                    'category_id' => $request->category_id,
                    'field_type' => $formData['field_type'],
                    'field_name' => $formData['field_name'],
                    'is_required' => $formData['is_required'] == 'true' ? 1 : 0,
                    'level_name' => $formData['level_name'],
                    'options' => json_encode($formData['options']) 
                ]);
            } else {
                Form::create([
                    'organization_id' => $request->organization_id,
                    'category_id' => $request->category_id,
                    'field_type' => $formData['field_type'],
                    'field_name' => $formData['field_name'],
                    'is_required' => $formData['is_required'] == 'true' ? 1 : 0,
                    'level_name' => $formData['level_name'],
                ]);
            }
        }

        return redirect()->route('forms.index')->with('message', 'done');
       } catch (\Exception $exception) {
        dd($exception->getMessage());
       }
    }

    /**
     * Display the specified resource.
     */
    public function show(Form $form)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Form $form)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Form $form)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Form $form)
    {
        //
    }
}
