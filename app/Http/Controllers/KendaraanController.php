<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Expr\List_;

class KendaraanController extends Controller
{
    public function list()
    {
        $hasil = DB::select('select * from uts');
        return view('list-kendaraan', ['data' => $hasil]);
    }
    public function simpan(Request $req)
    {
        DB::insert(
            'insert into uts (nomor_plat, merk_kendaraan, tipe_kendaraan) values (?, ?, ?)',
            [$req->nomor_plat, $req->merk_kendaraan, $req->tipe_kendaraan]
        );
        $hasil = DB::select('select * from uts');
        return view('list-kendaraan', ['data' => $hasil]);
    }
    public function hapus($req)
    {
        Log::info('proses hapus dengan id=' . $req);
        DB::delete('delete from uts where id = ?', [$req]);

        $hasil = DB::select('select * from uts');
        return view('list-kendaraan', ['data' => $hasil]);
    }
    public function ubah($req)
    {
        $hasil = DB::select('select * from uts where id = ?', [$req]);
        return view('form-ubah', ['data' => $hasil]);
    }
    public function rubah(Request $req)
    {
        Log::info('Hallo');
        Log::info($req);
        DB::update(
            'update uts set ' .
                'nomor_plat=?, ' .
                'merk_kendaraan=?, ' .
                'tipe_kendaraan=? where id=? ',
            [
                $req->nomor_plat,
                $req->merk_kendaraan,
                $req->tipe_kendaraan,
                $req->id
            ]
        );
        $hasil = DB::select('select * from uts');
        return view('list-kendaraan', ['data' => $hasil]);
    }
}
