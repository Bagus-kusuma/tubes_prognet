<?php

namespace App\Http\Controllers;

use App\Models\agama;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AgamaApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return agama::all();
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
        $agama = new Agama();
        $agama->fill($request->all())->save();
        return $agama;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return agama::find($id);
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
        $agama = agama::find($id);
        $agama->fill($request->all())->save();
        return $agama;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $agama = agama::find($id);
        $agama->delete();
    }
}
