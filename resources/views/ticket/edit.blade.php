@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Ticket</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('ticket.index') }}"> Back</a>
            </div>
        </div>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {!! Form::model($ticket, ['method' => 'PATCH','route' => ['ticket.update', $ticket->id]]) !!}

    {{--CHANGE THE STATUS OF THE TICKET FIELD--}}
    @if(isset($ticket))
        <div class="form-group">
            {!! Form::label('status', 'Status') !!}
            {{ Form::select('status', ['Pending' => 'Pending', 'In Progress' => 'In Progress',
            'Unresolved' => 'Unresolved', 'Resolved' => 'Resolved']) }}
        </div>
    @endif

    {{--INCLUDE FORM TEMPLATE--}}
    @include('ticket.form')

    {!! Form::close() !!}
@endsection