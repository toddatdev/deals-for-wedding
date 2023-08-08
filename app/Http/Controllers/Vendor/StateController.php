<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;
use Illuminate\Support\Facades\Validator;
use URL;
use App;
use Auth;
use file;
use Session;
use Illuminate\Support\Facades\Response;
use DB;

class StateController extends Controller
{
    protected $validationRules = [
        'name' => 'required|string|unique:states',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = State::where('user_id',Auth::user()->id)->get();
        return view('vendor.state.listing',compact('states'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendor.state.create');
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

            $state = State::create([
                'name'    => $request->name,
                'code'     => $request->code,
                'user_id'     => Auth::user()->id,
                'status'     => $request->status,
            ]);
            return redirect()->route('vendor.states.index')->with('success','State has been saved successfully.');
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
        $state = State::find($id);
        return view('vendor.state.edit', compact('state'));
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
        $state = State::find($id);
        try{
           
            $state->name = $request->name;
            $state->status = $request->status;
            $state->code = $request->code;
            $state->user_id = Auth::user()->id;
            $state->save();
            
            return redirect()->route('vendor.states.index')->with('success','State has been updated successfully.');
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
        State::where('id', $id)->delete();
        return redirect()->route('vendor.states.index')->with('success','State has been deleted successfully.');
    }
}
