<?php

namespace App\Http\Controllers;

use App\Models\Advice;
use App\Models\Member;
use App\Models\Feature;
use Illuminate\Http\Request;

class AdviceController extends Controller
{
    public function index()
    {
        $advice = Advice::all();
        return response()->json([
            'message'=>'list of Advice',
            'data'=> $advice
        ]);
    }
    public function selectoption()
    {
        $features = Feature::with('category')->get();
        $result = [];

        foreach ($features as $feature) {
            $categoryName = $feature->category->name;

            // Initialize the category if it doesn't exist in the result array
            if (!isset($result[$categoryName])) {
                $result[$categoryName] = [
                    'category' => $categoryName,
                    'sub_categories' => []
                ];
            }

            // Add the subcategory to the corresponding category
            $result[$categoryName]['sub_categories'][] = [
                'id' => $feature->id,
                'name' => $feature->title,
            ];
        }

        // Convert the associative array to a simple array
        $result = array_values($result);

        return response()->json($result);
    }


    public function store(Request $request)
{
        // Store hover and main images
        $request->validate([
            'member_id'=>'required',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'type_of_care' => 'nullable|string|max:1000',
        ]);

        // Store the appointment in the database
        $advice = new Advice();
        $advice->member_id = $advice->member_id;
        $advice->name = $request->name;
        $advice->email = $request->email;
        $advice->type_of_care = $request->type_of_care;
        $advice->save();

        // Return success response
        return response()->json([
            'message' => 'New Advice created',
            'data' => $advice,
        ], 201);


   }

    public function show(string $id)
    {
        $advice = Advice::find($id);
        return response()->json([
            'message'=>'single post',
            'data'=> $advice ,

        ],200);
    }
    public function update(Request $request, string $id)
    {
        $advice = Advice::find($id);

        if (!$advice) {
            return response()->json([
                'error' => 'Advice not found.'
            ], 404);
        }

        $request->validate([
            'member_id'=>'required',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'type_of_care' => 'nullable|string|max:1000',
        ]);



        // Update the advice with validated data
        $advice->name = $request->name;
        $advice->email = $request->email;
        $advice->type_of_care = $request->type_of_care;
        $advice->save();


        return response()->json([
            'message' => 'Appointment updated successfully.',
            'data' => $advice,
        ], 200);
    }

    public function destroy(string $id)
    {
        $advice= Advice::find($id);
        return response()->json([
            'message'=>'advice deleted',
            'data'=>$advice->delete(),

        ], 200);
    }
}
