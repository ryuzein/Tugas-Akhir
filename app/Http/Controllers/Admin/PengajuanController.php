<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AksesModel;
use App\Models\Admin\PengajuanModel;
use Illuminate\Http\Request;
use App\Models\Admin\WebModel;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class PengajuanController extends Controller
{
    public function index()
    {
        $data["title"] = "Pengajuan Barang";
        $data["hakTambah"] = AksesModel::leftJoin('tbl_menu', 'tbl_menu.menu_id', '=', 'tbl_akses.menu_id')->where(array('tbl_akses.role_id' => Session::get('user')->role_id, 'tbl_menu.menu_judul' => 'Pengajuan Barang', 'tbl_akses.akses_type' => 'create'))->count();
        $data["roleUser"] = Session::get('user')->role_id;
        return view('Admin.Pengajuan.index', $data);
    }

    public function show(Request $request)
    {
        if ($request->ajax()) {
            $data = PengajuanModel::orderBy('pengajuan_id', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                // ->addColumn('', function ($row) {
                //     $notelp = $row->teknisi_notelp == '' ? '-' : $row->teknisi_notelp;
                //     return $notelp;
                // })
                // ->addColumn('alamat', function ($row) {
                //     $alamat = $row->teknisi_alamat == '' ? '-' : $row->teknisi_alamat;
                //     return $alamat;
                // })
                ->addColumn('action', function ($row) {
                    $array = array(
                        "pengajuan_id" => $row->pengajuan_id,
                        "pengajuan_nama_barang" => trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $row->pengajuan_nama_barang)),
                        "pengajuan_jumlah_barang" => $row->pengajuan_jumlah_barang,
                        "pengajuan_jenis_barang" => trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $row->pengajuan_jenis_barang)),
                        "pengajuan_tujuan" => trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $row->pengajuan_tujuan)),
                        "status" => $row->status
                    );
                    $button = '';
                    $hakEdit = AksesModel::leftJoin('tbl_menu', 'tbl_menu.menu_id', '=', 'tbl_akses.menu_id')->where(array('tbl_akses.role_id' => Session::get('user')->role_id, 'tbl_menu.menu_judul' => 'Pengajuan Barang', 'tbl_akses.akses_type' => 'update'))->count();
                    $hakDelete = AksesModel::leftJoin('tbl_menu', 'tbl_menu.menu_id', '=', 'tbl_akses.menu_id')->where(array('tbl_akses.role_id' => Session::get('user')->role_id, 'tbl_menu.menu_judul' => 'Pengajuan Barang', 'tbl_akses.akses_type' => 'delete'))->count();
                    if ($hakEdit > 0 && $hakDelete > 0) {
                        $button .= '
                        <div class="g-2">
                        <a class="btn modal-effect text-primary btn-sm" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#Umodaldemo8" data-bs-toggle="tooltip" data-bs-original-title="Edit" onclick=update(' . json_encode($array) . ')><span class="fe fe-edit text-success fs-14"></span></a>
                        <a class="btn modal-effect text-danger btn-sm" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#Hmodaldemo8" onclick=hapus(' . json_encode($array) . ')><span class="fe fe-trash-2 fs-14"></span></a>
                        </div>
                        ';
                    } else if ($hakEdit > 0 && $hakDelete == 0) {
                        $button .= '
                        <div class="g-2">
                            <a class="btn modal-effect text-primary btn-sm" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#Umodaldemo8" data-bs-toggle="tooltip" data-bs-original-title="Edit" onclick=update(' . json_encode($array) . ')><span class="fe fe-edit text-success fs-14"></span></a>
                        </div>
                        ';
                    } else if ($hakEdit == 0 && $hakDelete > 0) {
                        $button .= '
                        <div class="g-2">
                        <a class="btn modal-effect text-danger btn-sm" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#Hmodaldemo8" onclick=hapus(' . json_encode($array) . ')><span class="fe fe-trash-2 fs-14"></span></a>
                        </div>
                        ';
                    } else {
                        $button .= '-';
                    }
                    return $button;
                })
                ->rawColumns(['action'])->make(true);
        }
    }

    public function proses_tambah(Request $request)
    {
        //insert data
        PengajuanModel::create([
            'pengajuan_nama_barang' => $request->pengajuan_nama_barang,
            'pengajuan_jenis_barang' => $request->pengajuan_jenis_barang,
            'pengajuan_jumlah_barang'   => $request->pengajuan_jumlah_barang,
            'pengajuan_tujuan'   => $request->pengajuan_tujuan,
            'status' => 'MENUNGGU'
        ]);

        return response()->json(['success' => 'Berhasil']);
    }

    public function proses_ubah(Request $request, PengajuanModel $pengajuan)
    {
        //update data
        $pengajuan->update([
            'pengajuan_nama_barang' => $request->pengajuan_nama_barang,
            'pengajuan_jenis_barang' => $request->pengajuan_jenis_barang,
            'pengajuan_jumlah_barang'   => $request->pengajuan_jumlah_barang,
            'pengajuan_tujuan'   => $request->pengajuan_tujuan,
            'status' => $request->status
        ]);

        return response()->json(['success' => 'Berhasil']);
    }

    
    public function proses_hapus(Request $request, PengajuanModel $pengajuan)
    {
        //delete
        $pengajuan->delete();

        return response()->json(['success' => 'Berhasil']);
    }
}
