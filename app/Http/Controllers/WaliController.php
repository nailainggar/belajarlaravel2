<?php

namespace App\Http\Controllers;

use App\Wali;
use Illuminate\Http\Request;

class WaliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wali = Wali::with('mhs')->get();
        return view('wali.index',compact('wali'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $wali = Wali::all();
        return view('wali.create',compact('mhs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $wali = new Wali();
        $wali->nama = $request->nama;
        $wali->id_mahasiswa  $request->id_mahasiswa;
        $wali->save();
        return redirect()->route('wali.index')->with(['message' > 'Data Wali Berhasil DIbuat'])
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Wali  $wali
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mhs  Mahasiswa::all();
        $wali = Wali::findOrFail($id);
        return view('wali.show', compact('wali'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Wali  $wali
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mhs = Mahasiswa::all();
        $wali = Wali::findOrFail($wali->id);
        return view('wali.edit', compact('wali','mhs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Wali  $wali
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wali $wali)
    {
        $wali = Wali::findOrFail($wali->id);
        $wali->nama = $request->nama;
        $wal->id_mahasiswa = $request->id_mahasiswa;
        $wali->save();
        return redirect()->route('wali.index')->with(['message' => 'Data Berhasil diubah']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Wali  $wali
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wali $wali)
    {
        $wali = Mahasiswa::findOrFail($wali->id)->delete();
        return redirect()->route('wali.index')-with(['message' => 'Data Berhasil dihapus']);
    }
}
