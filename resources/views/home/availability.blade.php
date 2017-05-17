@extends('layouts.app')

@section('dependancies')
    <link rel='stylesheet' href='fullcalendar/fullcalendar.css' />
@endsection

@section('title', 'Main page')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center m-t-lg">
                            <h1>
                                Availability
                            </h1>
                            <small>
                                Choose the suitbale Availability
                            </small>
                            <div id='calendar'></div>
                        </div>
                    </div>
                </div>
    </div>
@endsection
@section('scripts')
    <script src='lib/jquery.min.js'></script>
    <script src='lib/moment.min.js'></script>
    <script src='fullcalendar/fullcalendar.js'></script>
    <script>
        $(document).ready(function() {
        // page is now ready, initialize the calendar...
        $('#calendar').fullCalendar({
            // put your options and callbacks here
        })
    });
    </script>
@endsection
