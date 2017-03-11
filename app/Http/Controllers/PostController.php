<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use App\Category;
use Session;
use Purifier;
use Image;
use Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // create a variable
        $posts = Post::orderBy('id', 'desc')->paginate(5);

        //return a view
        return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $categories = Category::all();
       // $tags = Tag::all();
        return view('posts.create')->withCategories($categories);//->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

        //dd($request);
        // validate the data
        $this->validate($request, array(
            'title'         =>'required|max:255',
            'slug'          =>'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'category_id'   => 'required|integer',
            'body'          => 'required',
            'featured_image' => 'sometimes|image'
            ));
        // store in the database
        $post = new Post;

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
        $post->body = Purifier::clean($request->body);

        // save image
        if($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/'.$filename);
            Image::make($image)->resize(800, 400)->save($location);

            $post->image = $filename;
        }

        $post->save();

        //$post->tags()->sync($request->tags, false);

        Session::flash('success', 'Blog Saved Successfully.');
        // redirect to another page

        return redirect()->route('posts.show', $post->id);

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // find the post in the database

        $post = Post::find($id);
        $categories = Category::all();
        $cats = array();
        foreach( $categories as $category) {
            $cats[$category->id] = $category->name;
        }

        //return the view and pass in the var we previously created
        return view('posts.edit')->withPost($post)->withCategories($cats);
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
        // Validate the data
        $post = Post::find($id);
        //if($request->input('slug') == $post->slug) {

           // $this->validate($request, array(
            //'title' =>'required|max:255',
            //'category_id'   => 'required|integer',
            //'body' => 'required'
            //));
        //} else {
        $this->validate($request, array(
            'title' =>'required|max:255',
            'slug' =>"required|alpha_dash|min:5|max:255|unique:posts,slug, $id",
            'category_id'   => 'required|integer',
            'body' => 'required',
            'featured_image' => 'mimes:jpg,png|max:5000'
            ));
        //}

        // save the data

        $post = Post::find($id);

        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->category_id = $request->input('category_id');
        $post->body = Purifier::clean($request->input('body'));

        if($request->hasFile('featured_image')) {
            // add new photo
            $image = $request->file('featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/'.$filename);
            Image::make($image)->resize(800, 400)->save($location);
            $oldFilename = $post->image;

            // update the database           
            $post->image = $filename;

            // delete the old photo
            Storage::delete($oldFilename);

        }

        $post->save();

        // set flash data with success message
         Session::flash('success', 'Blog Updated Successfully.');
        // redirect to another page

        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        Storage::delete($post->image);
        $post->delete();
        Session::flash('success', 'Blog Deleted Successfully.');
        return redirect()->route('posts.index');
    }
}
