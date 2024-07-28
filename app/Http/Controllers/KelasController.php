<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Transaction;
use ProtoneMedia\Splade\Facades\Toast;
use App\Models\Peserta;

class KelasController extends BaseController
{
    public $check;
    public function __construct()
    {
    }
    public function index()
    {
        // Logika untuk menampilkan daftar kelas
    }

    public function profit()
    {
        $check = Peserta::where('user_id', auth()->user()->id)->where('kelas_id', 1)->first();
        if(!null == $check) {
            return view('pages.kelas-profit');
        } else {
            Toast::warning('Anda Belum Memiliki Akses Kelas Ini !');
            return redirect('dashboard.data');
        }
    }

    public function profit_1()
    {
        $check = Peserta::where('user_id', auth()->user()->id)->where('kelas_id', 1)->first();
        if(!null == $check) {
            return view('pages.kelas-profit-1');
        } else {
            Toast::warning('Anda Belum Memiliki Akses Kelas Ini !');
            return redirect()->route('dashboard.data');
        }
    }

    public function profit_2()
    {
        $check = Peserta::where('user_id', auth()->user()->id)->where('kelas_id', 1)->first();
        if(!null == $check) {
            return view('pages.kelas-profit-2');
        } else {
            Toast::warning('Anda Belum Memiliki Akses Kelas Ini !');
            return redirect()->route('dashboard.data');
        }
    }

    public function profit_pdf($link)
    {
        $check = Peserta::where('user_id', auth()->user()->id)->where('kelas_id', 1)->first();
        if(!null == $check) {
            $data_pdf = [
                [ 'nama' => 'Vitamin Finansial', 'link' => '1' ],
                [ 'nama' => 'Mulai dari Awal Lagi', 'link' => '2' ],
                [ 'nama' => '7 Ide Bisnis Puluhan Juta', 'link' => '3' ],
                [ 'nama' => 'Jangan Dulu Bisnis Sebelum Punya Ini', 'link' => '4' ],
                [ 'nama' => 'Agar Bisnismu Terus Tumbuh', 'link' => '5' ],
                [ 'nama' => 'Tembus Target Jualan Online', 'link' => '6' ],
                [ 'nama' => 'Rahasia Jualan Anti Gagal', 'link' => '7' ],
                [ 'nama' => 'Cara Konsiten Tanpa Tekanan', 'link' => '8' ],
                [ 'nama' => 'Waktu Pilihan Allah', 'link' => '9' ],
            ];
            if($link == 1) {
                $judul = 'Ebook Vitamin Finansial';
                $file  = 'entrepreneurID - Vitamin Finansial';
                $pdf_  = 'https://drive.google.com/file/d/1H_PPQ06b8UU-tZRBRwgsOqp7eY9hN59X/preview';
            } elseif($link == 2) {
                $judul = 'Ebook Mulai dari Awal Lagi';
                $file  = 'entrepreneurID - Mulai dari Awal Lagi';
                $pdf_  = 'https://drive.google.com/file/d/1pnqGmp7FeHx6cW_ZFAPp-m4ANvPcfA1E/preview';
            } elseif($link == 3) {
                $judul = 'Ebook 7 Ide Bisnis Puluan Juta';
                $file  = 'entrepreneurID - 7 Ide Bisnis Puluan Juta';
                $pdf_  = 'https://drive.google.com/file/d/15lAN1JK-oJbu0xQ5Ri4JKmKCC5B6tZ6r/preview';
            } elseif($link == 4) {
                $judul = 'Ebook Jangan Dulu Bisnis Sebelum Punya Ini';
                $file  = 'entrepreneurID - Jangan Dulu Bisnis Sebelum Punya Ini';
                $pdf_  = 'https://drive.google.com/file/d/1OtdCgkxvfNZnp5xGwYVtG03PxVqIFxXj/preview';
            } elseif($link == 5) {
                $judul = 'Ebook Agar Bisnismu Terus Tumbuh';
                $file  = 'entrepreneurID - Agar Bisnismu Terus Tumbuh';
                $pdf_  = 'https://drive.google.com/file/d/1y3NvPW23It0oUViNY1i_djjlZJIiuBUy/preview';
            } elseif($link == 6) {
                $judul = 'Ebook Tembus Target Jualan Online';
                $file  = 'entrepreneurID - Tembus Target Jualan Online';
                $pdf_  = 'https://drive.google.com/file/d/1Ug7C0NnfxxoCQ--a16e9rKc5L_9l2_Wo/preview';
            } elseif($link == 7) {
                $judul = 'Ebook Rahasia Jualan Anti Gagal';
                $file  = 'entrepreneurID - Rahasia Jualan Anti Gagal';
                $pdf_  = 'https://drive.google.com/file/d/1ZxQ75M_1TpamocVzKVP_yVL4v16kjy5w/preview';
            } elseif($link == 8) {
                $judul = 'Ebook Cara Konsisten Tanpa Tekanan';
                $file  = 'entrepreneurID - Cara Konsisten Tanpa Tekanan';
                $pdf_  = 'https://drive.google.com/file/d/1SpJQDQFWIlif_gEy3yPKm-2CBA7y9Tn7/preview';
            } elseif($link == 9) {
                $judul = 'Ebook Waktu Pilihan Allah';
                $file  = 'entrepreneurID - Waktu Pilihan Allah';
                $pdf_  = 'https://drive.google.com/file/d/1TJr6EmN5eU9yskmbr-0gRsm-VQcido57/preview';
            } else {
                $judul = 'Ebook Kelas Tidak Ada';
                $pdf_  = 'none';
            }
            return view('pages.kelas-profit-pdf', compact('pdf_', 'judul', 'file'));
        } else {
            Toast::warning('Anda Belum Memiliki Akses Kelas Ini !');
            return redirect()->route('dashboard.data');
        }
    }
}

