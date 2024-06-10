<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CabangModel extends Model
{
    use HasFactory;
    protected $table = "tbl_cabang";
    protected $primaryKey = 'cabang_id';
    protected $fillable = [
        'cabang_nama',
        'cabang_slug',
        'cabang_alamat',
        'cabang_kode',
    ]; 
}
