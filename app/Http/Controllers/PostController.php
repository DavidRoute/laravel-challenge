<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function list()
    {
        $posts = Post::withCount('likes')->latest('id')->paginate();

        return PostResource::collection($posts);        
    }
    
    public function toggleReaction(Request $request)
    {
        $request->validate([
            'post_id' => 'required|int|exists:posts,id',
            'like'   => 'required|boolean'
        ]);
        
        $post = Post::findOrFail($request->post_id);

        if ($post->author_id == auth()->id()) {
            return response()->json([
                'status'  => 422,
                'message' => 'You cannot like your post'
            ], 422);
        }
        
        $toggleLike = auth()->user()->likes()->toggle($post);

        $isLiked = !! count($toggleLike['attached']);

        return response()->json([
            'status' => 200,
            'message' => $isLiked ? 'You like this post successfully': 'You unlike this post successfully'
        ]);
    }
}
