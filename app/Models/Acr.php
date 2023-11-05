<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acr extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'emp_name',
        'designation',
        'department',
        'office_name',
        'acr_year',
        'score',
        'file',
        'rack_number',
        'bill_number',
        'file_number',
        'remarks',
        'status',
    ];
}
