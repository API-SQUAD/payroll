<?php

namespace App\Exports;

use App\Models\Employee;
use App\Models\GajiDetail;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class GajiEmployeeExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $gaji_id;

    public function __construct($gaji_id)
    {
        $this->gaji_id = $gaji_id;
    }

    public function collection()
    {
        $employees = DB::table('public.employee')
            ->join('public.empcompany', 'public.employee.emplo_id', '=', 'public.empcompany.id_emp')
            ->join('public.riwayatkj', 'public.employee.emplo_id', '=', 'public.riwayatkj.emplo_id')
            ->join('public.empcard', 'public.employee.emplo_id', '=', 'public.empcard.emplo_id')
            ->join('public.empbenefit', 'public.employee.emplo_id', '=', 'public.empbenefit.emp_id')
            ->join('payroll.gaji_details', 'public.employee.emplo_id', '=', 'payroll.gaji_details.id_karyawan')
            ->select(
                'public.employee.emplo_id as id_karyawan',
                'public.employee.NIK as nik',
                'public.employee.nama',
                'public.empcompany.jabatan',
                'public.empcompany.divisi_region',
                'public.employee.tanggal_lahir',
                'public.empbenefit.stat_ptkp',
                'public.empcompany.tgl_join as tgl_masuk',
                'public.riwayatkj.end_pkwt as tgl_akhir_pkwt',
                DB::raw("COALESCE(public.empcard.rek_mandiri, 'public.empcard.rek_lain') as rek_final"),
                'public.empcard.npwp',
                DB::raw("public.empbenefit.gaji_pokok + public.empbenefit.tunjangan as bruto"),
                'payroll.gaji_details.gaji_pokok as gapok',
                'payroll.gaji_details.tunjangan_tetap as tunj_tetap',
                'payroll.gaji_details.hari_kerja',
                'public.empcard.bpjskes as bpjs_kes',
            )
            ->where('payroll.gaji_details.id_gaji', $this->gaji_id)
            ->where('public.empcompany.status', 'AKTIF')
            ->get();

        $no = 1;
        $employees = $employees->map(function ($employee) use (&$no) {
            $employee->total_hari = 21;

            $employee->gaji_pokok = round($employee->gapok / 21) * 21;

            $employee->gaji_pokok_efektif = round(($employee->gapok / 21)  * $employee->hari_kerja);

            $employee->tunjangan_tetap = round(($employee->tunj_tetap / 21) * $employee->hari_kerja);

            $employee->tunjangan_transport = 0;

            $employee->tunjangan_jabatan = 0;

            $employee->gaji_bruto = round(($employee->gapok / 21) * $employee->hari_kerja + ($employee->tunj_tetap / 21) * $employee->hari_kerja);

            $employee->gaji_perhari = round($employee->bruto / 21);

            $employee->gaji_setelah_dipotong_hari = round($employee->bruto / 21) * $employee->hari_kerja;

            $employee->lembur = (function ($id_karyawan) {
                $gaji_details = GajiDetail::where('id_karyawan', $id_karyawan)->first();
                return $gaji_details ? $gaji_details->lembur : 0;
            })($employee->id_karyawan);

            $employee->no_potongan = (function ($id_karyawan) {
                $gaji_details = GajiDetail::where('id_karyawan', $id_karyawan)->get();
                if ($gaji_details->count() > 0) {
                    $output = '';
                    $counter = 1;
                    foreach ($gaji_details as $gaji_detail) {
                        foreach ($gaji_detail->potongan_gajis as $potongan) {
                            $output .= "{$counter},";
                            $counter++;
                        }
                    }
                    return rtrim($output, ',') ?: '';
                } else {
                    return '';
                }
            })($employee->id_karyawan);

            $employee->total_potongan = (function ($id_karyawan) {
                $gaji_details = GajiDetail::where('id_karyawan', $id_karyawan)->get();
                if ($gaji_details->count() > 0) {
                    $output = '';
                    foreach ($gaji_details as $gaji_detail) {
                        foreach ($gaji_detail->potongan_gajis as $potongan) {
                            $output .= "{$potongan->total},";
                        }
                    }
                    return rtrim($output, ',');
                } else {
                    return 0;
                }
            })($employee->id_karyawan);

            $employee->keterangan_potongan = (function ($id_karyawan) {
                $gaji_details = GajiDetail::where('id_karyawan', $id_karyawan)->get();

                if ($gaji_details->count() > 0) {
                    $output = '';
                    foreach ($gaji_details as $gaji_detail) {
                        foreach ($gaji_detail->potongan_gajis as $potongan) {
                            $output .= "{$potongan->keterangan},";
                        }
                    }
                    return $output ?: '';
                } else {
                    return '';
                }
            })($employee->id_karyawan);

            $employee->no_koreksi = (function ($id_karyawan) {
                $gaji_details = GajiDetail::where('id_karyawan', $id_karyawan)->get();

                if ($gaji_details->count() > 0) {
                    $output = '';
                    $counter = 1;
                    foreach ($gaji_details as $gaji_detail) {
                        foreach ($gaji_detail->koreksi_gajis as $koreksi) {
                            $output .= "{$counter},";
                            $counter++;
                        }
                    }
                    return $output ?: '';
                } else {
                    return '';
                }
            })($employee->id_karyawan);

            $employee->total_koreksi = (function ($id_karyawan) {
                $gaji_details = GajiDetail::where('id_karyawan', $id_karyawan)->get();

                if ($gaji_details->count() > 0) {
                    $output = '';
                    foreach ($gaji_details as $gaji_detail) {
                        foreach ($gaji_detail->koreksi_gajis as $koreksi) {
                            $output .= "{$koreksi->total},";
                        }
                    }
                    return rtrim($output, ',');
                } else {
                    return 0;
                }
            })($employee->id_karyawan);

            $employee->keterangan_koreksi = (function ($id_karyawan) {
                $gaji_details = GajiDetail::where('id_karyawan', $id_karyawan)->get();

                if ($gaji_details->count() > 0) {
                    $output = '';
                    foreach ($gaji_details as $gaji_detail) {
                        foreach ($gaji_detail->koreksi_gajis as $koreksi) {
                            $output .= "{$koreksi->keterangan},";
                        }
                    }
                    return $output ?: '';
                } else {
                    return '';
                }
            })($employee->id_karyawan);

            $employee->total_gaji = (function ($id_karyawan, $emp) {
                $gaji_details = GajiDetail::where('id_karyawan', $id_karyawan)->first();
                $koreksi = $gaji_details->koreksi_gajis->sum('total');
                $potongan = $gaji_details->potongan_gajis->sum('total');

                return round(((($emp->gapok / 21) * $emp->hari_kerja) + (($emp->tunj_tetap / 21) * $emp->hari_kerja) + 0 + $koreksi) - $potongan) + $emp->lembur;
            })($employee->id_karyawan, $employee);

            $employee->jkk_024 = round($employee->bruto * 0.24 / 100);

            $employee->jkm_03 = round($employee->bruto * 0.3 / 100);

            $employee->bpjs_4 = (function ($emp) {
                if ($emp->bpjs_kes != null) {
                    $bruto = $emp->bruto > 12000000 ? 12000000 : $emp->bruto;

                    return round($bruto * 4 / 100);
                }
                return 0;
            })($employee);

            $employee->jht_37 = round($employee->bruto * 3.7 / 100);

            $employee->jpn_2 = (function ($emp) {
                $bruto = $emp->bruto > 10042300 ? 10042300 : $emp->bruto;

                return round($bruto * 2 / 100);
            })($employee);

            $employee->jpn_1 = (function ($emp) {
                $bruto = $emp->bruto > 10042300 ? 10042300 : $emp->bruto;

                return round($bruto * 1 / 100);
            })($employee);

            $employee->jht_2 = round($employee->bruto * 2 / 100);

            $employee->bpjs_1 = (function ($emp) {
                if ($emp->bpjs_kes != null) {
                    $bruto = $emp->bruto > 12000000 ? 12000000 : $emp->bruto;

                    return round($bruto * 1 / 100);
                }
                return 0;
            })($employee);

            $employee->total_thp = (function ($emp) {
                $gaji_details = GajiDetail::where('id_karyawan', $emp->id_karyawan)->first();
                $koreksi = $gaji_details->koreksi_gajis->sum('total');
                $potongan = $gaji_details->potongan_gajis->sum('total');
                $bruto = $emp->bruto > 10042300 ? 10042300 : $emp->bruto;
                $bpjs_1 = $emp->bpjs_kes != null ? round($bruto * 1 / 100) : 0;
                $jht_2 = round($bruto * 2 / 100);

                $total_gaji = round(((($emp->gapok / 21) * $emp->hari_kerja) + (($emp->tunj_tetap / 21) * $emp->hari_kerja) + 0 + $koreksi) - $potongan) + $emp->lembur;

                return $total_gaji - $emp->jpn_1 - $jht_2 - $bpjs_1;
            })($employee);

            $data = [
                'no' => $no,
                'nama' => $employee->nama,
                'jabatan' => $employee->jabatan,
                'divisi' => $employee->divisi_region,
                'tgl_lahir' => $employee->tanggal_lahir,
                'status_kel' => $employee->stat_ptkp,
                'tgl_masuk' => $employee->tgl_masuk,
                'tgl_akhir_pkwt' => $employee->tgl_akhir_pkwt,
                'no_rek' => $employee->rek_final,
                'bruto' => $employee->bruto,
                'gapok' => $employee->gapok,
                'tunj_tetap' => $employee->tunj_tetap,
                'total_hari' => $employee->total_hari,
                'gaji_pokok' => $employee->gaji_pokok,
                'hari_kerja' => $employee->hari_kerja,
                'gaji_pokok_efektif' => $employee->gaji_pokok_efektif,
                'tunjangan_tetap' => $employee->tunjangan_tetap,
                'tunjangan_transport' => $employee->tunjangan_transport,
                'tunjangan_jabatan' => $employee->tunjangan_jabatan,
                'gaji_bruto' => $employee->gaji_bruto,
                'gaji_perhari' => $employee->gaji_perhari,
                'gaji_setelah_dipotong_hari' => $employee->gaji_setelah_dipotong_hari,
                'lembur' => $employee->lembur,
                'no_potongan' => $employee->no_potongan,
                'total_potongan' => $employee->total_potongan,
                'keterangan_potongan' => $employee->keterangan_potongan,
                'no_koreksi' => $employee->no_koreksi,
                'total_koreksi' => $employee->total_koreksi,
                'keterangan_koreksi' => $employee->keterangan_koreksi,
                'total_gaji' => $employee->total_gaji,
                'jkk_024' => $employee->jkk_024,
                'jkm_03' => $employee->jkm_03,
                'bpjs_4' => $employee->bpjs_4,
                'jht_37' => $employee->jht_37,
                'jpn_2' => $employee->jpn_2,
                'jpn_1' => $employee->jpn_1,
                'jht_2' => $employee->jht_2,
                'bpjs_1' => $employee->bpjs_1,
                'total_thp' => $employee->total_thp,
            ];

            $no++;

            return $data;
        });

        return $employees;
    }

    public function headings(): array
    {
        return [
            ['Subsidiary: PT. INTERNASIONAL ASIA PRIMA SUKSES'],
            [
                'NO.',
                'NAMA',
                'JABATAN',
                'DIVISI / CABANG',
                'TGL. LAHIR',
                'STATUS KEL',
                'TGL. MASUK',
                'TGL. AKHIR PKWT',
                'NO. REK',
                'BRUTO',
                'GAJI POKOK',
                'TUNJ. TETAP',
                'TOTAL HARI',
                'GAJI POKOK',
                'HARI KERJA',
                'GAJI POKOK EFEKTIF',
                'TUNJANGAN TETAP',
                'TUNJANGAN TRANSPORT',
                'TUNJANGAN JABATAN',
                'GAJI BRUTO',
                'GAJI PERHARI',
                'GAJI SETELAH DIPOTONG HARI',
                'LEMBUR, ROLLING, DLL',
                'NO. POTONGAN',
                'TOTAL POTONGAN',
                'KETERANGAN POTONGAN',
                'NO. KOREKSI',
                'TOTAL KOREKSI',
                'KETERANGAN KOREKSI',
                'TOTAL GAJI',
                'JKK 0.24%',
                'JKM 0.3%',
                'BPJS 4%',
                'JHT 3.7%',
                'JPN 2%',
                'JPN 1%',
                'JHT 2%',
                'BPJS 1%',
                'TOTAL THP',
            ]
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            2 => ['font' => ['bold' => true], 'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => 'FFFF00']]],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 20,
            'C' => 20,
            'D' => 20,
            'E' => 20,
            'F' => 20,
            'G' => 20,
            'H' => 20,
            'I' => 20,
            'J' => 20,
            'K' => 20,
            'L' => 20,
            'M' => 20,
            'N' => 20,
            'O' => 20,
            'P' => 20,
            'Q' => 20,
            'R' => 20,
            'S' => 20,
            'T' => 20,
            'U' => 20,
            'V' => 20,
            'W' => 20,
            'X' => 20,
            'Y' => 20,
            'Z' => 20,
            'AA' => 20,
            'AB' => 20,
            'AC' => 20,
            'AD' => 20,
            'AE' => 20,
            'AF' => 20,
            'AG' => 20,
            'AH' => 20,
            'AI' => 20,
            'AJ' => 20,
            'AK' => 20,
            'AL' => 20,
            'AM' => 20,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $lastRow = $sheet->getHighestRow();
                $sheet->getStyle('J3:AM' . $lastRow)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

                $sumRow = $lastRow + 1;
                $sheet->mergeCells('A' . $sumRow . ':I' . $sumRow);
                $sheet->getStyle('A' . $sumRow)->getAlignment()->setHorizontal('right');
                $sheet->setCellValue('A' . $sumRow, 'Total');
                $sheet->setCellValue('J' . $sumRow, '=SUM(J3:J' . $lastRow . ')');
                $sheet->setCellValue('K' . $sumRow, '=SUM(K3:K' . $lastRow . ')');
                $sheet->setCellValue('L' . $sumRow, '=SUM(L3:L' . $lastRow . ')');
                $sheet->setCellValue('M' . $sumRow, '=SUM(M3:M' . $lastRow . ')');
                $sheet->setCellValue('N' . $sumRow, '=SUM(N3:N' . $lastRow . ')');
                $sheet->setCellValue('O' . $sumRow, '=SUM(O3:O' . $lastRow . ')');
                $sheet->setCellValue('P' . $sumRow, '=SUM(P3:P' . $lastRow . ')');
                $sheet->setCellValue('Q' . $sumRow, '=SUM(Q3:Q' . $lastRow . ')');
                $sheet->setCellValue('R' . $sumRow, '=SUM(R3:R' . $lastRow . ')');
                $sheet->setCellValue('S' . $sumRow, '=SUM(S3:S' . $lastRow . ')');
                $sheet->setCellValue('T' . $sumRow, '=SUM(T3:T' . $lastRow . ')');
                $sheet->setCellValue('U' . $sumRow, '=SUM(U3:U' . $lastRow . ')');
                $sheet->setCellValue('V' . $sumRow, '=SUM(V3:V' . $lastRow . ')');
                $sheet->setCellValue('W' . $sumRow, '=SUM(W3:W' . $lastRow . ')');
                $sheet->setCellValue('AD' . $sumRow, '=SUM(AD3:AD' . $lastRow . ')');
                $sheet->setCellValue('AE' . $sumRow, '=SUM(AE3:AE' . $lastRow . ')');
                $sheet->setCellValue('AF' . $sumRow, '=SUM(AF3:AF' . $lastRow . ')');
                $sheet->setCellValue('AG' . $sumRow, '=SUM(AG3:AG' . $lastRow . ')');
                $sheet->setCellValue('AH' . $sumRow, '=SUM(AH3:AH' . $lastRow . ')');
                $sheet->setCellValue('AI' . $sumRow, '=SUM(AI3:AI' . $lastRow . ')');
                $sheet->setCellValue('AJ' . $sumRow, '=SUM(AJ3:AJ' . $lastRow . ')');
                $sheet->setCellValue('AK' . $sumRow, '=SUM(AK3:AK' . $lastRow . ')');
                $sheet->setCellValue('AL' . $sumRow, '=SUM(AL3:AL' . $lastRow . ')');
                $sheet->setCellValue('AM' . $sumRow, '=SUM(AM3:AM' . $lastRow . ')');
                $sheet->getStyle('J' . $sumRow . ':AM' . $sumRow)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                $sheet->getStyle('A' . $sumRow . ':AM' . $sumRow)->getFont()->setBold(true);
                $sheet->getStyle('A' . $sumRow . ':AM' . $sumRow)->getFill()->setFillType('solid')->getStartColor()->setARGB('FF00FF00');
            }
        ];
    }
}
