<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Internationaltrad extends Model
{
    use HasFactory;
    protected $fillable = [
        'title_ar', 'title_en', 'image', 'itemone_ar', 'itemone_en', 'answerone_ar', 'answerone_en',
        'itemtwo_ar', 'itemtwo_en', 'answertwo_ar', 'answertwo_en',
    ];

}
