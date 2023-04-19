<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalTransactionsAmount = \App\Transaction::sum("amount");
        $todayTransactionsAmount = \App\Transaction::whereDate("created_at", date("Y-m-d"))->sum("amount");
        $totalTransactions = \App\Transaction::count();
        $studentsNumber = \App\Student::count();
        return view('home', compact("totalTransactions", "totalTransactionsAmount", "todayTransactionsAmount", "studentsNumber"));
    }
}
