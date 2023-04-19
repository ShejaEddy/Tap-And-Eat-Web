@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
{{--   Cards for  "totalTransactions", "totalTransactionsAmount", "todayTransactionsAmount", "studentsNumber"--}}
    <div class="row">
        <div class="col-md-3">
            <div class="card card-body bg-red">
                {{ $totalTransactions }} Total Transactions
            </div>
        </div><div class="col-md-3 ">
            <div class="card card-body bg-blue">
                {{ $totalTransactionsAmount }} Total Amount Earned
            </div>
        </div><div class="col-md-3">
            <div class="card card-body bg-indigo">
                {{ $todayTransactionsAmount }} Today's Transactions amount
            </div>
        </div><div class="col-md-3">
            <div class="card card-body bg-green">
                {{ $studentsNumber}} Students number
            </div>
        </div>
    </div>

@stop

@section('css')
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
