<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Pelanggan;
use Illuminate\Validation\Rule ;


class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Daftar kolom yang bisa difilter sesuai name pada form
        $filterableColumns = ['gender'];

        $searchableColumns = [
            'first_name',
            'last_name',
            'email'
        ];

        // Gunakan scope filter untuk memproses query
        $data['dataPelanggan'] = Pelanggan::filter($request, $filterableColumns)
                                    ->search($request, $searchableColumns)
                                    ->paginate(10)
                                    ->withQueryString();

        return view('admin.pelanggan.index', $data);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        return view('admin.pelanggan.create');
    }


    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
    {
        $validated = $request->validate([
        'first_name' => 'required',
        'last_name' => 'required',
        'birthday' => 'required|date',
        'gender' => 'required|in:Male,Female',
        'email' => 'required|email|unique:pelanggan,email',
        'phone' => 'required|numeric',
    ]);


    Pelanggan::create($validated);


    return redirect()
        ->route('pelanggan.index')
        ->with('success', 'Penambahan data berhasil!');
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
        $data['dataPelanggan'] = Pelanggan::findOrFail($id);
        return view('admin.pelanggan.edit', $data);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);


    $validated = $request->validate([
        'first_name' => 'required',
        'last_name' => 'required',
        'birthday' => 'required|date',
        'gender' => 'required|in:Male,Female',
        'email' => [
            'required',
            'email',
            Rule::unique('pelanggan', 'email')
                ->ignore($pelanggan->pelanggan_id, 'pelanggan_id'),
        ],
        'phone' => 'required|numeric',
    ]);


    $pelanggan->update($validated);


    return redirect()
        ->route('pelanggan.index')
        ->with('success', 'Perubahan data berhasil!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();


        return redirect()
            ->route('pelanggan.index')
            ->with('success', 'Data Berhasil Dihapus!');
    }
}
