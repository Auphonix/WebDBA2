<?php
$statusMap = array(
    "Resolved" => "success",
    "Unresolved" => "danger",
    "Pending" => "default",
    "In Progress" => "default"
);
?>

@extends('layouts.app')
@section('content')
    <head><title>Index</title></head>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>My Tickets</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('ticket.create') }}"> Create New Ticket</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>User</th>
            <th>Details</th>
            <th>Status</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($tickets as $ticket)
            @if (Auth::user()->email == $ticket->userEmail)
            <tr>
                <td>{{ $ticket->id }}</td>
                <td>{{ $ticket->userEmail }}</td>
                <td>{{ $ticket->issue }}</td>
                <td><strong class="label label-{{{ $statusMap[$ticket->status] }}}">{{ $ticket->status }}</strong></td>
                <td>
                    <a class="btn btn-info" href="{{ route('ticket.show', $ticket->id) }}">Show</a>
                </td>
            </tr>
            @endif
        @endforeach
    </table>
    {!! $tickets->render() !!}
@endsection