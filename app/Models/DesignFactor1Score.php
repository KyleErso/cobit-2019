<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignFactor1Score extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model ini
    protected $table = 'design_factor_1_score';

    // Kolom yang bisa diisi (fillable)
    protected $fillable = [
        'id',     // ID user yang menyimpan skor
        'df1_id',      // ID dari design factor yang terkait
        's_df1_1',     // Nilai B22 pertama
        's_df1_2',     // Nilai B22 kedua
        's_df1_3',     // Nilai B22 ketiga
        's_df1_4',     // Nilai B22 keempat
        's_df1_5',     // Nilai B22 kelima
        's_df1_6',     // Nilai B22 keenam
        's_df1_7',     // Nilai B22 ketujuh
        's_df1_8',     // Nilai B22 kedelapan
        's_df1_9',     // Nilai B22 kesembilan
        's_df1_10',    // Nilai B22 kesepuluh
        's_df1_11',    // Nilai B22 kesebelas
        's_df1_12',    // Nilai B22 kedua belas
        's_df1_13',    // Nilai B22 ketiga belas
        's_df1_14',    // Nilai B22 keempat belas
        's_df1_15',    // Nilai B22 kelima belas
        's_df1_16',    // Nilai B22 keenam belas
        's_df1_17',    // Nilai B22 ketujuh belas
        's_df1_18',    // Nilai B22 kedelapan belas
        's_df1_19',    // Nilai B22 kesembilan belas
        's_df1_20',    // Nilai B22 kedua puluh
        's_df1_21',    // Nilai B22 kedua puluh satu
        's_df1_22',    // Nilai B22 kedua puluh dua
        's_df1_23',    // Nilai B22 kedua puluh tiga
        's_df1_24',    // Nilai B22 kedua puluh empat
        's_df1_25',    // Nilai B22 kedua puluh lima
        's_df1_26',    // Nilai B22 kedua puluh enam
        's_df1_27',    // Nilai B22 kedua puluh tujuh
        's_df1_28',    // Nilai B22 kedua puluh delapan
        's_df1_29',    // Nilai B22 kedua puluh sembilan
        's_df1_30',    // Nilai B22 ketiga puluh
        's_df1_31',    // Nilai B22 ketiga puluh satu
        's_df1_32',    // Nilai B22 ketiga puluh dua
        's_df1_33',    // Nilai B22 ketiga puluh tiga
        's_df1_34',    // Nilai B22 ketiga puluh empat
        's_df1_35',    // Nilai B22 ketiga puluh lima
        's_df1_36',    // Nilai B22 ketiga puluh enam
        's_df1_37',    // Nilai B22 ketiga puluh tujuh
        's_df1_38',    // Nilai B22 ketiga puluh delapan
        's_df1_39',    // Nilai B22 ketiga puluh sembilan
        's_df1_40',    // Nilai B22 keempat puluh
        'created_at',  // Tanggal dan waktu dibuat
        'updated_at',  // Tanggal dan waktu diperbarui
    ];

    // Jika menggunakan timestamps, pastikan untuk mengatur ini
    public $timestamps = true;

    // Relasi dengan model lain jika diperlukan, misalnya:
    public function designFactor()
    {
        return $this->belongsTo(DesignFactor1::class, 'df1_id');
    }
}
