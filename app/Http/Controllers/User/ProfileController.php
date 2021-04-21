<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    public function __invoke(Request $request)
    {
        $user = $request->user();
        $posts = Post::where('created_by', $request->user()->id)->get();

        return response()->json([
            'user'      => $user,
            'posts'     => $posts,
        ], 200);
    }
}
