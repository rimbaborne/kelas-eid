<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;


class DashboardController extends Controller
{

    public function data(Request $request)
    {
        $data = Transaction::where('status_pembayaran', 'paid')->where('user_id', auth()->user()->id)->where('kelas_id', 1)->first();
        return view('pages.data', compact('data'));
    }

    public function pembayaran(Request $request)
    {
        $transactions = Transaction::with('user')->latest()->get();
        return view('pages.pembayaran', compact('transactions'));
    }


}
