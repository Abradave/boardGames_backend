<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the appointments.
     */
    public function index()
    {
        $appointments = Appointment::all();
        return response()->json($appointments, 200);     
    }

    /**
     * Display a listing of the authenticated employee's appointments.
     */
    public function authEmployeeAppointment()
    {
        $employee = auth()->user();
        $auth_appointments = $employee->appointments;
        //return Appointment::where("employee_id", $employee->id)->get();
        //$appointments = Appointment::where("employee_id", $employee->id)->get();
        return response()->json($auth_appointments, 200);
    }

    /**
     * Store a newly created appointment in storage.
     */
    public function store(StoreAppointmentRequest $request)
    {
        $appointment = new Appointment();
        $appointment->fill($request->all());
        $appointment->save();
        return response()->json($appointment, 201);
    }

    /**
     * Display the specified appointment.
     */
    public function show(string $id)
    {
        $appointment = Appointment::find($id);
        if(is_null($appointment)){
            return response()->json(["message" => "Appointment not found with id: $id"], 404);
        }
        return $appointment;
    }

    /**
     * Update the specified appointment in storage.
     */
    public function update(UpdateAppointmentRequest $request, string $id)
    {
        $appointment = Appointment::find($id);
        if(is_null($appointment)){
            return response()->json(["message" => "Appointment not found with id: $id"], 404);
        }
        $appointment->fill($request->all());
        $appointment->save();
        return $appointment;
    }

    /**
     * Remove the specified appointment from storage.
     */
    public function destroy(string $id)
    {
        $appointment = Appointment::find($id);
        if(is_null($appointment)){
            return response()->json(["message" => "Appointment not found with id: $id"], 404);
        }
        $appointment->delete();
        return response()->noContent();
    }
}
