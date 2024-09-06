<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::get();
        return response()->json([
            'message'=>'list of category',
            'data'=>  $category
        ]);
    }
    public function store(Request $request)
{

        // Store the appointment in the database
        $category = new Category();
        $category->blog_category = $request->blog_category;
        $category->service_category =$request->service_category;
        $category->save();

        // Return success response
        return response()->json([
            'message' => 'New Category created',
            'data' => $category,
        ], 201);


   }

    public function show(string $id)
    {
        $category = Category::find($id);
        return response()->json([
            'message'=>'single post',
            'data'=> $category ,

        ],200);
    }
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'error' => 'Category not found.'
            ], 404);
        }
        $category->blog_category = $request->blog_category;
        $category->service_category =$request->service_category;
        $category->save();


        return response()->json([
            'message' => 'Category updated successfully.',
            'data' => $category,
        ], 200);
    }

    public function destroy(string $id)
    {
        $category= Category::find($id);
        return response()->json([
            'message'=>'category deleted',
            'data'=>$category->delete(),

        ], 200);
    }
}
