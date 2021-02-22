<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{
    public function _construct() 
    {
        $this->middleware(['auth']);
    } // as an unauthneticated user you can't like posts now

    public function store(Post $post, Request $request) 
    {
        if ($post->likedBy($request->user())) {
        return response('you liked this already');
        }

        $post->likes()->create([
            'user_id' => $request->user()->id,
        ]);

        return back();
    }

    public function destroy(Post $post, Request $request)
    {
        $request->user()->likes()->where('post_id', $post->id)->delete(); 
        // this will return the user 
        // then the likes of that user and then the post with that id 
        // then it will delete that post with that id

        return back();
    }
}
