<?php

namespace App\Http\Controllers;

use App\Models\AdditionalPricing;
use Illuminate\Http\Request;

class AdditionalPricingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $additional = AdditionalPricing::where('id', '1')->get();

        return view('admin.plans.additional',compact('additional'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdditionalPricing  $additionalPricing
     * @return \Illuminate\Http\Response
     */
    public function show(AdditionalPricing $additionalPricing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdditionalPricing  $additionalPricing
     * @return \Illuminate\Http\Response
     */
    public function edit(AdditionalPricing $additionalPricing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdditionalPricing  $additionalPricing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $category = AdditionalPricing::find('1');
        try{
            $category->per_listing_price = $request->per_listing_price;
            $category->additional_city_price = $request->additional_city_price;
            $category->save();
            
            return redirect()->route('plan.additional')->with('success','Category has been updated successfully.');
        }catch(\Throwable $e){
             return redirect()->back()->with("error",$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdditionalPricing  $additionalPricing
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdditionalPricing $additionalPricing)
    {
        //
    }
}
