<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;
        protected $fillable = ['title_ar','title_en', 'image', 'description_ar','description_en'];

}