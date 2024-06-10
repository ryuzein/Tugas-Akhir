<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeknisiModel extends Model
{
    use HasFactory;
    protected $table = "tbl_teknisi";
    protected $primaryKey = 'teknisi_id';
    protected $fillable = [
        'teknisi_nama',
        'teknisi_slug',
        'teknisi_alamat',
        'teknisi_notelp',
    ]; 
}
