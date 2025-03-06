<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Queue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminCounterController extends Controller
{
    public function index()
{
    $counters = Queue::with(['assignedServices'])
        ->leftJoin('user_tickets', 'queue_create.id', '=', 'user_tickets.queue_id')
        ->selectRaw('queue_create.id, queue_create.queue_name, queue_create.staff_id, queue_create.ticket_counter, COUNT(user_tickets.id) as ticket_count')
        ->groupBy('queue_create.id', 'queue_create.queue_name', 'queue_create.staff_id', 'queue_create.ticket_counter')
        ->get();

    $staff = DB::table('staff')->get(); // Fetch staff from staff table
    $all_services = Queue::all(); // Services are from queue_create

    return view('admin.staff.counter-management', compact('counters', 'staff', 'all_services'));
}




    public function update(Request $request, $id)
    {
        $counter = Queue::findOrFail($id);
        $counter->update(['staff_id' => $request->staff_id]);
        $counter->assignedServices()->sync($request->service_ids);
 
        return redirect()->back()->with('success', 'Counter updated successfully!');
    }

    public function storeStaff(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:staff,email',
            'password' => 'required|min:6'
        ]);

        DB::table('staff')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'New staff added successfully!');
    }
}
