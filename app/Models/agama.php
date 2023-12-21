<?php

namespace App\Models;

use App\Models\agama;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class agama extends Model
{
    use HasFactory;
    protected $fillable = [
        'agama',
    ];
}
