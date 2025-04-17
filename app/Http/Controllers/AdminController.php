<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Appointment;
use Carbon\Carbon;
use Spatie\GoogleCalendar\Event as GoogleCalendarEvent;
use Google_Client;
use Google_Service_Calendar;
use Notification;
use Spatie\GoogleCalendar\Event;
use App\Notifications\NewAppointmentNotification;
use Illuminate\Support\Facades\DB;
use App\Models\Announcement;
use App\Notifications\AppointmentStatusNotification;
use App\Models\StudentLog;
use Illuminate\Support\Facades\Mail;
use App\Mail\DoneAppointmentMail;


use App\Notifications\SendEmailNotification;

class AdminController extends Controller
{
  
    public function addview()
    {
       
       return view('admin.add_doctor');

    }

    public function upload(Request $request)
    {
      $doctor = new doctor;
      $image=$request->file;

      $imagename=time().'.'.$image->getClientoriginalExtension();

      $request->file->move('doctorimage',$imagename);

      $doctor->image=$imagename;

      $doctor->name=$request->name;
      $doctor->phone=$request->number;
      $doctor->speciality=$request->speciality;

      $doctor->save();
      

      return redirect()->back()->with('message','Doctor Added Successfully');
    }

    public function showappointment()
    {
        $data = Appointment::with('user')->get();
        return view('admin.showappointment', compact('data'));
    }    
    public function approved($id)
    {
      $data=appointment::find($id);

      $data->status='approved';
      
      $data->save();

      return redirect()->back();
    }

    public function canceled($id)
    {
      $data=appointment::find($id);

      $data->status='canceled';
      
      $data->save();

      return redirect()->back();
    }
    
    public function showdoctor()
    {
      $data=doctor::all();
      return view('admin.showdoctor',compact('data'));
    }

    public function removedoctor($id)
    {
      $data=doctor::find($id);

      $data->delete();

      return redirect()->back();
    
}

    public function updatedoctor($id)
    {

      $data = doctor::find($id);


      return view('admin.update_doctor',compact( 'data'));
    }
 
    public function dashboard()
    {
        $userCount = User::count();
        $appointmentCount = Appointment::count();
        $appointments = Appointment::all();
        return view('admin.home', compact('userCount','appointmentCount')); 
    }
    
    public function getUsers()
    {
        $users = User::all();
        return response()->json($users);
    }
    
    public function home()
    {
        $users = User::where('usertype', '!=', 1)->count();
        $appointmentCount = Appointment::count();
    
        return view('admin.home', compact('users','appointmentCount'));
    }
    public function editdoctor(Request $request , $id)
    {

      $doctor = doctor::find($id);

      $doctor->name=$request->name;

      $doctor->phone=$request->phone;

      $doctor->speciality=$request->speciality;

      $image=$request->file;

      if($image){

      }

      $imagename=time().'.'.$image->getClientOriginalExtension();

      $request->file->move('doctorimage', $imagename);

      $doctor->image=$imagename;

      $doctor->save();

      return redirect()->back()->with('message','Doctor Update Successful');

    }

    public function emailview($id)
    {
      
      $data=appointment::find($id);

      return view('admin.send_email',compact('data'));
    }
    
    public function sendemail(Request $request,$id)
    {

      $data = appointment::find($id);

      $details=[

        'subject' => $request->subject,

       'greeting' => $request->greeting,

       'body' => $request->body,

       'actiontext' => $request->actiontext,

       'actionurl' => $request->actionurl,

       'endpart' => $request->endpart

      ];

      Notification::send($data, new SendEmailNotification($details));

      return back()->with('message','Send Email Successful');

    }
    public function viewUser($id)
    {
         $user = User::find($id);
        return view('admin.viewUser', compact('user'));
    }
   public function deleteUser($id)
   {

     $user = user::find($id);

     $user->delete();

     return redirect()->back();

   }

   

   public function editUser($id)
   {
       $user = user::find($id);
       return view('admin.editUser', compact('user'));
   }

   public function updateUser(Request $request, $id)
{
    $user = User::find($id);

    if (!$user) {
        return redirect()->back()->with('error', 'User not found');
    }

    if (preg_match('/\d/', $request->name)) {
        return redirect()->back()->with('error', 'Name should not contain number');
    }

    if (preg_match('/[a-zA-Z]/', $request->phone)) {
        return redirect()->back()->with('error', 'Phone number should not contain letter');
    }

    if (!strpos($request->email, '@gmail.com')) {
        return redirect()->back()->with('error', 'Email must be a Gmail address');
    }

    if (User::where('phone', $request->phone)->where('id', '!=', $id)->exists()) {
        return redirect()->back()->with('error', 'Phone number already exists');
    }

    if (User::where('email', $request->email)->where('id', '!=', $id)->exists()) {
        return redirect()->back()->with('error', 'Email address already exists');
    }

    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->address = $request->address;
    $user->course = $request->course;
    $user->student_id = $request->student_id;
    $user->education_level = $request->education_level;
    $user->year_level = $request->year_level;

    $user->save();

    return redirect()->back()->with('message', 'Update user successful');
}

  public function calendar()
{
    $events = Event::get();
    return view('admin.calendar', compact('events'));
}
public function destroy($id)
{
    $event = Event::find($id);
    if ($event) {
        $event->delete();
        return response()->json(['success' => true]);
    }
    return response()->json(['success' => false], 400);
}
public function fetchGoogleCalendarEvents()
{
    $events = Event::get();
    $formattedEvents = [];

    foreach ($events as $event) {
        $startDateTime = Carbon::parse($event->startDateTime)->format('Y-m-d\TH:i:s');
        $endDateTime = Carbon::parse($event->endDateTime)->format('Y-m-d\TH:i:s');

        $title = $event->name ?? "Untitled Event";  

        $formattedEvents[] = [
            'title' => $title,
            'start' => $startDateTime, 
            'end'   => $endDateTime,
        ];
    }

    return response()->json($formattedEvents);
}
public function markAsRead($id)
{
    $notification = auth()->user()->notifications()->find($id);
    if ($notification) {
        $notification->markAsRead();
    }
    return redirect()->back()->with('message', 'Notification marked as read!');
}


public function markAllAsRead()
{
    auth()->user()->unreadNotifications->markAsRead();
    return response()->json(['success' => true]);
}
public function createAppointment(Request $request)
{
    $appointment = Appointment::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'doctor' => $request->doctor,
        'date' => $request->date,
        'time' => $request->time, 
        'message' => $request->message,
        'status' => 'Pending',
        'user_id' => auth()->id(),
    ]);

    $admin = User::where('usertype', 1)->first();
    if ($admin) {
        $admin->notify(new NewAppointmentNotification($appointment));
    }

    return redirect()->back()->with('message', 'Appointment created successfully!');
}
public function announcements()
{
    return view('admin.announcements');
}

public function createAnnouncement(Request $request)
{
    $request->validate([
        'title' => 'required',
        'message' => 'required',
        'expired_date' => 'required|date|after:today',
        'type' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $announcement = new Announcement();
    $announcement->title = $request->title;
    $announcement->message = $request->message;
    $announcement->type = $request->type;
    $announcement->expired_date = $request->expired_date;

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName(); 
        $path = public_path('assets/img/announcement'); 

        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        $image->move($path, $imageName);

        $announcement->image = 'assets/img/announcement/' . $imageName;
    }

    $announcement->save();

    return redirect()->back()->with('success', 'Announcement Created Successfully');
}


public function approveAppointment($appointmentId)
{
    $appointment = Appointment::find($appointmentId);
    $appointment->status = 'Approved'; 
    $appointment->save();

    $user = $appointment->user;
    $user->notify(new AppointmentStatusNotification($appointment, 'approved'));

    return redirect()->back()->with('success', 'Appointment Approved');
}
public function processAppointment($appointmentId)
{
    $appointment = Appointment::find($appointmentId);
    $appointment->status = 'In process';
    $appointment->save();

    
    $user = $appointment->user;
    $user->notify(new AppointmentStatusNotification($appointment, 'In process'));

    return redirect()->back()->with('success', 'Appointment In process');
}
public function rescheduleAppointment($appointmentId)
{
    $appointment = Appointment::find($appointmentId);
    $appointment->status = 'reschedule';
    $appointment->save();

    
    $user = $appointment->user;
    $user->notify(new AppointmentStatusNotification($appointment, 'reschedule'));

    return redirect()->back()->with('success', 'Appointment Reschedule');
}
public function cancelAppointment($appointmentId)
{
    $appointment = Appointment::find($appointmentId);
    $appointment->status = 'Canceled';
    $appointment->save();

    
    $user = $appointment->user;
    $user->notify(new AppointmentStatusNotification($appointment, 'canceled'));

    return redirect()->back()->with('success', 'Appointment Canceled');
}
public function viewStudentLogs()
{
    $logs = StudentLog::whereHas('student', function ($query) {
        $query->where('usertype', 0); 
    })->latest()->with('student')->paginate(10);

    return view('admin.studentlogs', compact('logs'));
}
public function showLogs()
{

    $logs = StudentLog::latest()->with('student')->paginate(10);

    return view('admin.home', compact('logs'));
}
public function sendDoneEmail(Request $request)
{
    $request->validate([
        'appointment_id' => 'required|exists:appointments,id',
        'email' => 'required|email',
        'message' => 'required|string',
    ]);

    $appointment = Appointment::findOrFail($request->appointment_id);
    $appointment->status = 'done';
    $appointment->save();

    Mail::to($request->email)->send(new DoneAppointmentMail($request->message));

    if ($appointment->user) {
        $appointment->user->notify(new AppointmentStatusNotification($appointment, 'done'));
    }

    return back()->with('success', 'Email sent appointment done.');
}
}