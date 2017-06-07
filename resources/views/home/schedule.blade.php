@extends('layouts.app')

@section('dependancies')
    <link rel='stylesheet' href='fullcalendar/fullcalendar.css' />
    <link rel='stylesheet' href='fullcalendar/fullcalendar.print.css' media='print'/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

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
                            @if (Auth::user()->hasPermissions(['set_schedule_all']))
                                <small>
                                    Add Schedule of Events
                                </small>
                            @else
                                <small>
                                    View Schedule of Events
                                </small>
                            @endif

                            @if (Auth::user()->hasPermissions(['set_schedule_all']))
                                <div id='calendar_admin' style="background:#fafafc;"></div>
                            @else
                                <div id='calendar_partTime' style="background:#fafafc;"></div>
                            @endif
                        </div>
                    </div>
                </div>
                
                @if (Auth::user()->hasPermissions(['add_event']))
                <!-- Event Title Modal -->
                <div class="modal fade" id="titleModal" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Enter Event Title</h4>
                            </div>
                            <div class="modal-body">
                                <input id="event_title" class="form-control">
                                <div style="padding-top:10px;  margin-bottom:10px;" id="colorPicker"></div>
                                <select class="selectpicker" multiple>
                                </select>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default"  data-dismiss="modal" id="close_modal">Close</button>
                                <button type="button" class="btn btn-primary" id="save_btn">Save changes</button>
                            </div>
                        </div>        
                    </div>
                </div>
                @endif
                
                @if (Auth::user()->hasPermissions(['delete_event']))
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
                @endif
                
                @if (Auth::user()->hasPermissions(['edit_event']))
                <!-- Edit Event -->
                <div class="modal fade" id="editModal" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Edit Event</h4>
                            </div>
                            <div class="modal-body">
                                <input id="edit_event_title" class="form-control">
                                <div style="padding-top:10px; margin-bottom:10px;" id="colorPicker2"></div>
                                <select  class="selectpicker" id = "editSelector" multiple>
                                        
                                </select>

                            </div>
                            <div class="modal-footer">  
                                <button type="button" class="btn btn-default"  data-dismiss="modal" id="close_modal">Close</button>
                                <button type="button" class="btn btn-primary" id="update_btn">Update</button>
                            </div>
                        </div>        
                    </div>
                </div>
                @endif
    </div>
@endsection
@section('scripts')
<script src='lib/moment.min.js'></script>
<script src='fullcalendar/fullcalendar.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
<script type="text/javascript">
    $('.selectpicker').selectpicker({
      });
</script>
<!--Passing blade options-->
<script>
    var userId = {{Auth::user()->id}}
</script>
<script src='js/schedule.js'></script>
@endsection