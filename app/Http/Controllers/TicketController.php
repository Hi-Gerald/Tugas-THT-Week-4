<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{
    // Method index untuk menampilkan tiket
    // public function index()
    // {
    //     return auth()->user()->is_admin
    //         ? Ticket::all()
    //         : Ticket::where('user_id', auth()->id())->get();
    // }
    public function index()
    {
        $tickets = auth()->user()->is_admin
            ? \App\Models\Ticket::with('category')->get()
            : \App\Models\Ticket::with('category')->where('user_id', auth()->id())->get();

        return view('tickets.index', compact('tickets'));
    }


    // Method store yang sebelumnya sudah kamu buat
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,png|max:2048'
        ]);

        $path = $request->file('image')?->store('tickets', 'public');

        Ticket::create([
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'image_path' => $path,
            'status' => 'Pending'
        ]);

        return redirect()->back()->with('success', 'Laporan berhasil dibuat!');
    }

    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('tickets.create', compact('categories'));
    }
}
