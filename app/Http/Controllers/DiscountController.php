<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DiscountController extends Controller
{
    protected $validationRules = [
        'name' => 'required|string|unique:discounts',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = Discount::get();
        return view('admin.discount.listing',compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.discount.create');
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
            $discount = Discount::create([
                'name'    => $request->name,
                'description'    => $request->description,
                'value'    => $request->value,
                'expire_date' => $request->expire_date,
                'status'     => $request->status,
            ]);
            return redirect()->route('discount.index')->with('success','Category has been saved successfully.');
        }catch(\Throwable $e){
             return redirect()->back()->with("error",$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function show(Discount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Discount::find($id);
        return view('admin.discount.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $category = Discount::find($id);

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
            $category->expire_date = $request->expire_date;
            $category->value = $request->value;
            $category->save();
            
            return redirect()->route('discount.index')->with('success','Category has been updated successfully.');
        }catch(\Throwable $e){
             return redirect()->back()->with("error",$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Discount::where('id', $id)->delete();
        return redirect()->route('discount.index')->with('success','Category has been deleted successfully.');
    }
}
