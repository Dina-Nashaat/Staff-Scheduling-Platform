@extends('layouts.app')

@section('dependancies')
    <link rel='stylesheet' href='fullcalendar/fullcalendar.css' />
@endsection

@section('title', 'Schedule')

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
                                <div style="padding-top:10px;" id="colorPicker">
                                    Event Color : 
                                </div>
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
                            </div>>
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
<!--Passing blade options-->
<script>
    var userId = {{Auth::user()->id}}
</script>
<script src='js/schedule.js'></script>
@endsection