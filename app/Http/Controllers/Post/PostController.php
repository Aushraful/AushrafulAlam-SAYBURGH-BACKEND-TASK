<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{

    public function __construct() 
    {
        $this->middleware('auth:api', ['except' => ['index','show']]);
    }

    public function index()
    {
        return Post::all();
    }

    public function store(PostRequest $postRequest)
    {
        $tags = json_encode(explode(',', $postRequest->tags));
        // foreach(json_decode($tags) as $tag)
        // {
        //     dd($tag);
        // }
        
        $post = Post::create([
            'title'         => $postRequest->title,
            'slug'          => Str::slug($postRequest->title),
            'description'   => $postRequest->description,
            'image'         => $postRequest->image,
            'created_by'    => Auth::user()->id,
            'tags'          => $tags
        ]);

        return response()->json([
            'message' => 'Post created successfully!',
            'post'      => $post,
        ], 201);
    }

    public function show(Post $post)
    {
        return $post;
        // return new PostResource($post);
    }

    public function update(PostRequest $postRequest, Post $post)
    {
        if ($post->author->id != Auth::user()->id)
        {
            return response()->json([
                'message' => 'Forbidden! You do not have the permission to update this post.'
            ], 403);
        }

        $tags = json_encode(explode(',', $postRequest->tags));

        $post->update([
            'title'         => $postRequest->title,
            'slug'          => Str::slug($postRequest->title),
            'description'   => $postRequest->description,
            'image'         => $postRequest->image,
            'tags'          => $tags
        ]);

        return response()->json([
            'message' => 'Post Updated Successfully!',
            'post'      => $post,
        ], 200);
    }

    public function destroy(Post $post)
    {
        if (!$post->author == Auth::user())
        {
            abort(403);
        }

        $post->delete();

        return response()->json([
            'message' => 'Deleted Successfully!'
        ], 200);
    }
}
