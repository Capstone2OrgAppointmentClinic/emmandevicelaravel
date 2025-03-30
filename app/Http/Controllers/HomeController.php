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



class HomeController extends Controller
{
    public function redirect()
    {
        if (Auth::id()) 
        {
            if (Auth::user()->usertype == 0) 
            {
                $doctor = Doctor::all(); // Fetch doctors for the user side
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
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'You must login first to make an appointment.');
        }
    
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
        ]);
    
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
    
        $data->save();
    
        $admin = User::where('usertype', 1)->first();
        if ($admin) {
            $admin->notify(new NewAppointmentNotification($data));
        }
    
        return redirect()->back()->with('message', 'Appointment request successful! It is now added to your calendar wait for the approval.');
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
    $startTime = $selectedTime->copy()->subHour();
    $endTime = $selectedTime->copy()->addHour();

    
    $conflict = Appointment::whereDate('date', $date)
        ->whereTime('time', '>=', $startTime->format('H:i'))
        ->whereTime('time', '<=', $endTime->format('H:i'))
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

}
