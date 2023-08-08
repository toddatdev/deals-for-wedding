<?php

namespace App\Http\Controllers\Admin\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Blog\Category;
use App\Blog\Post;
use App\Blog\Comments;
use DB;
use Session;
use File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('category')->get();
        return view('admin.blog.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status',1)->get();
        return view('admin.blog.post.create',compact('categories'));
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
		  'title' => 'required|unique:blog_posts,title',
		]);
		
        if($request->hasFile('image')) {
			
            $file     = $request->image;
            $fileName = (preg_replace("/[^a-z0-9\_\-\.]/i", '', str_replace(' ', '_', $file->getClientOriginalName())));
            $ext      = $file->getClientOriginalExtension();
			
            $completeFileName = time()."!".$fileName;
			
            $path  = 'uploads/posts/';
            $file->move(public_path($path), $completeFileName);
            $imgPath = "posts/".$completeFileName;
        }
		
		Post::create([
			'title'       => $request->title,
			'category_id' => $request->category_id,
			'slug'        => $this->generateSlug($request->title),
			'image'       => $imgPath,
			'description' => $request->description,
			'status'      => 1,
		]);
		return redirect('admin/blog')->with('success','You have successfully added.');
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
         $post = Post::with('category')->findOrFail($id);
         $categories = Category::where('status',1)->get();
         return view('admin.blog.post.edit',compact('post','categories'));
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
        $post = array(
			'title'         => isset($request->title) ? $request->title : null,
			'category_id'   => isset($request->category_id) ? $request->category_id : null,
			'description'   => isset($request->description) ? $request->description : null,
			'status'        => isset($request->status) ? $request->status : 1,
			'slug'          => $this->generateSlug($request->title),
		);
        if($request->hasFile('image'))
        {
            $file = $request->image;
            $fileName = (preg_replace("/[^a-z0-9\_\-\.]/i", '', str_replace(' ', '_', $file->getClientOriginalName())));
            $ext = $file->getClientOriginalExtension();
            $completeFileName = time()."!".$fileName;
            $path = 'uploads/posts/';
            $file->move(public_path($path), $completeFileName);
            $post['image'] = "posts/".$completeFileName;
        }
    	try{
			Post::where('id', $request->post_id)->update($post);
			return redirect('admin/blog')->with('success','You have successfully updated.');
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
		$deletedId =  Post::destroy($id);
        if($deletedId){
			return redirect('admin/blog')->with('success','You have successfully deleted.');
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
    public function createSlug($title, $id = 0)
    {
        // Normalize the title
        $slug = str_slug($title);

        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        
        // If we haven't used it before then we are all good.
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }

        // Just append numbers like a savage until we find not used.
        $i = 1;
        $is_contain = true;
        do {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('slug', $newSlug)) {
                $is_contain = false;
                return $newSlug;
            }
            $i++;
        } while ($is_contain);

        throw new \Exception('Can not create a unique slug');
    }

    protected function getRelatedSlugs($slug, $id = 0)
    {
        return Post::select('slug')->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();
    }

    public function view_comments($id)
    {
        $comments = Comments::where('post_id', $id)->orderBy('created_at','DESC')->get();
        return view('admin.blog.post.comments',compact('comments'));    
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
