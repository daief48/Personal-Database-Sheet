<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [

        'employee_id',
        'promotion_ref_number',
        'to_office',
        'from_office',
        'to_department',
        'from_department',
        'to_designation',
        'from_designation',
        'promotion_date',
        'description',
        'status',
    ];
}
