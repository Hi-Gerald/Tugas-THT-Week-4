<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Category;

class TicketController extends Controller
{
    public function index()
    {
        if (auth()->user()->is_admin) {
            $tickets = Ticket::with('category', 'user')->get();
        } else {
            $tickets = Ticket::with('category', 'user')
                ->where('user_id', auth()->id())
                ->get();
        }

        return view('tickets.index', compact('tickets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,png|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('tickets', 'public');
        }

        $ticket = new Ticket();
        $ticket->user_id = auth()->id();
        $ticket->category_id = $request->category_id;
        $ticket->title = $request->title;
        $ticket->description = $request->description;
        $ticket->location = $request->location;
        $ticket->image_path = $imagePath;
        $ticket->status = 'Pending';
        $ticket->save();

        return redirect()->route('tickets.index')->with('success', 'Laporan berhasil dibuat!');
    }

    public function create()
    {
        $categories = Category::all();
        return view('tickets.create', compact('categories'));
    }

    public function show(Ticket $ticket)
    {
        if (auth()->user()->id !== $ticket->user_id && !auth()->user()->is_admin) {
            abort(403, 'Unauthorized');
        }

        $ticket->load('user', 'category', 'comments.user');
        return view('tickets.show', compact('ticket'));
    }
}
