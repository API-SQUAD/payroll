<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ProcessDataJob implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, SerializesModels;

    protected $id_gaji;

    /**
     * Create a new job instance.
     */
    public function __construct($id_gaji)
    {
        $this->id_gaji = $id_gaji;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $employees = DB::table('public.employee')->get();

        foreach ($employees as $employee) {
            $gaji = DB::table('public.empbenefit')->where('emp_id', $employee->emplo_id)->first();

            $total_hari = 21;
            $hari_kerja = $total_hari;
            $gaji_bruto = (int) ($gaji->gaji_pokok / 21) * $total_hari + ($gaji->tunjangan / 21) * $total_hari;
            $bpjs_4 = $gaji_bruto * 4 / 100;
            $jpn_2 = $gaji_bruto * 2 / 100;

            DB::table('payroll.gaji_details')->insert([
                'id_gaji' => $this->id_gaji,
                'id_karyawan' => $employee->emplo_id,
                'nama' => $employee->nama,
                'gapok' => $gaji->gaji_pokok,
                'tunjangan_tetap' => $gaji->tunjangan,
                'hari_kerja' => $hari_kerja,
                'lembur' => 0,
                'bpjs_4' => $bpjs_4,
                'bpjs_1' => $gaji_bruto * 1 / 100,
                'jpn_2' => $jpn_2,
                'jpn_1' => $gaji_bruto * 1 / 100,
            ]);
        }
    }
}
