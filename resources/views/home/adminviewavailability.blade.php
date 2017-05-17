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
							    <form>
                                    Date:
                                     <input type="date" name="eventdate" id="eventDate">
                                 </form>
							</div>
							<div class="row">
            <div class="col-lg-12">
                <div class="text-center m-t-lg">
                    <div class="table-responsive white-bg">
                    <table class="table table-striped table-hover datatables" >
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Center</th>
                                <th>State</th>
								<th>Time</th>
                                <th class="hide"></th>
                            </tr>
                        </thead>
                    </table>
                    </div>
                </div>
            </div>
        </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection

