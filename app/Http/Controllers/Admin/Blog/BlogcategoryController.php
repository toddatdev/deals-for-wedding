<?php

namespace App\Http\Controllers\Admin\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Blog\Category;
use App\Blog\Post;
use DB;
use Session;

class BlogcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        return view('admin.blog.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
		
		$request->validate([
		  'name' => 'required|unique:blog_categories,name',
		]);
		Category::create([
			'name'    => $request->name,
			'slug'    => $this->generateSlug($request->name),
			'status'  => 1,
		]);
		return redirect('admin/blog-category')->with('success','Blog Category has been saved successfully.');
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
        $category = Category::findOrFail($id);
        return view('admin.blog.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
		$category = array(
			'name' 		  => isset($request->name) ? $request->name : null,
			'status'	  => 1,
		);
		
    	try{
			
			Category::where('id', $request->blog_category_id)->update($category);
			return redirect('admin/blog-category')->with('success','Blog Category has been updated successfully.');
			
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
    public function destroy($id) {
		$deletedId =  Category::destroy($id);
        if($deletedId){
			return redirect('admin/blog-category')->with('success','Blog  Category has been deleted successfully.');
        }else{
            return back()->withError('Something wrong happend!')->withInput(); 
        } 
    }


        /**
     * @param $title
     * @param int $id
     * @return string
     * @throws \Exception
     */
    public function generateSlug($title)
    {
        $slug = preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "-", strtolower($title)));
        $count = Category::where('slug','LIKE',  '%' . $slug . '%')
                            ->get()
                            ->count();
        return ($count > 0) ? ($slug . '-' . $count) : $slug;
    }

    protected function getRelatedSlugs($slug, $id = 0)
    {
        return Category::select('slug')->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();
    }
}
