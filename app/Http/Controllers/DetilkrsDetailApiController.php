<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\detilkrs;
use App\Models\mahasiswa;
use App\Models\matakuliah;

class DetilkrsDetailApiController extends Controller
{
    public function showDetailNilai(string $id)
    {
        // Find detilkrs data where mahasiswa_id matches $id
        $detilkrs = detilkrs::where('mahasiswa_id', $id)->get();

        // Check if detilkrs data exists
        if (!$detilkrs) {
            return response()->json(['message' => 'Detilkrs not found'], 404);
        }


        // Return the entire detilkrs collection
        return response()->json(['detilkrs' => $detilkrs]);
    }

    public function showDetailDataMhs(string $id)
    {
        // Find detilkrs data where mahasiswa_id matches $id
        $detilkrs = detilkrs::where('mahasiswa_id', $id)->first();

        // Check if detilkrs data exists
        if (!$detilkrs) {
            return response()->json(['message' => 'Detilkrs not found'], 404);
        }

        // Return the entire detilkrs collection
        return response()->json(['detilkrs' => $detilkrs]);
    }
}
