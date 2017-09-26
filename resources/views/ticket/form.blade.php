<?php
if (isset($ticket)) {
    $user = App\User::find($ticket->userEmail);
    $params = array($user->firstName, $user->lastName, $user->email, $ticket->operatingSystem,
        $ticket->issue, $ticket->description, 'Update');
} else {
    $params = array(null, null, null, null, null, null, 'Submit Ticket');
}
?>

<div class="form-group">
    {!! Form::label('firstName', 'First Name') !!}
    {!! Form::text('firstName', $params[0], ['class' => 'form-control', 'placeholder' => 'John']) !!}
</div>

<div class="form-group">
    {!! Form::label('lastName', 'Last Name') !!}
    {!! Form::text('lastName', $params[1], ['class' => 'form-control', 'placeholder' => 'Doe']) !!}
</div>

<div class="form-group">
    {!! Form::label('email', 'Email') !!}
    {!! Form::text('email', $params[2], ['class' => 'form-control', 'placeholder' => 's1234567@student.rmit.edu.au']) !!}
</div>

<div class="form-group">
    {!! Form::label('operatingSystem', 'Operating System') !!}
    {!! Form::text('operatingSystem', $params[3], ['class' => 'form-control', 'placeholder' => 'Windows 10']) !!}
</div>

<div class="form-group">
    {!! Form::label('issue', 'Issue') !!}
    {!! Form::text('issue', $params[4], ['class' => 'form-control','placeholder' => 'Describe your issue here']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Description') !!}
    {!! Form::textarea('description', $params[5], ['class' => 'form-control','placeholder' => 'Add any additional comments'
    ,'maxlength' =>2000, 'rows' => 4, 'style' => 'resize:none']) !!}
</div>

<button class="btn btn-success" type="submit">{{$params[6]}}</button>