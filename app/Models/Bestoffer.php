<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bestoffer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'telephone_number',
        'receipt_country',
        'import_country',
        'pickup_city',
        'number_of_packages',
        'gross_weight',
        'type_of_service',
        'details',
    ];
}
