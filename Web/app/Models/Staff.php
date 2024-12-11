<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $table = 'staffs';
    protected $primaryKey = 'MSNV'; // Khóa chính là MSNV
    public $incrementing = false; // Nếu MSNV không tự động tăng
    protected $keyType = 'string'; // Nếu MSNV là kiểu chuỗi
    protected $fillable = [
        'MSNV',
        'Name',
        'Address',
        'Phone',
        'CCCD',
        'Gender',
        'Duty',
        'Image'
    ];
}
