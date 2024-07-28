<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Peserta;


class DashboardController extends Controller
{

    public function data(Request $request)
    {
        $data = Peserta::where('user_id', auth()->user()->id)->where('kelas_id', 1)->first() ?? null;
        return view('pages.data', compact('data'));

    }

    public function pembayaran(Request $request)
    {
        // $data = Transaction::where('status_pembayaran', 'paid')->where('user_id', auth()->user()->id)->where('kelas_id', 1)->first() ?? null;
        $data = Transaction::where('user_id', auth()->user()->id)->where('kelas_id', 1)->first() ?? null;

        return view('pages.pembayaran', compact('data'));
    }


}
