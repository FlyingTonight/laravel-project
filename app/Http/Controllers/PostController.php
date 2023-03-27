<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\Tag;
use App\Policies\PostPolicy;
use App\Models\Category;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth')->except(['index','show']);
        $this->authorizeResource(Post::class, 'post');
    }

    public function index()
    {
        $posts = Post::latest()->paginate(9);
        return view('posts.index')->with('posts', $posts);
    }


    public function create()
    {
        return view('posts.create')->with([
            'categories'=>Category::all(),
            'tags'=>Tag::all(),
        ]);
    }


    public function store(StorePostRequest $request)
    {
       if($request->hasFile('photo')){
       $name =$request->file('photo')->getClientOriginalName();
       $path = $request->file('photo')->storeAs('post-photos',$name);
        }

        $posts = Post::create([
            'user_id' => auth()->user()->id,
            'category_id' =>$request->category_id,
            'title' => $request->title,
            'short_content' => $request->short_content,
            'content'=>$request->content,
            'photo' => $path ?? null,
        ]);

        if(isset($request->tags)){
            foreach($request->tags as $tag){
                $posts->tags()->attach($tag);
            }
        }
        return redirect()->route('posts.index');
    }


    public function show(Post $post)
    {
        return view('posts.show')->with([
            'post'=>$post,
            'recent_posts'=> Post::latest()->get()->except($post->id)->take(5),
            'tags'=> Tag::all(),
            'categories'=> Category::all(),

        ]);

    }


    public function edit(Post $post)
    {


        return view('posts.edit')->with(['post'=> $post]);
    }


    public function update(StorePostRequest $request, post $post)
    {
       
        if($request->hasFile('photo')){
            if(isset($post->photo)){
                Storage::delete($post->photo);
            }
            $name =$request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('post-photos',$name);
             }
        $post->update([

        'title'=> $request->title,
        'short_content'=> $request->short_content,
        'content'=> $request->content,
        'photo' => $path ?? $post->photo,
        ]);
        return redirect()->route('posts.show',['post'=>$post->id]);


    }



    public function destroy(Post $post)
    {

            if(isset($post->photo)){
                Storage::delete($post->photo);
            }
        $post->delete();

        return redirect()->route('posts.index');
    }
}
