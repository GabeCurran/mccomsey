<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Service;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    //
    public function show() {
        if (auth()->user()->admin) {
            $upcomingAppointments = DB::select('
                select a.id, a.user_id, phone, service, appointment_date, description, confirmed, completed, u.name AS user_name, s.service_name AS service_name
                from appointments a
                join users u on a.user_id = u.id
                join services s on a.service = s.id
                where confirmed = 1 and completed = 0
                order by a.appointment_date
            ');
            $requestedAppointments = DB::select('
                select a.id, a.user_id, phone, service, appointment_date, description, confirmed, completed, u.name AS user_name, s.service_name AS service_name
                from appointments a
                join users u on a.user_id = u.id
                join services s on a.service = s.id
                where confirmed = 0 and completed = 0
                order by a.appointment_date
            ');
            $completedAppointments = DB::select('
                select a.id, a.user_id, phone, service, appointment_date, description, confirmed, completed, u.name AS user_name, s.service_name AS service_name
                from appointments a
                join users u on a.user_id = u.id
                join services s on a.service = s.id
                where confirmed = 1 and completed = 1
                order by a.appointment_date
            ');
            return view('appointments')->with('upcomingAppointments', $upcomingAppointments)
                ->with('requestedAppointments', $requestedAppointments)
                ->with('completedAppointments', $completedAppointments); 
        } else {
        $appointments = DB::select("
                SELECT a.id AS id, phone, appointment_date, service, description, confirmed, completed, service_name 
                FROM appointments a
                JOIN services s ON a.service = s.id
                WHERE user_id = " . auth()->user()->id . "
                AND completed = 0
                ORDER BY appointment_date
            ");
            return view('appointments')->with('appointments', $appointments)
            ->with('services', Service::all());
        }
    }

    public function create(Request $request) {
        $appointment = new Appointment;
        $appointment->user_id = auth()->user()->id;
        $appointment->phone = request('phone');
        $appointment->appointment_date = request('date');
        $appointment->service = request('service');
        $appointment->description = request('details');
        $appointment->save();
        return redirect('/appointments');
    }

    public function updatePage(Request $request) {
        $appointment = Appointment::find($request->id);
        return view('update-appointment')->with('appointment', $appointment)
            ->with('services', Service::all());
    }

    public function update(Request $request) {
        $appointment = Appointment::find($request->id);
        $appointment->phone = request('phone');
        $appointment->appointment_date = request('date');
        $appointment->service = request('service');
        $appointment->description = request('details');
        $appointment->confirmed = false;
        $appointment->update();
        return redirect('/appointments');
    }

    public function cancelConfirm(Request $request) {
        $appointment = Appointment::find($request->id);
        $service = Service::find($appointment->service);
        return view('cancel-appointment')->with('appointment', $appointment)
            ->with('service', $service);
    }

    public function delete(Request $request) {
        $appointment = Appointment::find($request->id);
        $appointment->delete();
        return redirect('/appointments');
    }

    public function complete(Request $request) {
        $appointment = Appointment::find(request('id'));
        $appointment->completed = true;
        $appointment->save();
        return redirect('/appointments');
    }

    public function confirm(Request $request) {
        $appointment = Appointment::find(request('id'));
        $appointment->confirmed = true;
        $appointment->save();
        return redirect('/appointments');
    }

    public function remove(Request $request) {
        $appointment = Appointment::find(request('id'));
        $appointment->delete();
        return redirect('/appointments');
    }
}
