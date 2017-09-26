<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

class CommentController extends Controller
{
    public function store(Request $request){

        $allRequests = $request->all();

        $comment = new Comment;
        $comment->userEmail = $allRequests['userEmail'];
        $comment->ticketID = $allRequests['ticketID'];
        $comment->content = $allRequests['content'];
        $comment->save();

        return redirect()->route('ticket.show', $allRequests['ticketID'])->with('success', 'Comment added successfully');
    }
}
