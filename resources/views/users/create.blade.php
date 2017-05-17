@extends('layouts.app')

@section('title', 'Create User')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper-title">
                <h3><i class="fa fa-user-plus" aria-hidden="true"></i>Add New User</h3>
            </div> 
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <form method="post" action="{{ route('users.store') }}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" name="firstname" placeholder="first name" value="{{ old('firstname') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" name="lastname" placeholder="last name" value="{{ old('lastname') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Birthdate</label>
                                    <input type="date" name="birthdate" placeholder="Birthdate" value="{{ old('birthdate') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" placeholder="Password" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" name="password_confirmation" placeholder="Password" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <button type="submit">Create</button>
                            </div>
                        </div>
                    </div>                
                </div>
            </form>
        </div>
    </div>
@endsection
