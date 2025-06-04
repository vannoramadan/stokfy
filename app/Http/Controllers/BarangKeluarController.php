<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $barangKeluar = BarangKeluar::latest()->get();
        return view('barang_keluar.index', compact('barangKeluar'));
    }

    public function create()
    {
        return view('barang_keluar.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'tanggal_keluar' => 'required|date',
            'catatan' => 'nullable|string',
        ]);

        BarangKeluar::create([
            'nama_barang' => $request->nama_barang,
            'jumlah' => $request->jumlah,
            'tanggal_keluar' => $request->tanggal_keluar,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('barang-keluar.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $barang = BarangKeluar::findOrFail($id);
        return view('barang_keluar.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'tanggal_keluar' => 'required|date',
            'catatan' => 'nullable|string',
        ]);

        $barang = BarangKeluar::findOrFail($id);
        $barang->update([
            'nama_barang' => $request->nama_barang,
            'jumlah' => $request->jumlah,
            'tanggal_keluar' => $request->tanggal_keluar,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('barang-keluar.index')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy($id)
    {
        BarangKeluar::destroy($id);
        return back()->with('success', 'Data berhasil dihapus.');
    }
}
