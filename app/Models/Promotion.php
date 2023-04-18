<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [

        'name',
        'promotion_ref_number',
        'promoted_designation',
        'promotion_date',
        'description',
        'status',
    ];
}
