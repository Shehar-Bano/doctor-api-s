<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feature = Feature::all();
        return response()->json([
            'message'=>'list of feature',
            'data'=>$feature
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $path = $request->file('hoverImg')->store('images', 'public');
        $path1 = $request->file('mainImg')->store('images', 'public');
        $feature = new Feature();
        $feature->hoverImg = $path;
        $feature->mainImg = $path1;
        $feature->title = $request->title;
        $feature->description = $request->description ;
        $feature->save();
        return response()->json([
            'message'=>'new Feature created',
            'data'=>$feature,

        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $feature =Feature::find($id);
        return response()->json([
            'message'=>'single post',
            'data'=>$feature,

        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $feature=Feature::find($id);
        $feature->title = $request->title;
        if($request->hoverImg){
            $path = $request->file('hoverImg')->store('images', 'public');
            $feature->hoverImg = $path;
        }
        if($request->mainImg){
            $path1 = $request->file('mainImg')->store('images', 'public');
            $feature->mainImg = $path1;
        }
        $feature->description = $request->description ;
        $feature->save();
        return response()->json([
            'message'=>'feature updated',
            'data'=>$feature,

        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $feature=Feature::find($id);
        return response()->json([
            'message'=>'feature deleted',
            'data'=>$feature->delete(),

        ], 200);
    }
}
