@extends('adminlte::page')

@section('title', 'List users')

@section('content_header')
    <h1>List users</h1>
@stop
@section('plugins.Datatables', true)
@section('content')
    <div class="row justify-content-center">
        <!-- left column -->
        <div class="col-md-11">
            <!-- general form elements -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List users</h3>
                    <a href="/user/create" class="btn btn-primary float-right">Create user</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>NO</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Modify</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ $user->name }}
                                </td>
                                <td>
                                    {{ $user->email }}
                                </td>
                                <td>
                                    {{ $user->role }}
                                </td>
                                <td>

                                    <form action="{{ route("user.destroy",$user->id) }}" method="post"
                                          onsubmit="return confirm('Delete the user?')">
                                        @csrf
                                        {{ method_field("DELETE") }}
                                        <button type="submit" class="btn btn-sm btn-danger">Del</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
@section("js")
    <script>
        $(".table").DataTable()
    </script>
@endsection
