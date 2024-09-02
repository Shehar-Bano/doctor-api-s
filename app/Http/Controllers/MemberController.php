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

        // Store hover and main images
        $path = $request->file('image')->store('images', 'public');
        // Initialize Feature model
        $member = new Member();
        $member->name = $request->name;
        $member->title = $request->title;
        $member->image = $path;
        $member->introduction = $request->introduction;
        $member->qualification = json_encode($request->qualification);
        $member->personal_care= json_encode($request->personal_care);
        $member->life_style_support= json_encode($request->life_style_support);
        $member->skills = $request->skills;
        $member->linkedin_url = $request->linkedin_url;
        $member->instagram_url = $request->instagram_url;
        $member->twitter_url = $request->twitter_url;
        $member->care= $request->care;

        // Save the Feature model
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
        $path = $request->file('image')->store('images', 'public');
        $member=Member::find($id);
        $member->name = $request->name;
        $member->title = $request->title;
        $member->image = $path;
        $member->introduction = $request->introduction;
        $member->qualification = json_encode($request->qualification);
        $member->personal_care= json_encode($request->personal_care);
        $member->life_style_support= json_encode($request->life_style_support);
        $member->skills = $request->skills;
        $member->linkedin_url = $request->linkedin_url;
        $member->instagram_url = $request->instagram_url;
        $member->twitter_url = $request->twitter_url;

        $member->care= $request->care;

        // Save the Feature model
        $member->save();
        return response()->json([
            'message'=>'member updated',
            'data'=>$member,

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
