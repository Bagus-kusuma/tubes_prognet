<?php

namespace App\Http\Controllers;

use App\Models\mahasiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MahasiswaApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return mahasiswa::all();
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
        $mahasiswa = new Mahasiswa();
        $mahasiswa->fill($request->all())->save();
        return $mahasiswa;
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
        $mahasiswa = mahasiswa::find($id);
        $mahasiswa->fill($request->all())->save();
        return $mahasiswa;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mahasiswa = mahasiswa::find($id);
        $mahasiswa->delete();
    }
}
