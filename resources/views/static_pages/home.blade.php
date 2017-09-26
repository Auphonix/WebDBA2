@extends('master')
@section('title', 'Home')
@section('content')
    <h1>RMIT Service & Support</h1>
    {{--Ask Shekhar why after the the default files have been removed that the style remains?--}}
    <div class="hero-image">
        {{ Html::image("images/sky_between_rmit_buildings.png", "Picture of RMIT buildings") }}
    </div>
    <div class="introduction">
        <p>RMIT offers a wide range of information technologies (IT) to support your learning experience and help you engage with the University community. The Service & Support centre offers a portal to assist you with all of your information technology queries.</p>
        <p>If you wish to request a service such as <a href="#">changing your password</a> or gaining access to <a href="#">additional Google services</a> then submit a service request ticket through this system.</p>
        <p>Can’t access prescribed software? Not receiving course emails? For any issue you can  <a href="#">submit a </a> ticket and we’ll get back to you within 1 to 2 business days*.</p>
        <p>Do you have a critical issue and need advice? Call us on <a href="#">03 9925 8888</a> during business hours**.</p>
        {{--<p>* This is the standard response time for a simple issue. Response times are dependant on the complexity of the issue and may take longer.</p>--}}
        {{--<p>** Operation hours for this number are outlined elsewhere.</p>--}}
    </div>

    <div class="recent-tickets">
        <span class="recent-tickets-empty">
            You have no recent tickets <br/>
            <span class="small">To be implemented in A2</span>
        </span>
    </div>
@endsection