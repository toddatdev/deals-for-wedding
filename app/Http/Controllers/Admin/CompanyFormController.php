<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyForm;
use Validator;
use Auth;

class CompanyFormController extends Controller
{
    protected $validationRules = [
        'input_label' => 'required',
        'input_name' => 'required|unique:company_form_fields',
        'input_type' => 'required',
        'status' => 'required',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = CompanyForm::get();
        return view('admin.company_form.listing',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.company_form.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validation = Validator::make($request->all(), $this->validationRules);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors());
        }
        try{

            $field = CompanyForm::create([
                'input_label'    => $request->input_label,
                'input_name'     => preg_replace("/[^a-z0-9\_\-\.]/i", '',str_replace(' ', '_', strtolower(trim($request->input_name)))),
                'input_type'     => $request->input_type,
                'input_note'     => $request->input_note,
                'status'     => $request->status,
                'data_type'     => $request->data_type,
                'user_id'     => Auth::user()->id,
            ]);
            return redirect()->route('company_form.index')->with('success','Field has been saved successfully.');
        }catch(\Throwable $e){
            // dd($e->getMessage());
             return redirect()->back()->with("error",$e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = CompanyForm::find($id);
        return view('admin.company_form.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $field = CompanyForm::find($id);
         $rules = [
            'input_label' => 'required',
            'input_name' => 'required|unique:company_form_fields,input_name,'.$field->id,
            'input_type' => 'required',
            'status' => 'required',
        ];

        $validation = Validator::make($request->all(), $rules);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors());
        }

        try{
           
            $field->input_label = $request->input_label;
            $field->input_name = preg_replace("/[^a-z0-9\_\-\.]/i", '', str_replace(' ', '_', strtolower(trim($request->input_name))));
            $field->input_type = $request->input_type;
            $field->input_note = $request->input_note;
            $field->status = $request->status;
            $field->data_type = $request->data_type;
            $field->save();
            
            return redirect()->route('company_form.index')->with('success','Field has been updated successfully.');
        }catch(\Throwable $e){
             return redirect()->back()->with("error",$e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CompanyForm::where('id', $id)->delete();
        return redirect()->route('company_form.index')->with('success','Field has been deleted successfully.');
    }
}
