<?php
$statusMap = array(
    "Resolved" => "success",
    "Unresolved" => "danger",
    "Pending" => "default",
    "In Progress" => "default"
);
?>

@extends('master')
@section('pageTitle', 'Show Tickets')
@section('content')
    <?php use App\Comment; ?>
    <?php $user = $ticket->User; ?> <!-- refer to instance of user -->
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
            <td class="col-lg-9" rowspan="4">
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
            <th class="col-lg-3">Name</th>
            <th class="col-lg-6">Comment</th>
            <th class="col-lg-3">Date</th>
        </tr>
        </thead>

        <!-- THIS IS THE COMMENT SECTION OF THE VIEW -->
        <?php $comments = Comment::where('ticketID', $ticket->id)->get() ?>
        @foreach ($comments as $comment)
            <tr>
                <td class="col-lg-3">{{$comment->userEmail}}</td>
                <td class="col-lg-6">{{$comment->content}}</td>
                <td class="col-lg-3">{{$comment->created_at}}</td>
            </tr>
        @endforeach

        <!-- THIS IS WHERE THE COMMENT FORM BEGINS -->
        {!! Form::model(Comment::class, ['action' => 'CommentController@store']) !!}
        {!! Form::hidden('userEmail', 'admin@rmit.edu.au', [ 'class' => 'form-control', 'hidden']) !!}
        {!! Form::hidden('ticketID', $ticket->id, ['class' => 'form-control', 'hidden']) !!}
        <tr>
            <td colspan="2" class="col-lg-8">
                {!! Form::text('content', null, ['class' => 'form-control', 'placeholder' => 'Write Comment Here']) !!}
            </td>
            <td class="col-lg-4">
                <button class="btn btn-success" type="submit">Post</button>
                {!! Form::close() !!}
            </td>
        </tr>
    </table>
@endsection