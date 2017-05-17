@extends('layouts.app')

@section('dependancies')
    <link rel='stylesheet' href='fullcalendar/fullcalendar.css' />
@endsection

@section('title', 'Main page')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center m-t-lg">
                            <h1>
                                Availability
                            </h1>
                            <small>
                                Choose the suitable Availability
                            </small>
                            <div id='calendar' style="background:#fafafc;"></div>
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
        var _token = $('#_token').val();
        $('#calendar').fullCalendar({
            defaultView: 'agendaWeek',
            minTime: "06:00:00",
            maxTime: "22:00:00",
            scrollTime: "22:00:00",
            allDaySlot: false,
            contentHeight: "auto",
            editable: true,
            selectable: true,
		
            select: function(start, end) {
				var title = 'Available';
				if (title) {
					eventData = {
						title: title,
						start: start,
						end: end,
					};
                    var Date = $.fullCalendar.formatDate(eventData.start, 'YYYY-MM-D');
                    var startTime = $.fullCalendar.formatDate(eventData.start, 'hh:mm:ss');
                    var endTime = $.fullCalendar.formatDate(eventData.end, 'hh:mm:ss');
                    $.ajax({
                        url: 'availability/post',
                        data: 'title='+ title+'&startTime='+ startTime +'&endTime='+ endTime + '&Date=' + Date + '&_token=' + _token,
                        type: "POST",
                        dataType: "json",
                        success: function(output) {
                            console.log(output);
                            alert(Date);
                            alert('Added Successfully');
                        }
                    });
					$('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
				}   
				$('#calendar').fullCalendar('unselect');
        },
        
        eventDrop: function(event, delta) {
        startTime = $.fullCalendar.formatDate(event.start, 'hh:mm:ss');
        endTime = $.fullCalendar.formatDate(event.end, 'hh:mm:ss');

        $.ajax({
            url: 'availability/update',
            data: 'title='+ event.title+'&start='+ startTime +'&end='+ endTime +'&id='+ event.id + '&_token=' + _token,
            type: "POST",
            success: function(json) {
                console.log(json);
                alert("Updated Successfully");
            }
        });
        },
        
        eventResize: function(event) {
            
        startTime = $.fullCalendar.formatDate(event.start, 'hh:mm:ss');
        endTime = $.fullCalendar.formatDate(event.end, 'hh:mm:ss');

            $.ajax({
                url: 'availability/update',
                data: 'title='+ event.title+'&start='+ startTime +'&end='+ endTime +'&id='+ event.id + '&_token=' + _token,
                type: "POST",
                success: function(json) {
                    console.log(json);
                    alert("Updated Successfully");
                }
            });
        }
        });
        });

        
    </script>
@endsection