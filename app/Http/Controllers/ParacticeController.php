<?php

namespace App\Http\Controllers;

use App\Models\Paractice;
use Illuminate\Http\Request;

class ParacticeController extends Controller
{
    public function index()
    {

        $paractice = Paractice::all();
        return response()->json([
            'message'=>'list of paractice',
            'data'=>$paractice
        ]);
    }
    public function store(Request $request)
{
    // Validate the request
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        'first_name' => 'required',
        'last_name' => 'required',
        'phone' => 'required',
        'gender' => 'required',
        'country' => 'required|max:255',
        'email' => 'required',
        'password' => 'required',
    ]);

        // Store hover and main images
        $path = $request->file('image')->store('images', 'public');
        // Initialize Paractice model
        $paractice = new Paractice;
        $paractice->image = $path;
        $paractice->first_name = $request->first_name;
        $paractice->last_name = $request->last_name;
        $paractice->gender = $request->gender;
        $paractice->phone = $request->phone;
        $paractice->country = $request->country;
        $paractice->email = $request->email;
        $paractice->password = $request->password;

        // Save the Paractice model
        $paractice->save();

        // Return success response
        return response()->json([
            'message' => 'New Paractice created',
            'data' => $paractice,
        ], 201);

   }

    public function show(string $id)
    {
        $paractice =Paractice::find($id);
        return response()->json([
            'message'=>'single post',
            'data'=>$paractice,

        ],200);
    }
    public function update(Request $request, string $id)
    {
        $paractice=Paractice::find($id);
        $path = $request->file('image')->store('images', 'public');
        $paractice->image = $path;
        $paractice->first_name = $request->first_name;
        $paractice->last_name = $request->last_name;
        $paractice->gender = $request->gender;
        $paractice->phone = $request->phone;
        $paractice->country = $request->country;
        $paractice->email = $request->email;
        $paractice->password = $request->password;

        // Save the Paractice model
        $paractice->save();
        return response()->json([
            'message'=>'paractice updated',
            'data'=>$paractice,

        ], 200);
    }
    public function destroy(string $id)
    {
        $paractice=Paractice::find($id);
        return response()->json([
            'message'=>'paractice deleted',
            'data'=>$paractice->delete(),

        ], 200);
    }

}
