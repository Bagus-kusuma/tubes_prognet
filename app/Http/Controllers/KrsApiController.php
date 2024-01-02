<?php

namespace App\Http\Controllers;

use App\Models\krs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KrsApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return krs::all();
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
        $krs = new Krs();
        $krs->fill($request->all())->save();
        return $krs;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return krs::find($id);
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
        $krs = krs::find($id);
        $krs->fill($request->all())->save();
        return $krs;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $krs = krs::find($id);
        $krs->delete();
    }
}
