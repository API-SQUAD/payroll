<?php

namespace App\Models;

use CaliCastle\Cuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GajiDetail extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $table = 'payroll.gaji_details';

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Cuid::make();
        });

        static::deleting(function ($model) {
            $model->koreksi_gajis()->delete();
            $model->potongan_gajis()->delete();
        });
    }

    public function gaji()
    {
        return $this->belongsTo(Gaji::class, 'id_gaji', 'id');
    }

    public function koreksi_gajis()
    {
        return $this->hasMany(KoreksiGaji::class, 'id_gaji_detail', 'id');
    }

    public function potongan_gajis()
    {
        return $this->hasMany(PotonganGaji::class, 'id_gaji_detail', 'id');
    }
}
