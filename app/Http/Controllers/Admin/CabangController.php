<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AksesModel;
use App\Models\Admin\CabangModel; //arahkan ke model yang dibuat
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class CabangController extends Controller //ubah ke controller yang dituju
{
    public function index()
    {
        //Ubah variable sesuai
        $data["title"] = "Cabang";
        $data["hakTambah"] = AksesModel::leftJoin('tbl_menu', 'tbl_menu.menu_id', '=', 'tbl_akses.menu_id')->where(array('tbl_akses.role_id' => Session::get('user')->role_id, 'tbl_menu.menu_judul' => 'Cabang', 'tbl_akses.akses_type' => 'create'))->count();
        return view('Admin.Cabang.index', $data);
    }

    public function show(Request $request)
    {
        if ($request->ajax()) {
            $data = CabangModel::orderBy('cabang_id', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('kode', function ($row) {
                    $kode = $row->cabang_kode == '' ? '-' : $row->cabang_kode;

                    return $kode;
                })
                ->addColumn('alamat', function ($row) {
                    $alamat = $row->cabang_alamat == '' ? '-' : $row->cabang_alamat;

                    return $alamat;
                })
                ->addColumn('action', function ($row) {
                    $array = array(
                        "cabang_id" => $row->cabang_id,
                        "cabang_nama" => trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $row->cabang_nama)),
                        "cabang_alamat" => trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $row->cabang_alamat)),
                        "cabang_kode" => $row->cabang_kode
                    );
                    $button = '';
                    $hakEdit = AksesModel::leftJoin('tbl_menu', 'tbl_menu.menu_id', '=', 'tbl_akses.menu_id')->where(array('tbl_akses.role_id' => Session::get('user')->role_id, 'tbl_menu.menu_judul' => 'Cabang', 'tbl_akses.akses_type' => 'update'))->count();
                    $hakDelete = AksesModel::leftJoin('tbl_menu', 'tbl_menu.menu_id', '=', 'tbl_akses.menu_id')->where(array('tbl_akses.role_id' => Session::get('user')->role_id, 'tbl_menu.menu_judul' => 'Cabang', 'tbl_akses.akses_type' => 'delete'))->count();
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
                ->rawColumns(['action', 'kode', 'alamat'])->make(true);
        }
    }

    public function proses_tambah(Request $request)
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->cabang)));

        //insert data
        CabangModel::create([
            'cabang_nama' => $request->cabang,
            'cabang_slug' => $slug,
            'cabang_kode'   => $request->kode,
            'cabang_alamat'   => $request->alamat,
        ]);

        return response()->json(['success' => 'Berhasil']);
    }

    public function proses_ubah(Request $request, CabangModel $cabang)
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->cabang)));

        //update data
        $cabang->update([
            'cabang_nama' => $request->cabang,
            'cabang_slug' => $slug,
            'cabang_kode'   => $request->kode,
            'cabang_alamat'   => $request->alamat,
        ]);

        return response()->json(['success' => 'Berhasil']);
    }

    
    public function proses_hapus(Request $request, CabangModel $cabang)
    {
        //delete
        $cabang->delete();

        return response()->json(['success' => 'Berhasil']);
    }
}
