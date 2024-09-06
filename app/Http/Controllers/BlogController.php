<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blog = Blog::all();
        return response()->json([
            'message'=>'list of blog',
            'data'=>$blog
        ]);
    }
    public function store(Request $request)
{
    // Validate the request
    $request->validate([

        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'publication_date' => 'required',
        'title' => 'required|string|max:255',
        'description' => 'required',
    ]);

        $path = $request->file('image')->store('images', 'public');
        // Initialize Blog model
        $blog = new Blog();
        $blog->image = $path;
        $blog->title = $request->title;
        $blog->publication_date = $request->publication_date;
        $blog->description = json_encode($request->description);
        $blog->points= json_encode($request->points);
        $blog->tags = json_encode($request->tags);
        $blog->quote = $request->quote;
        $blog->author = $request->author;
        $blog->linked_url = $request->linked_url;
        $blog->facebook_url = $request->facebook_url;
        $blog->instagram_url = $request->instagram_url;
        $blog->pinterest_url = $request->pinterest_url;
        // Save the Blog model
        $blog->save();

        // Return success response
        return response()->json([
            'message' => 'New Blog created',
            'data' => $blog,
        ], 201);


   }

    public function show(string $id)
    {
        $blog =Blog::find($id);
        return response()->json([
            'message'=>'single Blog',
            'data'=>$blog,

        ],200);
    }
    public function update(Request $request, string $id)
    {
        $blog=Blog::find($id);
        $path = $request->file('image')->store('images', 'public');
        $blog->image = $path;
        $blog->title = $request->title;
        $blog->description = json_encode($request->description);
        $blog->points= json_encode($request->points);
        $blog->tags = json_encode($request->tags);
        $blog->quote = $request->quote;
        $blog->author = $request->author;
        $blog->linked_url = $request->linked_url;
        $blog->facebook_url = $request->facebook_url;
        $blog->instagram_url = $request->instagram_url;
        $blog->pinterest_url = $request->pinterest_url;
        // Save the Blog model
        $blog->save();
        return response()->json([
            'message'=>'blog updated',
            'data'=>$blog,

        ], 200);
    }
    public function destroy(string $id)
    {
        $blog=Blog::find($id);
        return response()->json([
            'message'=>'blog deleted',
            'data'=>$blog->delete(),

        ], 200);
    }
    public function comment($id){
        $comment = Comment::where('blog_id',$id)->count();
        return response()->json([
            'message'=>'Total comment',
            'data'=>$comment,

        ], 200);

       }

}
