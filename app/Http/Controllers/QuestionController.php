<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Jalankan Validasi Terlebih Dahulu
        $request->validate([
            'nama'       => 'required|min:5',
            'email'      => 'required|email',
            'pertanyaan' => 'required|min:10|max:300',
        ], [
            // Custom Error Messages (Bahasa Indonesia)
            'nama.required'       => 'Nama wajib diisi.',
            'nama.min'            => 'Nama minimal harus 5 karakter.',
            'email.required'      => 'Email wajib diisi.',
            'email.email'         => 'Format email tidak valid.',
            'pertanyaan.required' => 'Pertanyaan wajib diisi.',
            'pertanyaan.min'      => 'Pertanyaan minimal harus 10 karakter.',
            'pertanyaan.max'      => 'Pertanyaan maksimal 300 karakter.',
        ]);

        // 2. Ambil data dari form input (dijalankan HANYA JIKA validasi lolos)
        $nama       = $request->input('nama');
        $email      = $request->input('email');
        $pertanyaan = $request->input('pertanyaan');

        // 3. Return view dengan membawa data
        return view('home-question-respon', compact('nama', 'email', 'pertanyaan'));
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
