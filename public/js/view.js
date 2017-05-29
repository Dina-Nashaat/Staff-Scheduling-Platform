$('.table-responsive').on('show.bs.dropdown', function () {
    $('.table-responsive').css("overflow", "inherit");
});

$('.table-responsive').on('hide.bs.dropdown', function () {
    $('.table-responsive').css("overflow", "auto");
})

var userID;
var eventID;

$(function () {

    //var eventDate = $("#eventDate").val();   

    $('form').on('submit', function (e) {

        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/availability/get',
            data: $('form').serialize(),
            success: function (output) {
                //Get list of events and availabilities

                var events = output.events;
                var availabilities = output.availabilities;

                $("#table-body").html('');
                $.each(availabilities, function (index, availability) {

                    var hiddenID = $("<input type=\"hidden\" id=userID" + index + " value=" + availability.user.id + ">");
                    var name = $("<td id= name" + index + "></td>>").append(availability.user.firstname + " " + availability.user.lastname);
                    var start_time = $("<td id=start" + index + "></td>>").append(availability.start_time);
                    var end_time = $("<td id=end" + index + "></td>>").append(availability.end_time);

                    var anchor = $("<td></td>>").append("<a id=\"assign\">Assign</a>");

                    var row = $("<tr></tr>>").append(hiddenID).append(name).append(start_time).append(end_time).append(anchor);


                    var dropdown = $("<div class=\"dropdown\"></div>")

                    var dbutton = $("<button type=\"button\" id=\"dropdownMenu1\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"true\"></button>")
                    dbutton.addClass("btn btn-default dropdown-toggle");
                    dbutton.text("None");
                    var span = $("<span class=\"caret\"></span>");
                    dbutton.append(span);

                    var ul = $("<ul class=\"dropdown-menu\"  aria-labelledby=\"dropdownMenu1\"></ul>");
                    dropdown.append(dbutton);

                    $.each(events, function (i, event) {
                        var liAnchor = $("<a></a>");
                        var hiddenID = $("<input type=\"hidden\" id=eventID" + index + " value=" + event.id + ">");
                        liAnchor.append(event.eventName);
                        var list = $("<li></li>").append(hiddenID);
                        $(ul).append(list.append(liAnchor));
                    });
                    var eventsList = $("<td id=\"eventDropdown\"></td>").append(dropdown.append(ul));
                    row.append(eventsList);
                    $("#table-body").append(row);
                });

            }
        });

    });

});
$(document.body).on('click', 'li>a', function (event) {
    var selText = $(this).text();
    var elementType = $(this).parent().parent().siblings(); //The button

    //Change button text
    elementType.html(selText + ' <span class="caret"></span>');

    //Change button ID
    eventID = $(this).siblings("input").val();
    elementType.attr("id", eventID);

    userID = $(event.target).parent().parent().parent().parent().siblings('input').val();
    //Check if user is already assigned
    $.ajax({
        url: '/schedule/checkIfUserScheduled',
        type: 'POST',
        data: 'eventID=' + eventID + '&userID=' + userID,
        dataType: 'json',
        success: function (exists) {
            if (exists)
                $(event.target).parent().parent().parent().parent().siblings('td').find('a').text("Withdraw");
        }
    });

});
var selEl = [];
$(document.body).on('click', '#assign', function (event) {
    userID = $(event.target).parent().parent().children('input').val();
    //Get Button from where a stands
    eventID = $(this).parent().siblings("#eventDropdown").children('.dropdown').children('button').attr('id');

    //TO HANDLE, what if selected none.--------------------
    $.ajax({
        url: '/schedule/assign',
        type: 'POST',
        data: 'eventID=' + eventID + "&userID=" + userID,
        dataType: "json",
        success: function (duplicate) {
            if (duplicate) {
                //Alert
                console.log("It's a duplicate. No one is assigned.'");
            }
            else {
                console.log("Addedd Successfully");
                $(event.target).html('Widthdraw');
                $(event.target).attr('id', 'withdraw');
            }
        }
    });


});