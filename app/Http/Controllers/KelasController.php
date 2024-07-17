<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class KelasController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        // Logika untuk menampilkan daftar kelas
    }

    function profit()
    {
        return view('pages.kelas-profit');
    }

    function profit_1()
    {
        return view('pages.kelas-profit');
    }

    function profit_2()
    {
        return view('pages.kelas-profit-2');
    }

    function profit_3()
    {
        return view('pages.kelas-profit');
    }

    public function create()
    {
        // Logika untuk menampilkan form pembuatan kelas
    }

    public function store(Request $request)
    {
        // Logika untuk menyimpan data kelas baru
    }

    public function show($id)
    {
        // Logika untuk menampilkan detail kelas berdasarkan ID
    }

    public function edit($id)
    {
        // Logika untuk menampilkan form edit kelas berdasarkan ID
    }

    public function update(Request $request, $id)
    {
        // Logika untuk memperbarui data kelas berdasarkan ID
    }

    public function destroy($id)
    {
        // Logika untuk menghapus data kelas berdasarkan ID
    }
}
