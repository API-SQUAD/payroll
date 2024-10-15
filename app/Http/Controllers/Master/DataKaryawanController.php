<?php
namespace App\Http\Controllers\Master;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
class DataKaryawanController extends Controller
{
    public function index()
    {
        return view('master.karyawan.data-karyawan');
    }
    public function data(Request $request)
    {
        $karyawans = DB::table('public.employee')
                        ->join('public.empcompany', 'public.employee.emplo_id', '=', 'public.empcompany.id_emp')
                        ->select(
                            'public.employee.emplo_id as id',
                            'public.employee.NIK as nik',
                            'public.employee.nama',
                            'public.empcompany.jabatan',
                            'public.empcompany.divisi_region',
                            'public.empcompany.kantor_cab',
                            'public.empcompany.perusahaan',
                        )
                        ->where('public.empcompany.status', 'AKTIF')
                        ->get();
        if ($request->ajax()) {
            return DataTables::of($karyawans)
                ->addIndexColumn()
                ->addColumn('divisi_cabang', function ($karyawan) {
                    $divisi_cabang = $karyawan->divisi_region . ' / ' . $karyawan->kantor_cab;
                    return $divisi_cabang;
                })
                ->addColumn('action', function ($karyawan) {
                    $route_resign_sementara = route('data_karyawan.resign', encrypt($karyawan->id));
                    $route_edit = route('data_karyawan.edit', encrypt($karyawan->id));
                    $route_destroy = route('data_karyawan.destroy', encrypt($karyawan->id));
                    $btn = '';
                    $btn .= '<a href="javascript:void(0)" class="btn btn-sm btn-success" id="resign" title="Resign Sementara" data-toggle="tooltip" data-placement="top" data-url="' . $route_resign_sementara . '">
                                <i class="fa fa-user-times"></i>
                            </a>';
                    $btn .= ' | ';
                    $btn .= '<a href="javascript:void(0)" class="btn btn-sm btn-info" id="ubah" title="Edit" data-toggle="tooltip" data-placement="top" data-url="' . $route_edit . '">
                                <i class="fa fa-file"></i>
                            </a>';
                    $btn .= ' | ';
                    $btn .= '<a href="javascript:void(0)" class="btn btn-sm btn-danger" id="hapus" title="Delete" data-toggle="tooltip" data-placement="top" data-url="' . $route_destroy . '">
                                <i class="fa fa-trash"></i>
                            </a>';
                    return $btn;
                })
                ->rawColumns(['divisi_cabang', 'action'])
                ->make(true);
        }
    }
    public function edit($id)
    {
        $idKaryawan = decrypt($id);
        $data = DB::table('public.employee')
                        ->join('public.empcompany', 'public.employee.emplo_id', '=', 'public.empcompany.id_emp')
                        ->join('public.riwayatkj', 'public.employee.emplo_id', '=', 'public.riwayatkj.emplo_id')
                        ->join('public.empcard', 'public.employee.emplo_id', '=', 'public.empcard.emplo_id')
                        ->join('public.empbenefit', 'public.employee.emplo_id', '=', 'public.empbenefit.emp_id')
                        ->join('public.pendidikan', 'public.employee.emplo_id', '=', 'public.pendidikan.emplo_id')
                        ->select(
                            'public.employee.emplo_id as id_karyawan',
                            'public.employee.NIK as nik',
                            'public.employee.ktp',
                            'public.employee.no_kk',
                            'public.employee.nama',
                            'public.employee.tempat_lahir',
                            'public.employee.tanggal_lahir',
                            'public.employee.ibu_kandung',
                            'public.employee.jenis_kelamin',
                            'public.employee.gol_darah',
                            'public.employee.agama',
                            'public.employee.alamat_ktp',
                            'public.employee.alamat_domisili',
                            'public.employee.email_pribadi',
                            'public.employee.email_perusahaan',
                            'public.employee.no_hp',
                            'public.empcard.npwp',
                            'public.pendidikan.nama_lembaga',
                            'public.pendidikan.tingkat_pendidikan',
                            'public.pendidikan.jurusan',
                            'public.empcompany.divisi_region',
                            'public.empcompany.kantor_cab',
                            'public.empcompany.status',
                            'public.empcompany.status_karyawan',
                            'public.empcompany.jabatan as jabatan_awal',
                            'public.riwayatkj.jabatan as jabatan_sekarang',
                            'public.empcompany.dirin',
                            'public.empcompany.status_gol',
                            'public.empcompany.tgl_join',
                            'public.empcompany.tgl_akhir_ker as tgl_akhir_kontrak',
                            'public.riwayatkj.start_pkwt',
                            'public.riwayatkj.end_pkwt',
                            'public.empbenefit.stat_ptkp as sk_tetap',
                            'public.empbenefit.sk_pengangkatan as tgl_sk_tetap',
                            'public.empcard.pem_rek',
                            'public.empcard.rek_mandiri',
                            'public.empcard.bpjstk',
                            'public.empcard.bpjskes',
                            'public.empbenefit.gaji_pokok',
                            'public.empbenefit.tunjangan',
                        )
                        ->where('public.employee.emplo_id', $idKaryawan)
                        ->first();
        return view('master.karyawan.edit', compact('data'));
    }
}