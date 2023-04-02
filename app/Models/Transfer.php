<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    protected $fillable = [

        'to_office',
        'department',
        'designation',
        'transfer_order',
        'transfer_type',
        'transfer_date',
        'join_date',
        'transfer_letter',
        'status',
    ];
}
