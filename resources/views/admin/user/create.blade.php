@extends('adminlte::page')

@section('title', 'Create A user')

@section('content_header')
    <h1>Create user</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <!-- left column -->
        <div class="col-md-8">
            <!-- general form elements -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create a user</h3>
                    <a href="/user" class="btn btn-primary float-right">List users</a>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{ route("user.store") }}">
                    @include("admin.user._form",["btnText"=>"Create User"])
                </form>
            </div>
        </div>
    </div>
@stop
