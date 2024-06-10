<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KendaraanModel extends Model
{
    use HasFactory;
    protected $table = "tbl_kendaraan";
    protected $primaryKey = 'kendaraan_id';
    protected $fillable = [
        'kendaraan_nama',
        'kendaraan_slug',
        'kendaraan_plat'
    ]; 
}
