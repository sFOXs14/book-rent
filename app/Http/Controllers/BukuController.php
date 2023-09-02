<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;


class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $buku = Buku::
        where('judul', 'LIKE', '%'.$search.'%')
        ->orWhere('penulis', 'LIKE', '%'.$search.'%')
        ->orWhere('kategori', 'LIKE', '%'.$search.'%')->simplePaginate(3);
        return view('buku', ['buku' => $buku]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tambah-buku');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $uploadedFile = $request->file('cover');
        $newFilename = $request->input('judul') . '-' . time() . '.' . $uploadedFile->getClientOriginalExtension();

        $newImage = $uploadedFile->storeAs('cover', $newFilename, 'public');

        $buku = Buku::create(
            [
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'penulis' => $request->penulis,
                'kategori' => $request->kategori,
                'tgl_terbit' => $request->tgl_terbit,
                'cover' => $newImage
            ]
        );

        if($buku) {
            Session::flash('status', 'success');
            Session::flash('message', 'Berhasil Menambahkan Data Buku');
        }

        return redirect('/');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Buku $buku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Buku $buku, $id)
    {
        $buku = Buku::findOrFail($id);
        return view ('edit-buku', ['buku' => $buku]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Buku $buku, $id)
{
    $buku = Buku::findOrFail($id);

    if ($request->hasFile('cover')) {
        $uploadedFile = $request->file('cover');
        $newFilename = $request->input('judul') . '-' . time() . '.' . $uploadedFile->getClientOriginalExtension();
        $imagePath = $uploadedFile->storeAs('cover', $newFilename, 'public');
        $buku->cover = $imagePath;
    }

    $buku->judul = $request->judul;
    $buku->penulis = $request->penulis;
    $buku->deskripsi = $request->deskripsi;
    $buku->tgl_terbit = $request->tgl_terbit;
    $buku->kategori = $request->kategori;
    $buku->save();

    if($buku) {
        Session::flash('status', 'success');
        Session::flash('message', 'Berhasil Update Data Buku');
    }

    return redirect('/');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buku $buku, $id)
    {
        $buku = Buku::findOrFail($id);
        $imagePath = $buku->cover;
        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
    
        $buku->delete();

        if($buku) {
            Session::flash('status', 'success');
            Session::flash('message', 'Berhasil Menghapus Data Buku');
        }

        return redirect('/');
    }
}
