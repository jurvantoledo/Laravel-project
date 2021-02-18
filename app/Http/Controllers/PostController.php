<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Models\Post;

class PostController extends Controller
{
    public function index() 
    {
        return view('posts.index');
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
}
