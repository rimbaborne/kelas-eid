<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;


class DashboardController extends Controller
{

    public function data(Request $request)
    {
        $transactions = Transaction::with('user')->latest()->get();
        return view('pages.data');
    }

    public function pembayaran(Request $request)
    {
        $transactions = Transaction::with('user')->latest()->get();
        return view('pages.pembayaran', compact('transactions'));
    }


}
