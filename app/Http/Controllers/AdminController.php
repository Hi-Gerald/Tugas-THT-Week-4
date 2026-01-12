<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $tickets = Ticket::with('user', 'category', 'comments')->get();
        $stats = [
            'total' => Ticket::count(),
            'pending' => Ticket::where('status', 'Pending')->count(),
            'in_progress' => Ticket::where('status', 'In Progress')->count(),
            'resolved' => Ticket::where('status', 'Resolved')->count(),
        ];

        return view('admin.dashboard', compact('tickets', 'stats'));
    }

    public function updateStatus(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required|in:Pending,In Progress,Resolved'
        ]);
        $ticket->status = $request->status;
        $ticket->save();
        return back()->with('success', 'Status tiket berhasil diubah!');
    }
}
