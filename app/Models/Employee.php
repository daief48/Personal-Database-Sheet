<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'image',
        'name',
        'mobile_number',
        'email',
        'date_of_birth',
        'blood_group',
        'nid_number',
        'passport_number',
        'designation',
        'present_addr_houseno',
        'present_addr_roadno',
        'present_addr_area',
        'present_addr_upazila',
        'present_addr_district',
        'present_addr_postcode',
        'permanent_addr_houseno',
        'permanent_addr_roadno',
        'permanent_addr_area',
        'permanent_addr_upazila',
        'permanent_addr_district',
        'permanent_addr_postcode',
        'department',
        'job_location',
        'joining_date',
        'father_name',
        'mother_name',
        'spouse_name',
        'number_of_cheild',
        'emergency_name',
        'emergency_relation',
        'emergency_phn_number',
        'emergency_email',
        'emergency_addr',
        'emergency_distict',
        'status'
    ];
}
