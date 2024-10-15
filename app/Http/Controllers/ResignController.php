<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ResignController extends Controller
{
    public function index()
    {
        return view('resign.index');
    }

    public function dataTable()
    {
        $resigns = DB::table('public.employee')
            ->join('public.empcompany', 'public.employee.emplo_id', '=', 'public.empcompany.id_emp')
            ->select(
                'public.employee.emplo_id as id_karyawan',
                'public.employee.NIK as nik',
                'public.employee.nama',
                'public.empcompany.tgl_akhir_ker as tgl_resign',
                'public.empcompany.keterangan'
            )
            ->where('public.empcompany.status', '!=', 'AKTIF')
            ->get();

        return DataTables::of($resigns)
            ->addIndexColumn()
            ->make(true);
    }

    public function getAktifKaryawanList()
    {
        $karyawans = DB::table('public.employee')
            ->join('public.empcompany', 'public.employee.emplo_id', '=', 'public.empcompany.id_emp')
            ->select(
                'public.employee.emplo_id as id_karyawan',
                'public.employee.NIK as nik',
                'public.employee.nama',
                'public.empcompany.tgl_akhir_ker as tgl_resign',
                'public.empcompany.keterangan'
            )
            ->where('public.empcompany.status', 'AKTIF')
            ->get();

        return response()->json($karyawans);
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'nik_atau_nama_karyawan' => 'required',
            'tgl_resign' => 'required',
            'keterangan' => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validation->errors()->first(),
            ]);
        }

        $karyawan = DB::table('public.employee')
            ->where('NIK', $request->nik_atau_nama_karyawan)
            ->first();
        if (!$karyawan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Karyawan tidak ditemukan',
            ]);
        }

        $karyawanTerpilih = DB::table('public.empcompany')
            ->where('id_emp', $karyawan->emplo_id)
            ->first();
        if ($karyawanTerpilih->status != 'AKTIF') {
            return response()->json([
                'status' => 'error',
                'message' => 'Karyawan sudah tidak aktif',
            ]);
        }

        try {
            DB::table('public.empcompany')
                ->where('id_emp', $karyawan->emplo_id)
                ->update([
                    'tgl_akhir_ker' => Carbon::parse($request->tgl_resign)->format('Y-m-d'),
                    'keterangan' => $request->keterangan,
                    'status' => 'RESIGN',
                ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data resign berhasil disimpan',
        ]);
    }
}
