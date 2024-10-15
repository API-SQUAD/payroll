<?php

namespace App\Http\Controllers;

use App\Exports\GajiEmployeeExport;
use App\Jobs\ProcessDataJob;
use App\Models\Gaji;
use App\Models\GajiDetail;
use App\Models\KoreksiGaji;
use App\Models\PotonganGaji;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class GajiController extends Controller
{
    public function __construct()
    {
        $this->TOTAL_HARI_DEFAULT = 21;
    }

    public function dataTable($id)
    {
        $employee = DB::table('public.employee')
            ->join('public.empcompany', 'public.employee.emplo_id', '=', 'public.empcompany.id_emp')
            ->join('public.riwayatkj', 'public.employee.emplo_id', '=', 'public.riwayatkj.emplo_id')
            ->join('public.empcard', 'public.employee.emplo_id', '=', 'public.empcard.emplo_id')
            ->join('public.empbenefit', 'public.employee.emplo_id', '=', 'public.empbenefit.emp_id')
            ->join('payroll.gaji_details', 'public.employee.emplo_id', '=', 'payroll.gaji_details.id_karyawan')
            ->select('public.employee.emplo_id as id_karyawan', 'public.employee.NIK as nik', 'public.employee.nama', 'public.empcompany.jabatan', 'public.empcompany.divisi_region', 'public.employee.tanggal_lahir', 'public.empbenefit.stat_ptkp', 'public.empcompany.tgl_join as tgl_masuk', 'public.riwayatkj.end_pkwt as tgl_akhir_pkwt', DB::RAW("COALESCE(public.empcard.rek_mandiri, 'public.empcard.rek_lain') as rek_final"), 'public.empcard.npwp', DB::raw("public.empbenefit.gaji_pokok + public.empbenefit.tunjangan as bruto"), 'payroll.gaji_details.gaji_pokok as gapok', 'payroll.gaji_details.tunjangan_tetap as tunj_tetap', 'payroll.gaji_details.hari_kerja', 'payroll.gaji_details.lembur', 'payroll.gaji_details.bpjs_4', 'payroll.gaji_details.bpjs_1', 'payroll.gaji_details.jpn_2', 'payroll.gaji_details.jpn_1', 'public.empcard.bpjskes as bpjs_kes')
            ->where('payroll.gaji_details.id_gaji', $id)
            ->where('public.empcompany.status', 'AKTIF')
            ->get();

        return DataTables::of($employee)
            ->addIndexColumn()
            ->addColumn('total_hari', function ($q) {
                return $this->TOTAL_HARI_DEFAULT;
            })
            ->addColumn('gaji_pokok', function ($q) {
                return round(($q->gapok / 21) * $this->TOTAL_HARI_DEFAULT);
            })
            ->addColumn('hari_kerja', function ($q) {
                return $q->hari_kerja;
            })
            ->addColumn('lembur', function ($q) {
                return $q->lembur;
            })
            ->addColumn('gaji_pokok_efektif', function ($q) {
                return round(($q->gapok / 21) * $q->hari_kerja);
            })
            ->addColumn('tunjangan_tetap', function ($q) {
                // $tunjangan = ($q->tunj_tetap / 21) * $q->hari_kerja;
                // return round($tunjangan, -3);

                return round(($q->tunj_tetap / 21) * $q->hari_kerja);
            })
            ->addColumn('tunjangan_transport', function ($q) {
                return 0;
            })
            ->addColumn('tunjangan_jabatan', function ($q) {
                return 0;
            })
            ->addColumn('gaji_bruto', function ($q) {
                return round(($q->gapok / 21) * $q->hari_kerja + ($q->tunj_tetap / 21) * $q->hari_kerja);
            })
            ->addColumn('lembur', function ($q) {
                $gaji_details = GajiDetail::where('id_karyawan', $q->id_karyawan)->first();

                return $gaji_details->lembur;
            })
            ->addColumn('no_potongan', function ($q) {
                $gaji_details = GajiDetail::where('id_karyawan', $q->id_karyawan)->get();

                if ($gaji_details->count() > 0) {
                    $output = '';
                    $counter = 1;
                    foreach ($gaji_details as $gaji_detail) {
                        foreach ($gaji_detail->potongan_gajis as $potongan) {
                            $output .= "{$counter},";
                            $counter++;
                        }
                    }
                    return $output ?: null;
                } else {
                    return null;
                }

                return null;
            })
            ->addColumn('total_potongan', function ($q) {
                $gaji_details = GajiDetail::where('id_karyawan', $q->id_karyawan)->get();

                if ($gaji_details->count() > 0) {
                    $output = '';
                    foreach ($gaji_details as $gaji_detail) {
                        foreach ($gaji_detail->potongan_gajis as $koreksi) {
                            $koreksi->total = number_format($koreksi->total, 0, ',', '.');
                            $output .= "Rp {$koreksi->total},";
                        }
                    }
                    return rtrim($output, ',');
                } else {
                    return null;
                }

                return null;
            })
            ->addColumn('keterangan_potongan', function ($q) {
                $gaji_details = GajiDetail::where('id_karyawan', $q->id_karyawan)->get();

                if ($gaji_details->count() > 0) {
                    $output = '';
                    foreach ($gaji_details as $gaji_detail) {
                        foreach ($gaji_detail->potongan_gajis as $potongan) {
                            $output .= "{$potongan->keterangan},";
                        }
                    }
                    return $output ?: null;
                } else {
                    return null;
                }

                return null;
            })
            ->addColumn('no_koreksi', function ($q) {
                $gaji_details = GajiDetail::where('id_karyawan', $q->id_karyawan)->get();

                if ($gaji_details->count() > 0) {
                    $output = '';
                    $counter = 1;
                    foreach ($gaji_details as $gaji_detail) {
                        foreach ($gaji_detail->koreksi_gajis as $koreksi) {
                            $output .= "{$counter},";
                            $counter++;
                        }
                    }
                    return $output ?: null;
                } else {
                    return null;
                }
            })
            ->addColumn('total_koreksi', function ($q) {
                $gaji_details = GajiDetail::where('id_karyawan', $q->id_karyawan)->get();

                if ($gaji_details->count() > 0) {
                    $output = '';
                    foreach ($gaji_details as $gaji_detail) {
                        foreach ($gaji_detail->koreksi_gajis as $koreksi) {
                            $koreksi->total = number_format($koreksi->total, 0, ',', '.');

                            $output .= "Rp {$koreksi->total},";
                        }
                    }
                    return rtrim($output, ',');
                } else {
                    return null;
                }
            })
            ->addColumn('keterangan_koreksi', function ($q) {
                $gaji_details = GajiDetail::where('id_karyawan', $q->id_karyawan)->get();

                if ($gaji_details->count() > 0) {
                    $output = '';
                    foreach ($gaji_details as $gaji_detail) {
                        foreach ($gaji_detail->koreksi_gajis as $koreksi) {
                            $output .= "{$koreksi->keterangan},";
                        }
                    }
                    return $output ?: null;
                } else {
                    return null;
                }
            })
            ->addColumn('total_gaji', function ($q) {
                $gaji_details = GajiDetail::where('id_karyawan', $q->id_karyawan)->first();
                $koreksi = $gaji_details->koreksi_gajis->sum('total');
                $potongan = $gaji_details->potongan_gajis->sum('total');

                return round((((($q->gapok / 21) * $q->hari_kerja) + (($q->tunj_tetap / 21) * $q->hari_kerja) + 0 + $koreksi) - $potongan) + $q->lembur);
            })
            ->addColumn('jkk_024', function ($q) {
                return round($q->bruto * 0.24 / 100);
            })
            ->addColumn('jkm_03', function ($q) {
                return round($q->bruto * 0.3 / 100);
            })
            ->editColumn('bpjs_4', function ($q) {
                if ($q->bpjs_kes != null) {
                    $bruto = $q->bruto > 12000000 ? 12000000 : $q->bruto;
                    return round($bruto * 4 / 100);
                }
                return 0;
            })
            ->addColumn('jht_37', function ($q) {
                return round($q->bruto * 3.7 / 100);
            })
            ->editColumn('jpn_2', function ($q) {
                $bruto = $q->bruto > 10042300 ? 10042300 : $q->bruto;
                return round($bruto * 2 / 100);
            })
            ->editColumn('jpn_1', function ($q) {
                $bruto = $q->bruto > 10042300 ? 10042300 : $q->bruto;
                return round($bruto * 1 / 100);
            })
            ->addColumn('jht_2', function ($q) {
                return round($q->bruto * 2 / 100);
            })
            ->editColumn('bpjs_1', function ($q) {
                if ($q->bpjs_kes != null) {
                    $bruto = $q->bruto > 12000000 ? 12000000 : $q->bruto;
                    return round($bruto * 1 / 100);
                }
                return 0;
            })
            // THP
            ->addColumn('total_thp', function ($q) {
                $gaji_details = GajiDetail::where('id_karyawan', $q->id_karyawan)->first();
                $koreksi = $gaji_details->koreksi_gajis->sum('total');
                $potongan = $gaji_details->potongan_gajis->sum('total');
                $bruto = $q->bruto > 10042300 ? 10042300 : $q->bruto;
                $bruto_bpjs = $q->bruto > 12000000 ? 12000000 : $q->bruto;
                $bpjs_1 = $q->bpjs_kes != null ? round($bruto_bpjs * 1 / 100) : 0;
                $jht_2 = round($q->bruto * 2 / 100);

                $total_gaji = round((((($q->gapok / 21) * $q->hari_kerja) + (($q->tunj_tetap / 21) * $q->hari_kerja) + 0 + $koreksi) - $potongan) + $q->lembur);

                // return  $q->jpn_1 ;
                return $total_gaji - $q->jpn_1 - $jht_2 - $bpjs_1;

                // \dd('Gapok', $q->gapok, 'JPN 1', $q->jpn_1, 'jht 2', $q->jht_2, 'bpjs 1', $bpjs_1);

                // return round(((((($q->gapok / 21) * $q->hari_kerja) + (($q->tunj_tetap / 21) * $q->hari_kerja) + 0 + $koreksi) - $potongan)) - $q->jpn_1 - round($bruto * 2 / 100) - $bpjs_1);
            })
            ->addColumn('gaji_perhari', function ($q) {
                return round(($q->bruto / $this->TOTAL_HARI_DEFAULT));
            })
            ->addColumn('gaji_setelah_dipotong_hari', function ($q) {
                return round(($q->bruto / $this->TOTAL_HARI_DEFAULT) * $q->hari_kerja);
            })
            ->make(true);
    }

    public function modalData($id)
    {
        $employee = GajiDetail::where('id_karyawan', $id)
            ->join('public.employee', 'payroll.gaji_details.id_karyawan', '=', 'public.employee.emplo_id')
            ->first();

        $potonganAndKoreksi = GajiDetail::where('id_karyawan', $id)
            ->with('potongan_gajis')
            ->with('koreksi_gajis')
            ->first();

        $employee->potongan_gajis = $potonganAndKoreksi->potongan_gajis;
        $employee->koreksi_gajis = $potonganAndKoreksi->koreksi_gajis;

        return response()->json([
            'employee' => $employee,
        ]);
    }

    public function addPotongan(Request $request)
    {
        $request->merge([
            'total' => removeRibuanFormat($request->total),
        ]);

        $validator = Validator::make($request->all(), [
            'id_gaji' => 'required|exists:gajis,id',
            'id_karyawan' => 'required',
            'total' => 'required|numeric',
            'keterangan' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ]);
        }

        $gajiDetail = GajiDetail::where('id_karyawan', $request->id_karyawan)
            ->where('id_gaji', $request->id_gaji)
            ->first();

        PotonganGaji::create([
            'id_gaji_detail' => $gajiDetail->id,
            'total' => $request->total,
            'keterangan' => $request->keterangan,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Potongan berhasil ditambahkan.',
            'data' => $gajiDetail->potongan_gajis,
        ]);
    }

    public function addKoreksi(Request $request)
    {
        $request->merge([
            'total' => removeRibuanFormat($request->total),
        ]);

        $validator = Validator::make($request->all(), [
            'id_gaji' => 'required|exists:gajis,id',
            'id_karyawan' => 'required',
            'total' => 'required|numeric',
            'keterangan' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ]);
        }

        $gajiDetail = GajiDetail::where('id_karyawan', $request->id_karyawan)
            ->where('id_gaji', $request->id_gaji)
            ->first();

        KoreksiGaji::create([
            'id_gaji_detail' => $gajiDetail->id,
            'total' => $request->total,
            'keterangan' => $request->keterangan,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Koreksi berhasil ditambahkan.',
            'data' => $gajiDetail->koreksi_gajis,
        ]);
    }

    public function deletePotongan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_potongan' => 'required|exists:potongan_gajis,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ]);
        }

        $potongan = PotonganGaji::find($request->id_potongan);
        $potongan->delete();

        $potonganAll = GajiDetail::where('id_gaji', $request->id_gaji)
            ->where('id_karyawan', $request->id_karyawan)
            ->with('potongan_gajis')
            ->first();

        return response()->json([
            'status' => 'success',
            'message' => 'Potongan berhasil dihapus.',
            'data' => $potonganAll->potongan_gajis,
        ]);
    }

    public function deleteKoreksi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_koreksi' => 'required|exists:koreksi_gajis,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ]);
        }

        $koreksi = KoreksiGaji::find($request->id_koreksi);
        $koreksi->delete();

        $koreksiAll = GajiDetail::where('id_gaji', $request->id_gaji)
            ->where('id_karyawan', $request->id_karyawan)
            ->with('koreksi_gajis')
            ->first();

        return response()->json([
            'status' => 'success',
            'message' => 'Koreksi berhasil dihapus.',
            'data' => $koreksiAll->koreksi_gajis,
        ]);
    }

    public function storeDetail(Request $request)
    {
        $request->merge([
            'lembur' => removeRibuanFormat($request->lembur),
        ]);

        $validator = Validator::make($request->all(), [
            'id_gaji' => 'required|exists:gajis,id',
            'id_karyawan' => 'required',
            'hari_kerja' => 'required|numeric',
            'lembur' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ]);
        }

        $gajiDetail = GajiDetail::where('id_karyawan', $request->id_karyawan)
            ->where('id_gaji', $request->id_gaji)
            ->first();

        $gajiDetail->update([
            'hari_kerja' => $request->hari_kerja,
            'lembur' => $request->lembur,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil disimpan.',
        ]);
    }

    public function index()
    {
        // proses gaji karyawan
        // $now = Carbon::now();
        $now = Carbon::create(2024, 10, 20);
        $startDate = Carbon::create($now->year, $now->month, 1);
        $endDate = Carbon::create($now->year, $now->month, 20);
        $totalDays = $endDate->day - $startDate->day + 1;
        if ($now->lessThan($startDate)) {
            $progressPercentage = 0;
        } elseif ($now->greaterThanOrEqualTo($endDate)) {
            $progressPercentage = 100;
        } else {
            $currentDay = $now->day;
            $progressPercentage = round(($currentDay / $totalDays) * 100);
        }
        // data arsip gaji
        $gajis = Gaji::all();

        return view('gaji.index', [
            'progressPercentage' => $progressPercentage,
            'gajis' => $gajis,
        ]);
    }

    public function detail($id)
    {
        return view('gaji.detail', [
            'urlDataTable' => route('gaji.data-table', $id),
        ]);
    }

    public function createGaji()
    {
        $gaji = Gaji::where('periode', Carbon::now()->locale('id')->translatedFormat('F Y'))->first();
        if ($gaji) {
            return redirect()->back()->with('error', 'Gaji bulan ini sudah dibuat.');
        }

        $newGaji = Gaji::create([
            'periode' => Carbon::now()->locale('id')->translatedFormat('F Y'),
            'waktu_proses' => Carbon::now(),
        ]);

        $employees = DB::table('public.employee')->get();

        foreach ($employees as $employee) {
            $gaji = DB::table('public.empbenefit')->where('emp_id', $employee->emplo_id)->first();

            $total_hari = 21;
            $hari_kerja = $total_hari;
            $gaji_bruto = (int) ($gaji->gaji_pokok / 21) * $total_hari + ($gaji->tunjangan / 21) * $total_hari;
            $bruto_jpn = $gaji_bruto > 10042300 ? 10042300 : $gaji_bruto;
            $bruto_bpjs = $gaji_bruto > 12000000 ? 12000000 : $gaji_bruto;


            GajiDetail::create([
                'id_gaji' => $newGaji->id,
                'id_karyawan' => $employee->emplo_id,
                'gaji_pokok' => $gaji->gaji_pokok,
                'tunjangan_tetap' => $gaji->tunjangan,
                'hari_kerja' => $hari_kerja,
                'lembur' => 0,
                'bpjs_1' => round($bruto_bpjs * 1 / 100),
                'bpjs_4' => round($bruto_bpjs * 4 / 100),
                'jpn_1' => round($bruto_jpn * 1 / 100),
                'jpn_2' => round($bruto_jpn * 2 / 100),

            ]);
        }

        // ProcessDataJob::dispatch($newGaji->id);

        return redirect()->back()->with('success', 'Gaji bulan ini berhasil dibuat.');
    }

    function printExcel($id)
    {
        $gaji = Gaji::find($id);
        if (!$gaji) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $waktuProses = Carbon::parse($gaji->waktu_proses)->locale('id');

        try {
            $excel = Excel::download(new GajiEmployeeExport($id), 'employee-gaji-' . $waktuProses->translatedFormat('F Y') . '.xlsx');
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }

        return $excel;
    }

    function printPdf($id)
    {
        $gaji = Gaji::find($id);
        if (!$gaji) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $waktuProses = Carbon::parse($gaji->waktu_proses)->locale('id');
        $bulanStart = $waktuProses->subMonth()->format('F');
        $tanggalEnd = Carbon::parse($gaji->tanggal_end)->format('d F Y');
        $tahun = $waktuProses->format('Y');

        return view('gaji.print-pdf', [
            'urlDataTable' => route('gaji.data-table', $id),
            'waktuProses' => $waktuProses,
            'bulanStart' => $bulanStart,
            'tanggalEnd' => $tanggalEnd,
            'tahun' => $tahun,
        ]);
    }
}
