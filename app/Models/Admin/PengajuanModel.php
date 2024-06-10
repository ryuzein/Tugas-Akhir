<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanModel extends Model
{
    use HasFactory;
    protected $table = "tbl_pengajuan";
    protected $primaryKey = 'pengajuan_id';
    protected $fillable = [
        'pengajuan_nama_barang',
        'pengajuan_jenis_barang',
        'pengajuan_jumlah_barang',
        'pengajuan_tujuan',
        'status'
    ]; 
}
