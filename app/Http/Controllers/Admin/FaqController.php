<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use Illuminate\Support\Facades\Validator;
use URL;
use App;
use Auth;
use file;
use Session;
use Illuminate\Support\Facades\Response;
use DB;

class FaqController extends Controller
{
    protected $validationRules = [
        'question' => 'required',
        'answer' => 'required',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = Faq::get();
        return view('admin.faqs.listing',compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.faqs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), $this->validationRules);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors());
        }
        try{

            $faq = Faq::create([
                'question'    => $request->question,
                'answer'     => $request->answer,
                'category'     => $request->category,
                'status'     => $request->status,
            ]);
            return redirect()->route('faqs.index')->with('success','Faq has been saved successfully.');
        }catch(\Throwable $e){
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
        $faq = Faq::find($id);
        return view('admin.faqs.edit', compact('faq'));
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
        $faq = Faq::find($id);
        try{
           
            $faq->question = $request->question;
            $faq->answer = $request->answer;
            $faq->category = $request->category;
            $faq->status = $request->status;
            $faq->save();
            
            return redirect()->route('faqs.index')->with('success','Faq has been updated successfully.');
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
        Faq::where('id', $id)->delete();
        return redirect()->route('faqs.index')->with('success','Faq has been deleted successfully.');
    }
}
