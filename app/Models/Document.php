<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'details',
        'thumbnail',
        'document_type',
        'present_date',
        'day',
        'event_id',
        'file',
        'status',
        'session',
        'presented_by'
    ];
}
