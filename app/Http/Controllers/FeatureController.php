<?php

namespace App\Http\Controllers;

use App\Models\Advantage;
use App\Models\Feature;
use App\Models\Tip;
use App\Models\Work;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    public function index()
    {
        $feature = Feature::all();
        return response()->json([
            'message'=>'list of feature',
            'data'=>$feature
        ]);
    }
    public function store(Request $request)
{
    // Validate the request
    $request->validate([
        'hover_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'main_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'questions_answers' => 'required|array',
        'titles_work' => 'required|array',
        'point' => 'required|array',
        'advantage_descrip' => 'required|string',
        'title' => 'required|string|max:255',
        'description' => 'required|string',
    ]);

        // Store hover and main images
        $path = $request->file('hover_img')->store('images', 'public');
        $path1 = $request->file('main_img')->store('images', 'public');

        // Initialize Feature model
        $feature = new Feature();
        $feature->hover_img = $path;
        $feature->main_img = $path1;

        // Store additional images
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $images[] = $path;
            }
        }
        $feature->images = json_encode($images);

        // Store other fields
        $feature->questions_answers = json_encode($request->questions_answers);
        $feature->titles_work = json_encode($request->titles_work);
        $feature->point = json_encode($request->point);
        $feature->advantage_descrip = $request->advantage_descrip;
        $feature->title = $request->title;
        $feature->description = $request->description;

        // Save the Feature model
        $feature->save();

        // Return success response
        return response()->json([
            'message' => 'New Feature created',
            'data' => $feature,
        ], 201);


   }

    public function show(string $id)
    {
        $feature =Feature::find($id);
        return response()->json([
            'message'=>'single post',
            'data'=>$feature,

        ],200);
    }
    public function update(Request $request, string $id)
    {
        $feature=Feature::find($id);
        $path = $request->file('hover_img')->store('images', 'public');
        $path1 = $request->file('main_img')->store('images', 'public');
        $feature->hover_img = $path;
        $feature->main_img = $path1;

        // Store additional images
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $images[] = $path;
            }
        }
        $feature->images = json_encode($images);

        // Store other fields
        $feature->questions_answers = json_encode($request->questions_answers);
        $feature->titles_work = json_encode($request->titles_work);
        $feature->point = json_encode($request->point);
        $feature->advantage_descrip = $request->advantage_descrip;
        $feature->title = $request->title;
        $feature->description = $request->description;

        // Save the Feature model
        $feature->save();
        return response()->json([
            'message'=>'feature updated',
            'data'=>$feature,

        ], 200);
    }
    public function destroy(string $id)
    {
        $feature=Feature::find($id);
        return response()->json([
            'message'=>'feature deleted',
            'data'=>$feature->delete(),

        ], 200);
    }


}
