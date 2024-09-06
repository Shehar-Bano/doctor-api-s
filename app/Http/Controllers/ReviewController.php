<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

    public function index()
    {
        $review = Review::get();
        return response()->json([
            'message'=>'list of review',
            'data'=>  $review
        ]);
    }
    public function store(Request $request)
{

        // Store hover and main images
        $request->validate([
            'title' => 'required|string|max:255',
            'rating'=>'required',
            'content'=>'required',
        ]);

        // Store the appointment in the database
        $review = new Review();

        $review->title = $request->title;
        $review->content = $request->content;
        $review->rating = $request->rating;
        $review->save();

        // Return success response
        return response()->json([
            'message' => 'New Review created',
            'data' => $review,
        ], 201);


   }

    public function show(string $id)
    {
        $review = Review::find($id);
        return response()->json([
            'message'=>'single post',
            'data'=> $review ,

        ],200);
    }
    public function update(Request $request, string $id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json([
                'error' => 'Review not found.'
            ], 404);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'rating'=>'required',
            'content'=>'required',
        ]);

        $review->title = $request->title;
        $review->content = $request->content;
        $review->rating = $request->rating;
        $review->save();


        return response()->json([
            'message' => 'Review updated successfully.',
            'data' => $review,
        ], 200);
    }

    public function destroy(string $id)
    {
        $review= Review::find($id);
        return response()->json([
            'message'=>'review deleted',
            'data'=>$review->delete(),

        ], 200);
    }
}
