<?php

namespace App\Models;

use CaliCastle\Cuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PotonganGaji extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $table = 'payroll.potongan_gajis';

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Cuid::make();
        });
    }

    public function gaji_detail()
    {
        return $this->belongsTo(GajiDetail::class, 'id_gaji_detail', 'id');
    }
}
