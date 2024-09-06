<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function index()
    {
        $contact = Contact::get();
        return response()->json([
            'message'=>'list of contact',
            'data'=>  $contact
        ]);
    }
    public function store(Request $request)
{

        // Store hover and main images
        $request->validate([
            'name' => 'required|string|max:255',
            'email'=>'required',
            'phone'=>'required',
            'subject'=>'required',
            'note'=>'required'
        ]);
        // Store the appointment in the database
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->phone = $request->phone;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->note = $request->note;
        $contact->save();

        // Return success response
        return response()->json([
            'message' => 'New Contact created',
            'data' => $contact,
        ], 201);


   }

    public function show(string $id)
    {
        $contact = Contact::find($id);
        return response()->json([
            'message'=>'single post',
            'data'=> $contact ,

        ],200);
    }
    public function update(Request $request, string $id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return response()->json([
                'error' => 'Contact not found.'
            ], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email'=>'required',
            'phone'=>'required',
            'subject'=>'required',
            'note'=>'required'
        ]);

        $contact->name = $request->name;
        $contact->phone = $request->phone;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->note = $request->note;
        $contact->save();
        return response()->json([
            'message' => 'Contact updated successfully.',
            'data' => $contact,
        ], 200);
    }

    public function destroy(string $id)
    {
        $contact= Contact::find($id);
        return response()->json([
            'message'=>'contact deleted',
            'data'=>$contact->delete(),

        ], 200);
    }
}
