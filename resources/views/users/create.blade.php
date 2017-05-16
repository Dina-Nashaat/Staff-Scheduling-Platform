@extends('layouts.app')

@section('title', 'Main page')

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
                        </div>
                    </div>                        
                </div>
            </form>
        </div>
    </div>
@endsection
