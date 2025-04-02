<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Announcement;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Doctor;
use App\Models\Appointment;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Notifications\NewAppointmentNotification;
use Illuminate\Support\Facades\Notification;
use App\Notifications\RescheduleNotification;



class HomeController extends Controller
{
    public function redirect()
    {
        if (Auth::id()) 
        {
            if (Auth::user()->usertype == 0) 
            {
                $doctor = Doctor::all();
                $announcements = Announcement::orderBy('created_at', 'desc')->get();
    
                return view('user.home', compact('doctor', 'announcements'));
            } 
            else if (Auth::user()->usertype == 1) 
            {
                $userCount = User::where('usertype', 0)->count();
                $users = User::where('usertype', 0)->get();
                
                return view('admin.home', compact('userCount', 'users'));
            }
        }
    
        return redirect()->back();
    }
    
    public function index()
{   
    $doctor = Doctor::all();
    $announcements = Announcement::orderBy('created_at', 'desc')->get();
    return view('user.home', compact('announcements','doctor'));
}
public function appointment(Request $request)
{
    // Ensure the user is authenticated
    if (!Auth::check()) {
        return redirect()->back()->with('error', 'You must login first to make an appointment.');
    }

    // Validate the input data
    $request->validate([
        'date' => 'required|date|after_or_equal:today',
        'time' => 'required|date_format:H:i',
    ]);

    $selectedTime = Carbon::createFromFormat('H:i', $request->time);
    
    if ($selectedTime->hour < 8 || $selectedTime->hour >= 20) {
        return redirect()->back()->with('error', 'Appointments can only be scheduled between 8 AM and 8 PM.');
    }

    $totalAppointmentsForDay = Appointment::whereDate('date', $request->date)->count();
    if ($totalAppointmentsForDay >= 5) {
        return redirect()->back()->with('error', 'Sorry, the limit of 5 appointments for this day has been reached.');
    }

    $appointmentDateTime = Carbon::createFromFormat('Y-m-d H:i', $request->date . ' ' . $request->time);
    $conflict = Appointment::where('date', $request->date)
        ->where(function ($query) use ($appointmentDateTime) {
            $query->whereTime('time', '>=', $appointmentDateTime->copy()->subHour()->format('H:i'))
                  ->whereTime('time', '<=', $appointmentDateTime->copy()->addHour()->format('H:i'));
        })
        ->exists();

    if ($conflict) {
        return redirect()->back()->with('error', 'An appointment already exists within 1 hour of this time. Please choose another time.');
    }

    $data = new Appointment();
    $data->name = Auth::user()->name;
    $data->email = Auth::user()->email;
    $data->date = $request->date;
    $data->time = $request->time;
    $data->phone = $request->number;
    $data->message = $request->message;
    $data->service = $request->service;
    $data->status = 'In progress';
    $data->user_id = Auth::user()->id;

    // $data->password = bcrypt($request->password);

    $data->save();

    $admin = User::where('usertype', 1)->first();
    if ($admin) {
        $admin->notify(new NewAppointmentNotification($data));
    }

    return redirect()->back()->with('message', 'Appointment request successful! It is now added to your calendar. Wait for the approval.');
}

    
    public function myappointment()
    {

       if(Auth::id())

       {
          
        $userid=Auth::user()->id;
        $appoint=appointment::where('user_id',$userid)->get();

        return view('user.my_appointment',compact('appoint'));
       
       }

       else
       {
              return redirect()->back();
       }

    }

    public function cancel_appoint($id)
    {
        $data=appointment::find($id);

        $data->delete();

        return redirect()->back();


    }

    public function viewMessage($id)
    {
        $appointment = Appointment::findOrFail($id);
        return response()->json(['message' => $appointment->message]);

 }
 public function chat(Request $request)
 {
     $userMessage = $request->input('message');

     if (!$userMessage) {
         return response()->json(['reply' => 'Please enter a message.'], 400);
     }

     $apiKey = env('OPENAI_API_KEY');

     $response = Http::withHeaders([
         'Authorization' => 'Bearer ' . $apiKey,
         'Content-Type' => 'application/json'
     ])->post('https://api.openai.com/v1/chat/completions', [
         'model' => 'gpt-3.5-turbo',
         'messages' => [
             ['role' => 'system', 'content' => 'You are a helpful assistant.'],
             ['role' => 'user', 'content' => $userMessage]
         ]
     ]);

     if ($response->failed()) {
         return response()->json(['reply' => 'Error connecting to AI.'], 500);
     }

     return response()->json(['reply' => $response->json()['choices'][0]['message']['content']]);
 }
 public function showCalendar()
 {
     return view('user.usercalendar');
 }

 public function getAppointments()
{
    $appointments = Appointment::where('user_id', auth()->id())->get(['id', 'name', 'date', 'time']);

    $events = [];

    foreach ($appointments as $appointment) {
        
        $events[] = [
            'id'    => $appointment->id,
            'start' => $appointment->date . 'T' . $appointment->time,
        ];
    }

    return response()->json($events);
}
public function checkAppointments(Request $request)
{
    $date = $request->query('date');

    $appointmentCount = Appointment::where('date', $date)->count();

    return response()->json(['count' => $appointmentCount]);
}
public function checkAppointmentConflict(Request $request)
{
    $date = $request->date;
    $time = $request->time;

    $selectedTime = Carbon::createFromFormat('H:i', $time);

    if ($selectedTime->hour < 8 || $selectedTime->hour >= 20) {
        return response()->json(['conflict' => true, 'message' => 'Appointments can only be scheduled between 8 AM and 8 PM.']);
    }

    $startTime = $selectedTime->copy()->subHour();
    $endTime = $selectedTime->copy()->addHour();

    $conflict = Appointment::whereDate('date', $date)
        ->whereBetween('time', [$startTime->format('H:i'), $endTime->format('H:i')])
        ->exists();

    return response()->json(['conflict' => $conflict]);
}

public function announcement()
 {
     return view('user.announcement');
 }
 public function showAnnouncement($id)
{
    $announcement = Announcement::findOrFail($id);
    return view('user.announcement_details', compact('announcement'));
}
public function cancelAppointment(Request $request)
{
    $appointment = Appointment::find($request->appointment_id);

    if ($appointment) {
        \Log::info('Appointment ID: ' . $appointment->id . ' was canceled. Reason: ' . $request->cancel_reason);

        $appointment->delete();

        return redirect()->back()->with('message', 'Appointment successfully canceled.');
    }

    return redirect()->back()->with('error', 'Appointment not found.');
}

public function reschedule_appoint(Request $request)
{
    $appointment = Appointment::find($request->appointment_id);

    if ($appointment) {
        $rescheduleDateTime = Carbon::createFromFormat('Y-m-d H:i', $request->reschedule_date . ' ' . $request->reschedule_time);

        $conflict = Appointment::where('date', $request->reschedule_date)
            ->where('id', '!=', $appointment->id)
            ->where(function ($query) use ($rescheduleDateTime) {
                $query->whereTime('time', '>=', $rescheduleDateTime->copy()->subHour()->format('H:i'))
                    ->whereTime('time', '<=', $rescheduleDateTime->copy()->addHour()->format('H:i'));
            })
            ->exists();

        if ($conflict) {
            return redirect()->back()->with('error', 'Another appointment is scheduled within 1 hour of the selected time. Please choose a different time.');
        }

        $appointment->date = $request->reschedule_date;
        $appointment->time = $request->reschedule_time;
        $appointment->message = $request->reschedule_reason;
        $appointment->status = 'Rescheduled';
        $appointment->save();

        // Notify admin of reschedule
        $admin = User::where('usertype', 1)->first();
        if ($admin) {
            $admin->notify(new RescheduleNotification($appointment));
        }

        return redirect()->back()->with('message', 'Appointment rescheduled successfully.');
    } else {
        return redirect()->back()->with('error', 'Appointment not found.');
    }
}
public function checkConflict($appointmentId, $date, $time)
{
    // Count all appointments for the selected date (all users)
    $appointmentCount = Appointment::where('date', $date)
        ->where('id', '!=', $appointmentId) 
        ->count();

    // If the limit of 5 appointments per day is reached, show error
    if ($appointmentCount >= 5) {
        return response()->json([
            'appointmentLimit' => true,
            'exactConflict' => false,
            'timeConflict' => false,
        ]);
    }

    // Check exact conflict for the same time and date (for other users)
    $exactConflict = Appointment::where('date', $date)
        ->where('time', $time)
        ->where('id', '!=', $appointmentId)
        ->exists();

    // Check conflict if another appointment is within 1 hour of the selected time
    $rescheduleDateTime = Carbon::createFromFormat('Y-m-d H:i', $date . ' ' . $time);
    $timeConflict = Appointment::where('date', $date)
        ->where('id', '!=', $appointmentId)
        ->where(function ($query) use ($rescheduleDateTime) {
            $query->whereTime('time', '>=', $rescheduleDateTime->copy()->subHour()->format('H:i'))
                  ->whereTime('time', '<=', $rescheduleDateTime->copy()->addHour()->format('H:i'));
        })
        ->exists();

    return response()->json([
        'appointmentLimit' => false,
        'exactConflict' => $exactConflict,
        'timeConflict' => $timeConflict,
    ]);
}
}
