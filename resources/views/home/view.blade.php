@extends('layouts.app')

@section('title', 'YLA Availabilty')


@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center m-t-lg">
                            <h1>
                                View Availabilty of YLA
                            </h1>
							<small>
                                Pick a date
                            </small>
                            <div>
							{!! Form::open(['url'=>'availability/view']) !!}
                                    Date:
                                     <input type="date" name="eventdate" id="eventDate" value="2017-05-15">
                                     <button type="submit" class="btn btn-primary">Fetch</button>
                            {!! Form::close() !!}
							</div>
							<div class="row">
            <div class="col-lg-12">
                <div class="text-center m-t-lg">
                    <div class="table-responsive white-bg">
                    <table class="table table-striped table-hover" >
                        <thead>
                           <th style="text-align: center;">Name</th>
                           <th style="text-align: center;">Start Time</th>
                           <th style="text-align: center;">End Time</th>
                           <th style="text-align: center;">Assign YLA</th>
                           <th style="text-align: center;">Shift to Assign</th>
                        </thead>
                        <tbody id="table-body">
                        </tbody>
                    </table>
                    <div id="show"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

@endsection

@section('scripts')
    <script>
        $('.table-responsive').on('show.bs.dropdown', function () {
            $('.table-responsive').css( "overflow", "inherit" );
        });

        $('.table-responsive').on('hide.bs.dropdown', function () {
            $('.table-responsive').css( "overflow", "auto" );
        })


        $(function () {

        var eventDate = $("#eventDate").val();   

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
            data: "eventdate="+ eventDate,
            success: function (output) { 
                //Get list of events and availabilities
                
                var events = output.events;
                var availabilities = output.availabilities;
                
                $.each(availabilities, function(index, availability ) {
                    
                    var name = $("<td></td>>").append(availability.user.firstname + " " + availability.user.lastname);
                    var start_time = $("<td></td>>").append(availability.start_time);
                    var end_time = $("<td></td>>").append(availability.end_time);
                    var anchor = $("<td></td>>").append("<a href=\"#\">Assign</a>");

                    var row = $("<tr></tr>>").append(name).append(start_time).append(end_time).append(anchor);
                    

                    var dropdown = $("<div class=\"dropdown\"></div>")
                    
                    var dbutton = $("<button type=\"button\" id=\"dropdownMenu1\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"true\"></button>")
                    dbutton.addClass("btn btn-default dropdown-toggle");
                    dbutton.text("None");
                    var span = $("<span class=\"caret\"></span>");
                    dbutton.append(span);

                    var ul = $("<ul class=\"dropdown-menu\"  aria-labelledby=\"dropdownMenu1\"></ul>");
                    dropdown.append(dbutton);
                    
                    $.each(events, function(i, event){
                        var liAnchor = $("<a></a>");
                        liAnchor.append(event.eventName);
                        $(ul).append($("<li></li>").append(liAnchor));
                    });
                   var eventsList = $("<td></td>").append(dropdown.append(ul));
                   row.append(eventsList);
                   $("#table-body").append(row);
                });
                
            }
          });

        });

      });
        $(document.body).on('click','li>a',function(){
            console.log("ay 7aga  ya 3am");
            var selText = $(this).text();
            console.log(selText);
            var elementType = $(this).parent().parent().siblings().html(selText+' <span class="caret"></span>');
            console.log(elementType); 
    });
    </script>

@endsection
