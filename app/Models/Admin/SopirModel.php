<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SopirModel extends Model
{
    use HasFactory;
    protected $table = "tbl_sopir";
    protected $primaryKey = 'sopir_id';
    protected $fillable = [
        'sopir_nama',
        'sopir_slug',
        'sopir_keterangan'
    ]; 
}
