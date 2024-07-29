<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Transaction;
use ProtoneMedia\Splade\Facades\Toast;
use App\Models\Peserta;
use Illuminate\Support\Facades\Storage;

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
                $judul = 'Ebook Langkah Pertama';
                $file  = 'entrepreneurID - Langkah Pertama';
                $pdf_  = 'https://drive.google.com/file/d/1Tqre698GCfV54KIoHBy53qQ249bIO3QK/preview';
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
                $judul = 'Ebook 100 Juta Pertama';
                $file  = 'entrepreneurID - 100 Juta Pertama';
                $pdf_  = 'https://drive.google.com/file/d/1XNp5cQqPEIUpRe_erCjVuG1JEmwBFVzh/preview';
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

    public function profit_video($link)
    {
        $check = Peserta::where('user_id', auth()->user()->id)->where('kelas_id', 1)->first();
        $data_video = [
            [ 'link_youtube' => 'DN6QmDpr0ZA', 'link' => '1' ],
            [ 'link_youtube' => 'DN6QmDpr0ZA', 'link' => '2' ],
            [ 'link_youtube' => 'DN6QmDpr0ZA', 'link' => '3' ]
        ];
        if($link == 1) {
            $judul = 'Materi Kelas Profit 10 Juta Part 1';
            $youtube_  = 'DN6QmDpr0ZA';
        } elseif($link == 2) {
            $judul = 'Materi Kelas Profit 10 Juta Part 2';
            $youtube_  = 'DN6QmDpr0ZA';
        } elseif($link == 3) {
            $judul = 'Materi Kelas Profit 10 Juta Part 3';
            $youtube_  = 'DN6QmDpr0ZA';
        }
        if(!null == $check) {
            return view('pages.kelas-profit-video', compact('judul', 'youtube_'));
        } else {
            Toast::warning('Anda Belum Memiliki Akses Kelas Ini !');
            return redirect()->route('dashboard.data');
        }
    }

    public function profit_checklist()
    {
        $check = Peserta::where('user_id', auth()->user()->id)->where('kelas_id', 1)->first();
        $json = Storage::disk('public')->get('/berkas/kelas/kelas-profit-10-juta/data-cek-list.json');
        $data = json_decode($json, true);
        $checklist = $data['data'];

        if(!null == $check) {
            return view('pages.kelas-profit-check-list', compact('checklist'));
        } else {
            Toast::warning('Anda Belum Memiliki Akses Kelas Ini !');
            return redirect()->route('dashboard.data');
        }
    }

    public function profit_checklist_data(){
        $json = file_get_contents(url('/').'/berkas/kelas/kelas-profit-10-juta/data-cek-list.json');
        $data = json_decode($json, true);
        $checklist = $data['data'];
        return response()->json($checklist);
    }

    public function profit_checklist_data_update(Request $request){
        $request->validate([
            'checkboxes' => 'required|array',
            'checkboxes.*.id' => 'required|integer',
            'checkboxes.*.checked' => 'required|boolean',
        ]);
        Toast::warning('Berhasil Diperbaruhi !');
        return response()->json(['success' => true]);
    }

    public function profit_mindmap()
    {
        $check = Peserta::where('user_id', auth()->user()->id)->where('kelas_id', 1)->first();
        if(!null == $check) {
            return view('pages.kelas-profit-mind-map');
        } else {
            Toast::warning('Anda Belum Memiliki Akses Kelas Ini !');
            return redirect()->route('dashboard.data');
        }
    }

    public function profit_resume()
    {
        $check = Peserta::where('user_id', auth()->user()->id)->where('kelas_id', 1)->first();
        if(!null == $check) {
            return view('pages.kelas-profit-resume');
        } else {
            Toast::warning('Anda Belum Memiliki Akses Kelas Ini !');
            return redirect()->route('dashboard.data');
        }
    }

    public function profit_slide()
    {
        $check = Peserta::where('user_id', auth()->user()->id)->where('kelas_id', 1)->first();
        if(!null == $check) {
            return view('pages.kelas-profit-slide');
        } else {
            Toast::warning('Anda Belum Memiliki Akses Kelas Ini !');
            return redirect()->route('dashboard.data');
        }
    }
}

