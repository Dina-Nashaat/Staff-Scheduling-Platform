/* Global Variables */
var _token = $('#_token').val();
var eventId, startEvent, endEvent, color, selectedStartTime, selectedEndTime, done;
var selected = []

/** Create multiple colors */
function generateColors(colorIdTag) {
    colors = ['#B71C1C', '#880E4F', '#4A148C', '#311B92', '#E65100', '#212121', '#0D47A1', '#FF6F00'];
    $(colorIdTag).append('Event Color : ');
    $.each(colors, function (i, color) {
        var span = $('<a><span id = "color" name = "' + color + '"' +
        'style = "display:inline-block; height:20px; width:20px;' +
        'margin-left: 2px; margin-right:3px; font-size:14px; ' + 'padding-left: 3px; padding-top:5px;' +
        'background-color:' + color + '">' + 
        '<i class="" style = "font-size:15px; color:white; opacity:0.5;">' +
        '</i></span></a>');
        $(colorIdTag).append(span);
    });
}

/** Get people scheduled at the specified time */
function getAssignees(startEv, endEv) {
    
    eventData = {
        start: startEv,
        end: endEv,
        color: color,
    };
    var Date = $.fullCalendar.formatDate(eventData.start, 'YYYY-MM-D');
    var startTime = $.fullCalendar.formatDate(eventData.start, 'HH:mm:ss');
    var endTime = $.fullCalendar.formatDate(eventData.end, 'HH:mm:ss');
    $.ajax({
        type: 'POST',
        url: '/availability/availableAtTime',
        data: '&start_time=' + startTime + '&end_time=' + endTime + '&event_date=' + Date + '&_token=' + _token,
        success: function (output) {
            var availabilities = output;
            var users = [];
            $.each(availabilities, function (i, availability) {
                $('.selectpicker').append('<option value =' + availability.user.id +
                    ' data-subtext="' + ' | '+
                    (availability.start_time).substr(0,5) + ' - ' +
                    (availability.end_time).substr(0,5) +
                    '">' + availability.user.firstname + '  ' +
                    (availability.user.lastname).substr(0,1) +
                    '</option>');
                $('.selectpicker').selectpicker('refresh');
            });            
        }
    });
}

/** Assign a color to event on click */
$(document.body).on('click', '#color', function getColor(event) {
    color = $(event.target).attr('name');
    console.log($(event.target));
    $('i').removeClass('material-icons');
    $('i').html('');
    $(event.target).children("i").toggleClass('material-icons');
    if ($(event.target).children().hasClass("material-icons")) {
            $(event.target).children().html("check");
    } else {
            $(event.target).children().html("");
    }
    console.log(color);
});

$(document.body).on('click', 'i', function getColor(event) {
    color = undefined;
    $(event.target).toggleClass('material-icons');
    if ($(event.target).hasClass("material-icons")) {
            $(event.target).html("check");
    } else {
            $(event.target).html("");
    }
    console.log(color);
});

/** Save changes on Enter Key in Add Event Modal */
$("#event_title").keyup(function (event) {
    if (event.keyCode == 13) { //13 Code for Enter Key
        $("#save_btn").click();
    }
});

/** Delete an event */
$("#delete_btn").click(function () {
    $.ajax({
        url: 'schedule/delete',
        data: '&id=' + eventId + '&_token=' + _token,
        type: "POST",
        dataType: "json",
        success: function (output) {
            $('#calendar_admin').fullCalendar('removeEvents', eventId);
            //console.log('Deleted Successfully');
        }
    });
    $("#deleteModal").modal('hide');
});

/** Save an event to database */
$("#save_btn").click(function () {
    var title = $("#event_title").val();
    if (title) {
        eventData = {
            title: title,
            start: startEvent,
            end: endEvent,
            color: color,
        };
        var Date = $.fullCalendar.formatDate(eventData.start, 'YYYY-MM-D');
        var startTime = $.fullCalendar.formatDate(eventData.start, 'HH:mm:ss');
        var endTime = $.fullCalendar.formatDate(eventData.end, 'HH:mm:ss');
        selected = $('.selectpicker').val();
    }; //else AN ERROR OCCURS

    //Send data as post request to server
    $.ajax({
        url: 'schedule/post',
        data: '&event_name=' + title + '&start_time=' + startTime +
        '&end_time=' + endTime + '&event_date=' + Date +
        '&_token=' + _token + '&event_color=' + color +
        '&assigned=' + selected,
        type: "POST",
        dataType: "json",
        success: function (output) {
            eventData.id = output;
            $('#calendar_admin').fullCalendar('renderEvent', eventData, true); // stick? = true
            $('#calendar_partTime').fullCalendar('renderEvent', eventData, true); // stick? = true
            $('#calendar_admin').fullCalendar('unselect');
        }
    });

    //Hide Modal
    $("#titleModal").modal('hide');
    //Clear the input for event title 
    $("#event_title").val("");
    //Clear color
    color = "";
});

/** Update an event to the database */
$("#update_btn").click(function(e){
    var title = $("#edit_event_title").val();
    selected = $('#editSelector').val();
    console.log(selected);
    if (title) {
        eventData = {
            title: title,
            start: startEvent,
            end: endEvent,
            color: color,
        };
    }
     $.ajax({
        url: 'schedule/update',
        data: '&event_name=' + title +
        '&event_color=' + color +
        '&id=' + eventId +
        '&assigned=' + selected + '&_token=' + _token,
        type: "POST",
        dataType: "json",
        success: function (output) {
            eventID = output['id']
            eventData.color = output['event_color'];
            eventData.id = eventID;
            $('#calendar_admin').fullCalendar( 'removeEvents', [eventID] );
            $('#calendar_admin').fullCalendar('renderEvent', eventData, true); // stick? = true
            $('#calendar_partTime').fullCalendar('renderEvent', eventData, true); // stick? = true
            $('#calendar_admin').fullCalendar('unselect');
        }
    });
    //Hide Modal
    $("#editModal").modal('hide');
    //Clear the input for event title 
    $("#edit_event_title").val("");
    //Clear Color
    color = "";
    // console.log('updated Successfully');
});

/** Modals Settings */
$('#deleteModal').on('show.bs.modal', function () {
    $('#close_modal2').focus()
});
$('#titleModal').on('show.bs.modal', function () {
    $('#event_title').focus()
    generateColors("#colorPicker");
    getAssignees(startEvent,endEvent);
})
$('#titleModal').on('hidden.bs.modal', function () {
    $("#colorPicker").empty();
    $('.selectpicker').empty();
    $('.selectpicker').selectpicker('refresh');
    selected.length = 0;
})
$('#editModal').on('show.bs.modal', function () {
    $('#edit_event_title').focus()
    generateColors("#colorPicker2");
    $('#schedule-div').removeClass('animated').removeClass('fadeInRight');
})
$('#editModal').on('hidden.bs.modal', function () {
    $("#colorPicker2").empty();
    $('.selectpicker').empty();
    $('.selectpicker').selectpicker('refresh');
    selected.length = 0;
})

$(document).ready(function () {

    // page is now ready, initialize the calendar...
    $('#calendar_admin').fullCalendar({

        eventRender: function (event, element) {
            element.prepend(
                '<span style = "margin-right: 5px; z-index:90;" ' +
                'class="removeEvent glyphicon glyphicon-trash pull-left"' +
                'id="Delete"></span>');
                console.log((event.assigned).length);
            if(event.assigned.length!=0){
                element.append('<br><b><u>Assigned:</b></u> <br>')
                $.each(event.assigned,function(index,person){
                    element.append(person + "<br>");
                });
            }
            
        },

        header: { center: 'month,agendaWeek,agendaDay' },
        defaultView: 'agendaWeek',
        weekends: false,
        minTime: "06:00:00",
        maxTime: "22:00:00",
        scrollTime: "22:00:00",
        allDaySlot: false,
        allDay:true,
        contentHeight: "auto",
        editable: true,
        selectable: true,
        events: '/schedule/fetch',

        /*Get Start and End times upon user selection*/
        select: function (start, end) {
            startEvent = start;
            endEvent = end;
            $("#titleModal").modal('show');
        },

        /*Update Schedule in case user changes date from one day to another*/
        eventDrop: function (event, delta) {
            selected = $('#editSelector').val();
            var Date = $.fullCalendar.formatDate(event.start, 'YYYY-MM-D');
            var startTime = $.fullCalendar.formatDate(event.start, 'HH:mm:ss');
            var endTime = $.fullCalendar.formatDate(event.end, 'HH:mm:ss');
            $.ajax({
                url: 'schedule/update',
                data: 'title=' + event.title + '&start_time=' + startTime + 
                    '&end_time=' + endTime + '&event_date=' + Date +
                    '&id=' + event.id + '&assigned=' + selected +
                    '&_token=' + _token,
                type: "POST",
                dataType: "json",
                success: function (output) {
                    // eventData.id = output;
                    //console.log('Updated Successfully');
                }
            });
        },

        /*Update Schedule in case user changes time*/
        eventResize: function (event) {
            selected = $('#editSelector').val();
            var Date = $.fullCalendar.formatDate(event.start, 'YYYY-MM-D');
            var startTime = $.fullCalendar.formatDate(event.start, 'HH:mm:ss');
            var endTime = $.fullCalendar.formatDate(event.end, 'HH:mm:ss');

            $.ajax({
                url: 'schedule/update',
                data: 'title=' + event.title + '&start_time=' + startTime +
                    '&end_time=' + endTime + '&event_date=' + Date +
                    '&id=' + event.id + '&assigned=' + selected +
                    '&_token=' + _token,
                type: "POST",
                dataType: "json",
                success: function (output) {
                   // eventData.id = output;
                   // console.log('updated Successfully');
                }
            });
        },

        /*Edit/Delete Schedule upon user click on event*/
        eventClick: function (calEvent, jsEvent, view) {
            eventId = calEvent.id;
            title = calEvent.title;
            startEvent = $.fullCalendar.formatDate(calEvent.start, 'D-MM-YYYY');
            endEvent = $.fullCalendar.formatDate(calEvent.start, 'HH:mm');
            data = title + " on " + startEvent +
                " from " +  endEvent +
                " to " + $.fullCalendar.formatDate(calEvent.end, 'HH:mm');

            if (jsEvent.target.id === 'Delete') {
                $("#event_delete").html(data);
                $("#deleteModal").modal('show');
            } else {
                $.ajax({
                    url: 'schedule/getScheduled',
                    data: 'eventId=' + eventId + '&_token=' + _token,
                    type: 'POST',
                    dataType: 'json',
                    success: function (output) {
                        assigned = output;
                        startEvent = calEvent.start;
                        endEvent = calEvent.end;
                        getAssignees(startEvent, endEvent);
                        $("#editModal").modal('show');
                        $(document).ajaxComplete(function(){
                            $('#edit_event_title').val(title);
                            color = calEvent.color;
                            $('i').removeClass('material-icons').html('');
                            $("[name*='"+color+"']").children("i").addClass('material-icons').html("check");
                            console.log(color);
                            $('.selectpicker').selectpicker();
                            $('.selectpicker').selectpicker('val',assigned);
                        });
                    }
                });
            }
        },
    });

    $('#calendar_partTime').fullCalendar({
        
        header: { center: 'month,agendaWeek,agendaDay' },
        defaultView: 'agendaWeek',
        weekends: false,
        minTime: "06:00:00",
        maxTime: "22:00:00",
        scrollTime: "22:00:00",
        allDaySlot: false,
        allDay:true,
        contentHeight: "auto",
        editable: false,
        selectable: false,
        events: '/schedule/fetch',
    });





});
