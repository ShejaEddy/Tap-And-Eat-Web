@extends('adminlte::page')

@section('title', 'Payments transactions')

@section('content_header')
    <h1>Payment transactions</h1>
@stop
@section('plugins.Datatables', true)
@section('content')
    <div class="row justify-content-center">
        <!-- left column -->
        <div class="col-md-11">
            <!-- general form elements -->
            <div class="card">
                <div class="card-header">

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>NO</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Payment Method</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Created At</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $transaction->student->name }}
                                    </td>
                                    <td>
                                        {{ $transaction->student->phoneNumber }}
                                    </td>
                                    <td>
                                        {{ $transaction->payment_mode }}
                                    </td>
                                    <td>
                                        {{ number_format($transaction->amount) }} RWF
                                    </td>
                                    <td>
                                        @if($transaction->status == 'PENDING')
                                            <span class="badge badge-info">{{ $transaction->status }}</span>
                                        @elseif($transaction->status == 'FAILED')
                                            <span class="badge badge-danger">{{ $transaction->status }}</span>
                                        @else
                                            <span class="badge badge-success">{{ $transaction->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $transaction->created_at->toDateString() }}
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
