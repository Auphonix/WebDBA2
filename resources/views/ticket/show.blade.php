<?php
$statusMap = array(
    "Resolved" => "success",
    "Unresolved" => "danger",
    "Pending" => "default",
    "In Progress" => "default"
);
?>

@extends('layouts.app')
@section('pageTitle', 'Show Tickets')
@section('content')
    <?php use App\Comment; use App\TechUser; ?>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{"Ticket ID: " . $ticket->id }} <span class="label label-{{  $statusMap[$ticket->status] }}">{{  $ticket->status }}</span></h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('ticket.index') }}">Back</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered table-condensed">
        <tr>
            <td class="col-lg-3">{{$user->firstName . " " . $user->lastName}}</td>
            <td class="col-lg-9" rowspan="5">
                <h4>{{ $ticket->issue }}</h4><br/>
                {{ $ticket->description }}
            </td>
        </tr>
        <tr>
            <td>{{$user->email}}</td>
        </tr>
        <tr>
            <td>{{$ticket->operatingSystem}}</td>
        </tr>
        <tr>
            <td>{{$ticket->created_at}}</td>
        </tr>
    </table>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th class="col-lg-3">Tech User</th>
            <th class="col-lg-6">Comment</th>
            <th class="col-lg-3">Date</th>
        </tr>
        </thead>

        <!-- THIS IS THE COMMENT SECTION OF THE VIEW -->
        <?php $comments = Comment::where('ticketID', $ticket->id)->get() ?>
        @if (sizeof($comments) == 0)
            <tr>
                <td colspan="3">There are no comments yet</td>
            </tr>
            @else
            @foreach ($comments as $comment)
                <?php $comment_techUser = TechUser::find($comment->techUserID) ?>
                <tr>
                    <td class="col-lg-3">{{$comment_techUser->firebaseName}}</td>
                    <td class="col-lg-6">{{$comment->content}}</td>
                    <td class="col-lg-3">{{$comment->created_at}}</td>
                </tr>

            @endforeach
            @endif
    </table>
@endsection