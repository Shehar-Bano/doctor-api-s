<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comment = Comment::get();
        return response()->json([
            'message'=>'list of comment',
            'data'=>  $comment
        ]);
    }
    public function store(Request $request)
{
        // Store hover and main images
        $request->validate([
            'name' => 'required|string|max:255',
            'email'=>'required',
            'comment'=>'required|max:500'
        ]);

        // Store the appointment in the database
        $comment = new Comment();
        $comment->blog_id = $request->blog_id;
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->comment = $request->comment;
        $comment->save();

        // Return success response
        return response()->json([
            'message' => 'New Comment created',
            'data' => $comment,
        ], 201);


   }

    public function show(string $id)
    {
        $comment = Comment::find($id);
        return response()->json([
            'message'=>'single post',
            'data'=> $comment ,

        ],200);
    }
    public function update(Request $request, string $id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json([
                'error' => 'Comment not found.'
            ], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
              'email'=>'required',
            'comment'=>'required|max:500'
        ]);
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->comment = $request->comment;
        $comment->save();



        return response()->json([
            'message' => 'Comment updated successfully.',
            'data' => $comment,
        ], 200);
    }

    public function destroy(string $id)
    {
        $comment= Comment::find($id);
        return response()->json([
            'message'=>'comment deleted',
            'data'=>$comment->delete(),

        ], 200);
    }

}
