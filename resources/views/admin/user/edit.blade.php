@extends('adminlte::page')

@section('title', 'Edit A user')

@section('content_header')
    <h1>Update Profile</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <!-- left column -->
        <div class="col-md-8">
            <!-- general form elements -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Update Profile</h3>

                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{ route("user.update",$user->id) }}">
                    {{ method_field("PUT") }}
                    @include("admin.user._form_update",["btnText"=>"Update Profile"])
                </form>
            </div>
        </div>
    </div>
@stop
