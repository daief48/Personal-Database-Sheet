<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $fillable = [

        'training_name',
        'training_center_name',
        'training_score',
        'training_feedback',
        'training_strt_date',
        'training_end_date',
        'description',
        'status',
    ];
}
