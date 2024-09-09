<?php

namespace App\Http\Controllers;

use App\Models\Cicilan;
use Illuminate\Http\Request;

class CicilanController extends Controller
{
    public function index()
    {
        $cicilan = Cicilan::all();
        return view('cicilan.index', compact('cicilan'));
    }

    public function store(Request $request)
    {
        $cicilan = Cicilan::create($request->all());
        return redirect()->route('cicilan.index')->with('success', 'Cicilan berhasil ditambahkan');
    }

    public function show(Cicilan $cicilan)
    {
        return view('cicilan.show', compact('cicilan'));
    }

    public function update(Request $request, Cicilan $cicilan)
    {
        $cicilan->update($request->all());
        return redirect()->route('cicilan.index')->with('success', 'Cicilan berhasil diperbarui');
    }

    public function destroy(Cicilan $cicilan)
    {
        $cicilan->delete();
        return redirect()->route('cicilan.index')->with('success', 'Cicilan berhasil dihapus');
    }
}
