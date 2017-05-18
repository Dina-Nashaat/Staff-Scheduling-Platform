@extends('layouts.app')

@section('title', 'YLA Availabilty')

@section('content')
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
                                     <input type="date" name="eventdate" id="eventDate">
                                     <button type="submit" class="btn btn-primary">Fetch</button>
                                 </form>
                            {!! Form::close() !!}
							</div>
							<div class="row">
            <div class="col-lg-12">
                <div class="text-center m-t-lg">
                    <div class="table-responsive white-bg">
                    <table class="table table-striped table-hover datatables" >
                        <thead>
                           <th style="text-align: center;">Name</th>
                           <th style="text-align: center;">Start Time</th>
                           <th style="text-align: center;">End Time</th>
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
        $(function () {

        $('form').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: '/availability/get',
            data: $('form').serialize(),
            success: function (d) {
                $.each(JSON.parse(d), function (i, val) {
                    var row = document.createElement('tr');

                    console.log(val);
                    var user = document.createElement('td');
                    $(user).append(val.user.firstname + " " + val.user.lastname);
                    
                    var start = document.createElement('td');
                    $(start).append(val.start_time);
                    
                    var end = document.createElement('td');
                    $(end).append(val.end_time);
                    
                    $(row).append(user);
                    $(row).append(start);
                    $(row).append(end);

                    $("#table-body").append(row);
                });
                
            },
            beforeSend: function () {
                $("#loading").show();
            },
            complete: function () {
                $("#loading").hide();
            }
          });

        });

      });
    </script>

@endsection
