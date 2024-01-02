<?php

namespace App\Http\Controllers;

use App\Models\matakuliah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MatakuliahApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return matakuliah::all();
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
        $matakuliah = new matakuliah();
        $matakuliah->fill($request->all())->save();
        return $matakuliah;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return matakuliah::find($id);
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
        $matakuliah = matakuliah::find($id);
        $matakuliah->fill($request->all())->save();
        return $matakuliah;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $matakuliah = matakuliah::find($id);
        $matakuliah->delete();
    }
}
