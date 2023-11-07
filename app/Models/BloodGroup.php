<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodGroup extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'blood_group',
        'last_donate',
        'status',
    ];
}
