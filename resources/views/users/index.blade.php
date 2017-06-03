@extends('layouts.app')

@section('title', 'Main page')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="ibox">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-10">
                        
                    </div>
                    <div class="col-md-2">
                        <a class="btn btn-primary pull-right btn-md" href="{{ route('users.create') }}"><i class="fa fa-plus"></i> New User</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center m-t-lg">
                    <div class="table-responsive white-bg">
                    <table class="table table-striped table-hover datatables" > <style> td{text-align:left;} th{text-align:center;}}</style>
                        <thead>
                            <tr>
                                <th >Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Center</th>
                                <th>State</th>
                                <th class="hide"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->firstname }} {{ $user->lastname }}</td>
                                <td>{{ $user->email }}</td>
                                <td style="text-align:center;">{{ $user->role->role_name}}</td>
                                <td></td>
                                <td style="text-align:center;">{{ $user->state }}</td>
                                <td style="text-align:right;"><a href="#">Edit</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
