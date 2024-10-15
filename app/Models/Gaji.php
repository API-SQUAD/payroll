<?php

namespace App\Models;

use CaliCastle\Cuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $table = 'payroll.gajis';

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Cuid::make();
            $model->nama_user = auth()->user()->fullname;
        });

        static::deleting(function ($model) {
            $model->gaji_details()->delete();
            $model->koreksi_gajis()->delete();
            $model->potongan_gajis()->delete();
        });
    }

    public function gaji_details()
    {
        return $this->hasMany(GajiDetail::class, 'id_gaji', 'id');
    }
}
