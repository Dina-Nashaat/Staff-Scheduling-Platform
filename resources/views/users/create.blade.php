@extends('layouts.app')

@section('title', 'Create User')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper-title">
                <h1><i class="fa fa-user-plus" aria-hidden="true"></i> Add New User</h3>
            </div> 
        </div>
        <div class="wrapper wrapper-content animated fadeInRight" style="padding-left: 300px; padding-top:100px;">
            <form method="post" action="{{ route('users.store') }}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >First Name</label>
                                    <input type="text" name="firstname" class="form-control"
                                     placeholder="First Name" 
                                     value="@if(isset($user->firstname)){{$user->firstname}}@else{{old('firstname')}}@endif">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" name="lastname" class="form-control" placeholder="last name" 
                                    value="@if(isset($user->lastname)){{$user->lastname}}@else{{old('lastname')}}@endif">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Email" 
                                    value="@if(isset($user->email)){{$user->email}}@else{{old('email')}}@endif">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Birthdate</label>
                                    <input type="date" name="birthdate" class="form-control" placeholder="Birthdate"
                                     value="@if(isset($user->birthdate)){{$user->birthdate}}@else{{old('birthdate')}}@endif">
                                </div>
                            </div>
                        </div>
                        @if(!isset($user->id))
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Password" value="">
                                </div>
                            </div>
                        </div>
                        @endif
                            <button type="submit" class="btn btn-primary">@if(!isset($user->id)) Create @else Save @endif </button>
                            <input type="hidden" name = "user_id" value="@if(!isset($user->id)) {{0}} @else {{$user->id}} @endif">
                </div>
            </form>
        </div>
    </div>
@endsection
