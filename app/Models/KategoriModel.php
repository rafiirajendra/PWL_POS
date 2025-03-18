<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriModel extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model ini
    protected $table = 'm_kategori';

    // Primary Key
    protected $primaryKey = 'kategori_id';

    // Kolom yang dapat diisi
    protected $fillable = ['kategori_id', 'kategori_kode', 'kategori_nama'];

    // Relasi ke tabel barang
    public function barang()
    {
        return $this->hasMany(BarangModel::class, 'kategori_id', 'kategori_id');
    }
}