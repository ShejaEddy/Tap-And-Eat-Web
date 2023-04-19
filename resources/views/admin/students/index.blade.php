@extends('adminlte::page')

@section('title', 'List students')

@section('content_header')
    <h1>List Students</h1>
@stop
@section('plugins.Datatables', true)
@section('content')
    <div class="row justify-content-center">
        <!-- left column -->
        <div class="col-md-11">
            <!-- general form elements -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Students</h3>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>NO</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Balance</th>
                                <th>Added At</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($students as $student)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $student->name }}
                                    </td>
                                    <td>
                                        {{ $student->phoneNumber }}
                                    </td>
                                    <td>
                                        {{ number_format($student->balance) }} RWF
                                    </td>
                                    <td>
                                        {{ $student->created_at->toDateString() }}
                                    <td>
                                        @if($student->status==1)
                                            <span class="badge badge-success">
                                            Active
                                        </span>
                                        @else
                                            <span class="badge badge-success">
                                            Inactive
                                        </span>
                                        @endif
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
