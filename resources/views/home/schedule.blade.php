@extends('layouts.app')

@section('dependancies')
    <link rel='stylesheet' href='fullcalendar/fullcalendar.css' />
@endsection

@section('title', 'Availability')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight" id = "schedule-div">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center m-t-lg">
                            <h1>
                                Schedule
                            </h1>
                            <small>
                                Add Schedule of Events
                            </small>
                            <div id='calendar' style="background:#fafafc;"></div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="titleModal" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                
                        <!-- Event Title Modal -->
                        <div class="modal-content">
                            <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Enter Event Title</h4>
                            </div>
                            <div class="modal-body">
                                <input id="event_title" class="form-control">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default"  data-dismiss="modal" id="close_modal">Close</button>
                                <button type="button" class="btn btn-primary" id="save_btn">Save changes</button>
                            </div>
                        </div>        
                    </div>
                </div>

                  <!-- Confirm Delete Modal -->
                <div class="modal fade" id="deleteModal" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Are you sure you want to delete this event?</h4>
                            </div>
                            <div class="modal-body">
                                <h4 class="modal-title" id="event_delete"></h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default"  data-dismiss="modal" id="close_modal2">Close</button>
                                <button type="button" class="btn btn-danger" id="delete_btn">Delete</button>
                            </div>
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
        
        var _token = $('#_token').val();
        //Set focus to textbox when modal is shown
        $('#titleModal').on('shown.bs.modal', function () {
            $('#event_title').focus()
        })

         $('#deleteModal').on('shown.bs.modal', function () {
            $('#close_modal2').focus()
        })

        //Save changes on press of an enter key
        $("#event_title").keyup(function(event){
            if(event.keyCode == 13){
                $("#save_btn").click();
            }
        });
        
        var eventId;
        $("#delete_btn").click(function(){
            $.ajax({
                    url: 'schedule/delete',
                    data: '&id=' + eventId +  '&_token=' + _token,
                    type: "POST",
                    dataType: "json",
                    success: function(output) { 
                        $('#calendar').fullCalendar('removeEvents', eventId);
                        console.log('Deleted Successfully');
            }});
            $("#deleteModal").modal('hide');
        });

        
        var startEvent, endEvent;
        $("#save_btn").click(function(){
            var title = $("#event_title").val();
            if (title) {                
                eventData = {
                    title: title,
                    start: startEvent,
                    end: endEvent,
                };

                console.log(eventData);
                var Date = $.fullCalendar.formatDate(eventData.start, 'YYYY-MM-D');
                var startTime = $.fullCalendar.formatDate(eventData.start, 'hh:mm:ss');
                var endTime = $.fullCalendar.formatDate(eventData.end, 'hh:mm:ss');
                var userId = {{Auth::user()->id}};

                //Send to server side
                 $.ajax({
                    url: 'schedule/post',
                    data: '&eventName='+ title+'&startTime='+ startTime +'&endTime='+ endTime + '&eventDate=' + Date  +'&_token=' + _token,
                    type: "POST",
                    dataType: "json",
                    success: function(output) {
                        eventData.id = output;
                        $('#calendar').fullCalendar('renderEvent',eventData, true); // stick? = true
                        $('#calendar').fullCalendar('unselect');
                    }
                });
            }
            //Hide modal
            $("#titleModal").modal('hide');
            //Clear the textbox
            $("#event_title").val("");
        });


        $(document).ready(function() {
        // page is now ready, initialize the calendar...
        $('#calendar').fullCalendar({
            eventRender: function(event, element) {
                element.html(event.title +
                 '<span class="removeEvent glyphicon glyphicon-trash pull-right" id="Delete"></span>');
               },
            defaultView: 'agendaWeek',
            minTime: "06:00:00",
            maxTime: "22:00:00",
            scrollTime: "22:00:00",
            allDaySlot: false,
            contentHeight: "auto",
            editable: true,
            selectable: true,   
            events: '/schedule/fetch',
            select: function(start,end) {
                startEvent = start;
                endEvent = end;
                $("#titleModal").modal('show');
            },
            eventDrop: function(event, delta) {
                var Date = $.fullCalendar.formatDate(event.start, 'YYYY-MM-D');
                var startTime = $.fullCalendar.formatDate(event.start, 'hh:mm:ss');
                var endTime = $.fullCalendar.formatDate(event.end, 'hh:mm:ss');
                $.ajax({
                        url: 'schedule/update',
                        data: 'title='+ event.title+'&startTime='+ startTime +'&endTime='+ endTime + '&Date=' + Date + '&id=' + event.id +'&_token=' + _token ,
                        type: "POST",
                        dataType: "json",
                        success: function(output) {
                            eventData.id = output;
                            console.log('Updated Successfully');
                        }
                });
            },
            eventResize: function(event) {
                var Date = $.fullCalendar.formatDate(event.start, 'YYYY-MM-D');
                var startTime = $.fullCalendar.formatDate(event.start, 'hh:mm:ss');
                var endTime = $.fullCalendar.formatDate(event.end, 'hh:mm:ss');

                $.ajax({
                        url: 'schedule/update',
                        data: 'title='+ event.title+'&startTime='+ startTime +'&endTime='+ endTime + '&Date=' + Date + '&id=' + event.id +  '&_token=' + _token,
                        type: "POST",
                        dataType: "json",
                        success: function(output) {
                            eventData.id = output;
                            console.log('updated Successfully');
                        }
                });
            },
            eventClick: function(calEvent, jsEvent, view) {
                eventId = calEvent._id;
                title = calEvent.title;
                data = title + " on " + $.fullCalendar.formatDate(calEvent.start, 'D-MM-YYYY') +
                " from " + $.fullCalendar.formatDate(calEvent.start, 'hh:mm') +
                " to " + $.fullCalendar.formatDate(calEvent.end, 'hh:mm') ;
                console.log(eventId, title);
                if(jsEvent.target.id === 'Delete')
                {
                    $("#event_delete").html(data);
                    $("#deleteModal").modal('show');
                }
            },
        });
    });
    

        
    </script>
@endsection