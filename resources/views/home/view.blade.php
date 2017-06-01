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
                                Date:
                                    <input type="date" name="eventdate" id="eventDate">
                                    <button type="submit" class="btn btn-primary">Fetch</button>
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
    <script src='js/view.js'></script>
@endsection
