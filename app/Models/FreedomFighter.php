<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreedomFighter extends Model
{
    use HasFactory;
    protected $fillable = [

        'employee_id',
        'freedom_fighter_num',
        'fighting_divi',
        'Sector',
        'status'
    ];
}
