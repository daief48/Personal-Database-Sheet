<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    protected $fillable = [

        'employee_id',
        'to_office',
        'from_office',
        'to_department',
        'from_department',
        'to_designation',
        'from_designation',
        'transfer_order',
        'transfer_order_number',
        'transfer_type',
        'transfer_date',
        'join_date',
        'transfer_letter',
        'status',
    ];
}
