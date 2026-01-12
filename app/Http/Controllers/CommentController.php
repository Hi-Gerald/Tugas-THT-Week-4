<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Ticket;

class CommentController extends Controller
{
    public function store(Request $request, Ticket $ticket)
    {
        if (auth()->user()->id !== $ticket->user_id && !auth()->user()->is_admin) {
            abort(403, 'Anda tidak bisa memberi komentar di tiket ini');
        }

        $request->validate([
            'message' => 'required|string|min:3'
        ]);

        $comment = new Comment();
        $comment->ticket_id = $ticket->id;
        $comment->user_id = auth()->id();
        $comment->message = $request->message;
        $comment->save();

        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }
}
