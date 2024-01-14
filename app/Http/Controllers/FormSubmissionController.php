<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Form;
use App\Models\FormSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class FormSubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('formsubmission.category', [
            'categories' => Category::select('id', 'name')->get()
        ]);
    }

    /**
     * form submission 
     * @param integer cat_id
     */
    public function form($id) {
        return view('formsubmission.form', [
            'forms' => Form::where('category_id', $id)->get(),
            'categoryId' => $id,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $formData = $request->except('_token');
            FormSubmission::create([
                'category_id' => Arr::pull($formData, 'category_id'),
                'user_id' => Auth::user()->id,
                'form_data' => json_encode($formData)
            ]);
            return redirect()->back()->with('message', 'Form submitted.');
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(FormSubmission $formSubmission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FormSubmission $formSubmission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FormSubmission $formSubmission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FormSubmission $formSubmission)
    {
        //
    }
}
