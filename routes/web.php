<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserTicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CounterController;
use App\Models\Setting;
use App\Models\UserTicket;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [QueueController::class, 'dashboard'])->name('dashboard');

    // Define the route for form submission
    Route::post('/submit-queue', [QueueController::class, 'submitQueue'])->name('submitQueue');
});

Route::middleware('auth')->group(function () {
    Route::post('/tickets', [TicketController::class, 'create'])
        ->name('tickets.create');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/user-tickets', [UserTicketController::class, 'store'])
        ->name('user_tickets.store');
});

Route::get('/get-latest-ticket/{queue_id}', [UserTicketController::class, 'getLatestTicket']);

// Route::get('/display', [UserTicketController::class, 'display'])->middleware('auth');

//     Route::get('/display-counter', [QueueController::class, 'display'])
//     ->name('display-counter');
// Route::get('display-completed', [QueueController::class, 'showProceedModal'])->name('proceed.modal');

Route::get('display', [UserTicketController::class, 'display'])->name('display');
Route::get('display-counter', [QueueController::class, 'displayCounter'])->name('display-counter');
Route::get('display-completed', function () {
    return view('display-completed');
})->name('display-completed');

Route::get('/generate-ticket', function (Request $request) {
    $queueCode = $request->query('queue_code');
    
    if (!$queueCode) {
        return response()->json(['error' => 'Queue code is required'], 400);
    }

    $ticketNumber = UserTicket::generateTicketNumber($queueCode);

    return response()->json(['ticket_number' => $ticketNumber]);
});

Route::get('/check-user-status', [UserTicketController::class, 'checkUserStatus'])->name('checkUserStatus');

Route::get('/check-expired-tickets', function () {
    $user = Auth::user();
    $expiredTickets = UserTicket::where('user_id', $user->id)
        ->where('status', '!=', 'Completed')
        ->where('expires_at', '<', now()) // Only fetch expired tickets
        ->orderBy('expires_at', 'desc') // Order by expiration date (latest first)
        ->get(['ticket_number', 'expires_at']); // Fetch only necessary columns

    return response()->json([
        'expired_tickets' => $expiredTickets
    ]);
})->name('check.expired.tickets');

require __DIR__.'/auth.php';

require __DIR__.'/admin-auth.php';

Route::get('admin/dashboard',[HomeController::class, 'index'])->
    name('admin.dashboard');


Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('queue/create', function() {
        return view('admin.queue.create.index');
    });
});

Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('queue/create/config', function() {
        return view('admin.queue.create.config');
    });
});

Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('queue/create', [QueueController::class, 'create'])
        ->name('admin.queue.create.index');
        
    Route::post('queue/store', [QueueController::class, 'store'])
        ->name('admin.queue.store');


});

Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('queue/view', [QueueController::class, 'view'])
        ->name('queue.view');

    Route::get('queue', [QueueController::class, 'index'])
        ->name('admin.queue.index');

    Route::get('queue/create', [QueueController::class, 'create'])
        ->name('admin.queue.create');

    Route::post('queue', [QueueController::class, 'store'])
        ->name('admin.queue.store');
});

Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('queue/edit/{id}', [QueueController::class, 'edit'])
            ->name('admin.queue.edit.edit');
    Route::put('queue/{id}', [QueueController::class, 'update'])
        ->name('admin.queue.update');
    Route::get('queue/view', [QueueController::class, 'view'])
        ->name('admin.queue.view.view');
});

Route::prefix('admin')->middleware('auth:admin')->group(function () {

    Route::delete('/queue/{id}', [QueueController::class, 'destroy'])
        ->name('admin.queue.destroy');

});

Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('queue/create/config', [SettingController::class, 'settings'])
        ->name('admin.queue.create.config');
    Route::post('queue/create/config', [SettingController::class, 'updateSettings'])
        ->name('admin.update_settings'); //settings
});

Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('user/view-user', [UserTicketController::class, 'view'])
        ->name('admin.user.view-user');

    Route::post('user', [UserTicketController::class, 'store'])
        ->name('admin.user.store');
    
    Route::post('user', [UserTicketController::class, 'updateStatus'])
        ->name('admin.user.updateStatus');

});

Route::prefix('admin')->middleware('auth:admin')->group(function () {
    // Route::get('user/counter', [UserTicketController::class, 'viewCounter'])
    //     ->name('admin.user.counter');

    Route::get('/user/counter', [UserTicketController::class, 'showTicketsByCounter'])
        ->name('admin.user.counter');

});
Route::post('/admin/queue/toggleAll', [QueueController::class, 'toggleAllQueues'])->name('admin.queue.toggleAll');
















