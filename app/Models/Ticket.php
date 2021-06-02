<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'assets',
        'priority',
        'serial_no',
        'model_no',
        'assigned_to',
        'status',
    ];

}
