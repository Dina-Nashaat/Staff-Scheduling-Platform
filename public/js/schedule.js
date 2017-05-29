/* Global Variables */
var _token = $('#_token').val();
var eventId, startEvent, endEvent, color, selectedStartTime, selectedEndTime;

/** Create multiple colors */
function generateColors() {
    colors = ['#B71C1C', '#880E4F', '#4A148C', '#311B92', '#E65100', '#212121', '#0D47A1', '#FF6F00'];
    $("#colorPicker").append('Event Color : ');
    $.each(colors, function (i, color) {
        var span = $('<a><span id = "color" name = "' + color + '" style = "padding-left:15px; margin-left: 2px;margin-right: 3px;font-size:14px; background-color:' + color + '">&nbsp;</span></a>');
        console.log(span);
        $('#colorPicker').append(span);
    });
}

/** Get people scheduled at the specified time */
function getAssignees() {
    console.log("I'm getting the YLAs available");
    eventData = {
        start: startEvent,
        end: endEvent,
        color: color,
    };
    var Date = $.fullCalendar.formatDate(eventData.start, 'YYYY-MM-D');
    var startTime = $.fullCalendar.formatDate(eventData.start, 'hh:mm:s s');
    var endTime = $.fullCalendar.formatDate(eventData.end, 'hh:mm:ss');
    $.ajax({
        type: 'POST',
        url: '/availability/availableAtTime',
        data: '&start_time=' + startTime + '&end_time=' + endTime + '&event_date=' + Date + '&_token=' + _token,
        success: function (output) {
            var availabilities = output;
            var users = [];
            $.each(availabilities, function (i, availability) {
                $('.selectpicker').append('<option value =' + availability.user.id +
                    '>' + availability.user.firstname + '</option>')
                $('.selectpicker').selectpicker('refresh');
            });
            console.log(users)
        }
    });
}

$(document.body).on('click', '#color', function getColor(event) {
    color = $(event.target).attr('name');
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
            $('#calendar').fullCalendar('removeEvents', eventId);
            console.log('Deleted Successfully');
        }
    });
    $("#deleteModal").modal('hide');
});

var selected = []
    $('.selectpicker').on('change', function () {
        selected = $('.selectpicker').val();
        console.log(selected); //Get the multiple values selected in an array
        console.log(selected.length); //Length of the array
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
        console.log(eventData);
        var Date = $.fullCalendar.formatDate(eventData.start, 'YYYY-MM-D');
        var startTime = $.fullCalendar.formatDate(eventData.start, 'hh:mm:ss');
        var endTime = $.fullCalendar.formatDate(eventData.end, 'hh:mm:ss');
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
            $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
            $('#calendar').fullCalendar('unselect');
        }
    });

    //Hide Modal
    $("#titleModal").modal('hide');
    //Clear the input for event title 
    $("#event_title").val("");
});

/** Set focus on Input in Add Event Modal */
$('#deleteModal').on('show.bs.modal', function () {
    $('#close_modal2').focus()
});

$('#titleModal').on('show.bs.modal', function () {
    $('#event_title').focus()
    generateColors();
    getAssignees();
})

$('#titleModal').on('hidden.bs.modal', function () {
    $("#colorPicker").empty();
    $('.selectpicker').empty();
    $('.selectpicker').selectpicker('refresh');
    selected.length = 0;
    console.log(selected);
})

$(document).ready(function () {

    // page is now ready, initialize the calendar...
    $('#calendar').fullCalendar({

        eventRender: function (event, element) {
            element.html('<span style = "margin-right: 5px;" class="removeEvent glyphicon glyphicon-trash pull-left" id="Delete"></span>'
                + event.title);
        },

        header: { center: 'month,agendaWeek,agendaDay' },
        defaultView: 'agendaWeek',
        weekends: false,
        minTime: "06:00:00",
        maxTime: "22:00:00",
        scrollTime: "22:00:00",
        allDaySlot: false,
        contentHeight: "auto",
        editable: true,
        selectable: true,
        events: '/schedule/fetch',
        //theme: true,

        /*Get Start and End times upon user selection*/
        select: function (start, end) {
            startEvent = start;
            endEvent = end;
            $("#titleModal").modal('show');
        },

        /*Update Schedule in case user changes date from one day to another*/
        eventDrop: function (event, delta) {
            var Date = $.fullCalendar.formatDate(event.start, 'YYYY-MM-D');
            var startTime = $.fullCalendar.formatDate(event.start, 'hh:mm:ss');
            var endTime = $.fullCalendar.formatDate(event.end, 'hh:mm:ss');
            $.ajax({
                url: 'schedule/update',
                data: 'title=' + event.title + '&startTime=' + startTime + '&endTime=' + endTime + '&Date=' + Date + '&id=' + event.id + '&_token=' + _token,
                type: "POST",
                dataType: "json",
                success: function (output) {
                    eventData.id = output;
                    console.log('Updated Successfully');
                }
            });
        },

        /*Update Schedule in case user changes time*/
        eventResize: function (event) {
            var Date = $.fullCalendar.formatDate(event.start, 'YYYY-MM-D');
            var startTime = $.fullCalendar.formatDate(event.start, 'hh:mm:ss');
            var endTime = $.fullCalendar.formatDate(event.end, 'hh:mm:ss');

            $.ajax({
                url: 'schedule/update',
                data: 'title=' + event.title + '&startTime=' + startTime + '&endTime=' + endTime + '&Date=' + Date + '&id=' + event.id + '&_token=' + _token,
                type: "POST",
                dataType: "json",
                success: function (output) {
                    eventData.id = output;
                    console.log('updated Successfully');
                }
            });
        },

        /*Delete schedule in case user clicks on the delete icon on the event*/
        eventClick: function (calEvent, jsEvent, view) {
            eventId = calEvent._id;
            title = calEvent.title;
            data = title + " on " + $.fullCalendar.formatDate(calEvent.start, 'D-MM-YYYY') +
                " from " + $.fullCalendar.formatDate(calEvent.start, 'hh:mm') +
                " to " + $.fullCalendar.formatDate(calEvent.end, 'hh:mm');
            console.log(eventId, title);
            if (jsEvent.target.id === 'Delete') {
                $("#event_delete").html(data);
                $("#deleteModal").modal('show');
            }
        },
    });
});