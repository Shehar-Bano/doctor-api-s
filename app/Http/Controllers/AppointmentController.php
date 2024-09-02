<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointment = Appointment::all();
        return response()->json([
            'message'=>'list of Appointments',
            'data'=> $appointment
        ]);
    }
    public function store(Request $request)
{

        // Store hover and main images
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'dob' => 'required|date',
            'gender' => 'nullable|in:male,female,other',
            'phone_number' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
            'appointment_date' => 'required|date',
            'appointment_time' => 'nullable',
            'appointment_type' => 'required|string|max:255',
            'reason_for_appointment' => 'nullable|string|max:1000',
            'medical_conditions' => 'nullable|string|max:1000',
            'medications' => 'nullable|string|max:1000',
            'allergies' => 'nullable|string|max:1000',
        ]);

        // Store the appointment in the database
        $appointment = new Appointment();
        $appointment->first_name = $request->first_name;
        $appointment->last_name = $request->last_name;
        $appointment->dob = $request->dob;
        $appointment->gender = $request->gender;
        $appointment->phone_number = $request->phone_number;
        $appointment->email = $request->email;
        $appointment->appointment_date = $request->appointment_date;
        $appointment->appointment_time = $request->appointment_time;
        $appointment->appointment_type = $request->appointment_type;
        $appointment->reason_for_appointment = $request->reason_for_appointment;
        $appointment->medical_conditions = $request->medical_conditions;
        $appointment->medications = $request->medications;
        $appointment->allergies = $request->allergies;
        $appointment->save();

        // Return success response
        return response()->json([
            'message' => 'New Apointment created',
            'data' => $appointment,
        ], 201);


   }

    public function show(string $id)
    {
        $appointment =Appointment::find($id);
        return response()->json([
            'message'=>'single post',
            'data'=> $appointment ,

        ],200);
    }
    public function update(Request $request, string $id)
    {

        $appointment=Appointment::find($id);
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'dob' => 'required',
            'gender' => 'nullable|in:male,female,other',
            'phone_number' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
            'appointment_date' => 'required',
            'appointment_time' => 'nullable',
            'appointment_type' => 'required|string|max:255',
            'reason_for_appointment' => 'nullable|string|max:1000',
            'medical_conditions' => 'nullable|string|max:1000',
            'medications' => 'nullable|string|max:1000',
            'allergies' => 'nullable|string|max:1000',
        ]);

        // Store the appointment in the databas
        $appointment->first_name = $request->first_name;
        $appointment->last_name = $request->last_name;
        $appointment->dob = $request->dob;
        $appointment->gender = $request->gender;
        $appointment->phone_number = $request->phone_number;
        $appointment->email = $request->email;
        $appointment->appointment_date = $request->appointment_date;
        $appointment->appointment_time = $request->appointment_time;
        $appointment->appointment_type = $request->appointment_type;
        $appointment->reason_for_appointment = $request->reason_for_appointment;
        $appointment->medical_conditions = $request->medical_conditions;
        $appointment->medications = $request->medications;
        $appointment->allergies = $request->allergies;
        $appointment->save();

        return response()->json([
            'message'=>'member updated',
            'data'=>$appointment,

        ], 200);
    }
    public function destroy(string $id)
    {
        $appointment= Appointment::find($id);
        return response()->json([
            'message'=>'member deleted',
            'data'=>$appointment->delete(),

        ], 200);
    }
}
