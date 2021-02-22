<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Models\Post;

class PostController extends Controller
{
    public function index() 
    {
     //  $posts = Post::get(); // this will return all posts in the natural database order
     // $post = Post::paginate(2); // This method takes the amount of arguments you give it 
                                   // so paginate(2) means to arguments per page

     return view('posts.index', [
            //'posts' => $posts
        ]); // so if you want to get all the posts you need to pass them in a array in the view
    }

    public function store(Request $request) 
    {
        $this->validate($request, [
            'body' => 'required',
        ]);
        
        $request->user()->posts()->create([
            'body'=> $request->body
        ]);

        return back();
    }

    public function destroy(Post $post, Request $request) 
    {
        $this->authorize('delete', $post);
        // delete is the method name we defined in our PostPolicy

        $post->delete();

        return back();
    }
}
