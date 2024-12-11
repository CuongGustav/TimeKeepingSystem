<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    use HasFactory;
    protected $table = 'timesheets';
    protected $fillable = [
        'MSNV',
        'Name',
        'Time',
        'Date',
        'Image'
    ];
}
