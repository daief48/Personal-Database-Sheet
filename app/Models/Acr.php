<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acr extends Model
{
    use HasFactory;
    protected $fillable = [
        'emp_id',
        'emp_name',
        'designation',
        'department',
        'office_name',
        'acr_year',
        'score',
        'file',
        'remarks',
        'status',
    ];
}