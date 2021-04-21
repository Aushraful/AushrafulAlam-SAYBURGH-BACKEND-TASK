<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class CommentController extends Controller
{
    public function __invoke(Request $request)
    {
        $rules = [];

        $rules['post_id']        = 'required';
        $rules['comment']        = 'required';

        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes())
        {
            $comment = Comment::create([
                'post_id'       => $request->post_id,
                'user_id'       => Auth::user()->id,
                'comment'   => $request->comment,
            ]);
    
            return response()->json([
                'message' => 'Commented successfully!',
                'comment'      => $comment,
            ], 201);
        }
    }

}
