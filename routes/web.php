<?php
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'redirect'])->middleware('auth', 'verified');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/add_doctor_view', [AdminController::class, 'addview']);

Route::post('/upload_doctor', [AdminController::class, 'upload']);

Route::post('/appointment', [HomeController::class, 'appointment']);

Route::get('/myappointment', [HomeController::class, 'myappointment']);

Route::get('/cancel_appoint/{id}', [HomeController::class, 'cancel_appoint']);

Route::get('/showappointment', [AdminController::class, 'showappointment']);

Route::get('/approved/{id}', [AdminController::class, 'approved']);

Route::get('/canceled/{id}', [AdminController::class, 'canceled']);

Route::get('/showdoctor', [AdminController::class, 'showdoctor']);

Route::get('/removedoctor/{id}', [AdminController::class, 'removedoctor']);

Route::get('/updatedoctor/{id}', [AdminController::class, 'updatedoctor']);

Route::get('/admin/get-users', [AdminController::class, 'getUsers'])->name('admin.getUsers');

Route::post('/editdoctor/{id}', [AdminController::class, 'editdoctor']);

Route::get('/emailview/{id}', [AdminController::class, 'emailview']);

Route::get('/deleteUser/{id}', [AdminController::class, 'deleteUser']);

Route::get('/editUser/{id}', [AdminController::class, 'editUser']);

Route::post('/updateUser/{id}', [AdminController::class, 'updateUser']);

Route::post('/sendemail/{id}', [AdminController::class, 'sendemail']);

Route::post('/chat', [HomeController::class, 'chat'])->name('chat');

Route::get('/calendar', [AdminController::class, 'calendar']);

Route::get('/fetch-google-events', [AdminController::class, 'fetchGoogleCalendarEvents']);

Route::get('/mark-as-read/{id}', [AdminController::class, 'markAsRead'])->name('markAsRead');

Route::get('/mark-all-as-read', [AdminController::class, 'markAllAsRead'])->name('markAllAsRead');

Route::get('/user/usercalendar', [HomeController::class, 'showCalendar'])->name('user.usercalendar');

Route::get('/user/get-appointments', [HomeController::class, 'getAppointments']);

Route::get('/check-appointments', [HomeController::class, 'checkAppointments']);

Route::get('/check-appointment-conflict', [HomeController::class, 'checkAppointmentConflict']);

Route::get('/announcement', [HomeController::class, 'announcement'])->name('announcement');

Route::get('/announcements', [AdminController::class, 'announcements'])->name('announcements');

Route::post('createAnnouncement', [AdminController::class, 'createAnnouncement'])->name('createAnnouncement');

Route::get('/announcement/{id}', [HomeController::class, 'showAnnouncement'])->name('announcement_details');

Route::post('/cancel_appoint', [HomeController::class, 'cancelAppointment'])->name('cancel.appointment');

Route::post('/reschedule_appoint', [HomeController::class, 'reschedule_appoint'])->name('reschedule_appoint');

Route::get('/check-conflict/{appointmentId}/{date}/{time}', [HomeController::class, 'checkConflict']);

Route::get('/get-unread-notifications-count', function() {
    return response()->json(['count' => auth()->user()->unreadNotifications->count()]);
});

Route::get('/check-appointment-limit', [HomeController::class, 'checkAppointmentLimit']);

Route::get('approved/{id}', [AdminController::class, 'approveAppointment']);

Route::get('canceled/{id}', [AdminController::class, 'cancelAppointment']);

Route::get('/markAllAsRead', [HomeController::class, 'markAllAsRead'])->name('markAllAsRead');

Route::get('/appointment', [HomeController::class, 'index'])->name('user.appointment');

Route::get('/user/latest', [HomeController::class, 'latest'])->name('user.latest');

Route::get('/user/chat', [HomeController::class, 'chatPage'])->name('user.chat')->middleware('auth');

Route::get('/check-weekly-user-appointments', [HomeController::class, 'checkWeeklyUserAppointments']);

Route::get('/check-user-weekly-limit/{appointmentId}', [HomeController::class, 'checkWeeklyLimit']);

Route::get('/aboutUs', [HomeController::class, 'aboutus'])->name('aboutus');
