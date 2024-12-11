<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShowTimeSheet extends Model
{
    use HasFactory;
    protected $fillable = [
        'MSNV',
        'Name',
        'Time',
        'Date',
    ];
}
