<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaParkir extends Model
{
    protected $table = 'tb_area_parkir';
    protected $primaryKey = 'id_area';
    public $timestamps = false;

    protected $fillable = ['nama_area', 'kapasitas', 'terisi'];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_area', 'id_area');
    }

    public function sisa(): int
    {
        return max(0, $this->kapasitas - $this->terisi);
    }
}
