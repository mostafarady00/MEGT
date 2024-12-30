<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Numberspeak extends Model
{
    use HasFactory;

    protected $fillable = [
        'percentage',
    ];

    public function getPercentageAttribute($value)
    {
        return $value . '%';
    }

    public function setPercentageAttribute($value)
    {
        $this->attributes['percentage'] = rtrim($value, '%');
}
}
