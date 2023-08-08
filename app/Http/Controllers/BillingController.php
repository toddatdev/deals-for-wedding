<?php

namespace App\Http\Controllers;

use App\Models\AdditionalPricing;
use App\Models\Billing;
use App\Models\DynamicMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BillingController extends Controller
{
    protected $validationRules = [
        'name' => 'required|string|unique:billings',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = Billing::get();
        return view('admin.plans.listing',compact('discounts'));
    }

    public function pricing()
    {
        $additionalPricing  = AdditionalPricing::first();

        $dynamic_message = DynamicMessage::first();

        $discounts = Billing::where('status', '1')->orderBy('id')->get();

        return view('vendor.pricing',compact('discounts','additionalPricing','dynamic_message'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.plans.create');
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
            $discount = Billing::create([
                'name'    => $request->name,
                'description'    => $request->description,
                'price'    => $request->price,
                'plan_duration' => $request->plan_duration,
                'status'     => $request->status,
            ]);
            return redirect()->route('plan.index')->with('success','Category has been saved successfully.');
        }catch(\Throwable $e){
             return redirect()->back()->with("error",$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Billing  $billing
     * @return \Illuminate\Http\Response
     */
    public function show(Billing $billing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Billing  $billing
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Billing::find($id);
        return view('admin.plans.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Billing  $billing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $category = Billing::find($id);

        $rules = [
            'name' => 'required|unique:categories,name,'.$category->id,
        ];

        $validation = Validator::make($request->all(), $rules);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors());
        }

        try{
            $category->name = $request->name;
            $category->description = $request->description;
            // $category->slug = $this->generateSlug($request->name);
            $category->status = $request->status;
            $category->plan_duration = $request->plan_duration;
            $category->price = $request->price;
            $category->save();
            
            return redirect()->route('plan.index')->with('success','Category has been updated successfully.');
        }catch(\Throwable $e){
             return redirect()->back()->with("error",$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Billing  $billing
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Billing::where('id', $id)->delete();
        return redirect()->route('plan.index')->with('success','Category has been deleted successfully.');
    }
}
