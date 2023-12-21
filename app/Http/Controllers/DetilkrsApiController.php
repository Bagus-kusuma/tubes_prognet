<?php

namespace App\Http\Controllers;

use App\Models\detilkrs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DetilkrsApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return detilkrs::all();
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
        $detilkrs = new detilkrs();
        $detilkrs->fill($request->all())->save();
        return $detilkrs;
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
        $detilkrs = detilkrs::find($id);
        $detilkrs->fill($request->all())->save();
        return $detilkrs;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $detilkrs = detilkrs::find($id);
        $detilkrs->delete();
    }
}
