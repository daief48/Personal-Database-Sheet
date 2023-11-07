<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'grade',
        'basic_pay',
        'medical_allowance',
        'house_rent',
        'others',
        'salary_amount',
        'status',
    ];
}
