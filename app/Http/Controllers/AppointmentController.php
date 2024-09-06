<?php

namespace App\Http\Controllers;

use App\Models\Member;
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
    public function store(Request $request,$id)
{

    $member = Member::find($id);
        // Store hover and main images
        $request->validate([
            'member_id'=>'required',
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
        $existingAppointment = Appointment::where('appointment_date', $request->appointment_date)
        ->where('appointment_time', $request->appointment_time)
        ->first();

    if ($existingAppointment) {
        return response()->json([
            'error' => 'The appointment is already booked for the selected date and time.'
        ], 409); // Conflict status code
    }

        // Store the appointment in the database
        $appointment = new Appointment();
        $appointment->member_id = $member->id;
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
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return response()->json([
                'error' => 'Appointment not found.'
            ], 404);
        }

        $request->validate([
            'member_id'=>'required',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'dob' => 'required|date',
            'gender' => 'nullable|in:male,female,other',
            'phone_number' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
            'appointment_date' => 'required|date',
            'appointment_time' => 'nullable|date_format:H:i:s',
            'appointment_type' => 'required|string|max:255',
            'reason_for_appointment' => 'nullable|string|max:1000',
            'medical_conditions' => 'nullable|string|max:1000',
            'medications' => 'nullable|string|max:1000',
            'allergies' => 'nullable|string|max:1000',
        ]);

        // Check if the same date and time is already booked by another appointment
        $existingAppointment = Appointment::where('appointment_date', $request->appointment_date)
            ->where('appointment_time', $request->appointment_time)
            ->where('id', '!=', $id) // Exclude the current appointment
            ->first();

        if ($existingAppointment) {
            return response()->json([
                'error' => 'The appointment slot is already booked for the selected date and time.'
            ], 409); // Conflict status code
        }

        // Update the appointment with validated data
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
            'message' => 'Appointment updated successfully.',
            'data' => $appointment,
        ], 200);
    }

    public function destroy(string $id)
    {
        $appointment= Appointment::find($id);
        return response()->json([
            'message'=>'appointment deleted',
            'data'=>$appointment->delete(),

        ], 200);
    }
}
