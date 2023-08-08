<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use URL;
use App;
use Auth;
use file;
use Session;
use Illuminate\Support\Facades\Response;
use DB;

class CategoryController extends Controller
{
    
    protected $validationRules = [
        'name' => 'required|string|unique:categories',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        return view('admin.category.listing',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
            $cat_icon = null;
            if($request->hasFile('icon'))
            {
                $file = $request->icon;
                $fileName = (preg_replace("/[^a-z0-9\_\-\.]/i", '', str_replace(' ', '_', $file->getClientOriginalName())));
                $ext = $file->getClientOriginalExtension();
                $completeFileName = time()."!".$fileName;
                $path = 'uploads/category/';
                $file->move(public_path($path), $completeFileName);
                $cat_icon = $path.$completeFileName;
            }

            $category = Category::create([
                'name'    => $request->name,
                'slug'    => $this->generateSlug($request->name),
                'status'     => $request->status,
                'user_id'     => Auth::user()->id,
                'icon'     => $cat_icon,
            ]);
            return redirect()->route('categories.index')->with('success','Category has been saved successfully.');
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
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
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
        $category = Category::find($id);

        $rules = [
            'name' => 'required|unique:categories,name,'.$category->id,
        ];

        $validation = Validator::make($request->all(), $rules);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors());
        }

        try{
            $cat_icon = $category->icon;
            if($request->hasFile('icon'))
            {
                $file = $request->icon;
                $fileName = (preg_replace("/[^a-z0-9\_\-\.]/i", '', str_replace(' ', '_', $file->getClientOriginalName())));
                $ext = $file->getClientOriginalExtension();
                $completeFileName = time()."!".$fileName;
                $path = 'uploads/category/';
                $file->move(public_path($path), $completeFileName);
                $cat_icon = $path.$completeFileName;
            }
            $category->name = $request->name;
            // $category->slug = $this->generateSlug($request->name);
            $category->status = $request->status;
            $category->icon = $cat_icon;
            $category->user_id = Auth::user()->id;
            $category->save();
            
            return redirect()->route('categories.index')->with('success','Category has been updated successfully.');
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
        Category::where('id', $id)->delete();
        return redirect()->route('categories.index')->with('success','Category has been deleted successfully.');
    }

    public function generateSlug($title)
    {
        $slug = preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "-", strtolower($title)));
        $count = Category::where('slug','LIKE',  '%' . $slug . '%')
                            ->get()
                            ->count();
        return ($count > 0) ? ($slug . '-' . $count) : $slug;
    }
}
