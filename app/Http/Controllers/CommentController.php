<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Ticket;

class CommentController extends Controller
{
    /**
     * Simpan komentar baru untuk sebuah tiket.
     */
    public function store(Request $request, Ticket $ticket)
    {
        $request->validate([
            'message' => 'required'
        ]);

        Comment::create([
            'ticket_id' => $ticket->id,
            'user_id'   => auth()->id(),
            'message'   => $request->message
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }
}
