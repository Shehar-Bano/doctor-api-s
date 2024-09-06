<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $member = Member::all();
        return response()->json([
            'message'=>'list of members',
            'data'=>$member
        ]);
    }
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file type and size
            'introduction' => 'nullable|string|max:1000',
            'qualification' => 'nullable|array',
            'qualification.*' => 'nullable|string|max:255',
            'personal_care' => 'nullable|array',
            'personal_care.*' => 'nullable|string|max:255',
            'life_style_support' => 'nullable|array',
            'life_style_support.*' => 'nullable|string|max:255',
            'skills' => 'nullable|string|max:1000',
            'linkedin_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'care' => 'nullable|string|max:1000',
        ]);

        // Store hover and main images
        $path = $request->file('image')->store('images', 'public');

        // Initialize Member model
        $member = new Member();
        $member->name = $request->name;
        $member->title = $request->title;
        $member->image = $path;
        $member->introduction = $request->introduction;
        $member->qualification = json_encode($request->qualification);
        $member->personal_care = json_encode($request->personal_care);
        $member->life_style_support = json_encode($request->life_style_support);
        $member->skills = $request->skills;
        $member->linkedin_url = $request->linkedin_url;
        $member->instagram_url = $request->instagram_url;
        $member->twitter_url = $request->twitter_url;
        $member->care = $request->care;

        // Save the Member model
        $member->save();

        // Return success response
        return response()->json([
            'message' => 'New Member created',
            'data' => $member,
        ], 201);
    }


    public function show(string $id)
    {
        $member =Member::find($id);
        return response()->json([
            'message'=>'single post',
            'data'=>$member,

        ],200);
    }
    public function update(Request $request, string $id)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file type and size
            'introduction' => 'nullable|string|max:1000',
            'qualification' => 'nullable|array',
            'qualification.*' => 'nullable|string|max:255',
            'personal_care' => 'nullable|array',
            'personal_care.*' => 'nullable|string|max:255',
            'life_style_support' => 'nullable|array',
            'life_style_support.*' => 'nullable|string|max:255',
            'skills' => 'nullable|string|max:1000',
            'linkedin_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'care' => 'nullable|string|max:1000',
        ]);

        // Find the member by ID
        $member = Member::find($id);

        // Check if a new image is uploaded
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $member->image = $path;
        }

        // Update the member's details
        $member->name = $request->name;
        $member->title = $request->title;
        $member->introduction = $request->introduction;
        $member->qualification = json_encode($request->qualification);
        $member->personal_care = json_encode($request->personal_care);
        $member->life_style_support = json_encode($request->life_style_support);
        $member->skills = $request->skills;
        $member->linkedin_url = $request->linkedin_url;
        $member->instagram_url = $request->instagram_url;
        $member->twitter_url = $request->twitter_url;
        $member->care = $request->care;

        // Save the updated member model
        $member->save();

        // Return a success response
        return response()->json([
            'message' => 'Member updated',
            'data' => $member,
        ], 200);
    }

    public function destroy(string $id)
    {
        $member=member::find($id);
        return response()->json([
            'message'=>'member deleted',
            'data'=>$member->delete(),

        ], 200);
    }

}
