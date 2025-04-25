<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignFactor2Score extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model ini
    protected $table = 'design_factor_2_score';

    // Kolom yang bisa diisi (fillable)
    protected $fillable = [
        'id',     // ID user yang menyimpan skor
        'df2_id',      // ID dari design factor yang terkait
        'assessment_id',
        's_df2_1',     // Nilai B31 pertama
        's_df2_2',     // Nilai B31 kedua
        's_df2_3',     // Nilai B31 ketiga
        's_df2_4',     // Nilai B31 keempat
        's_df2_5',     // Nilai B31 kelima
        's_df2_6',     // Nilai B31 keenam
        's_df2_7',     // Nilai B31 ketujuh
        's_df2_8',     // Nilai B31 kedelapan
        's_df2_9',     // Nilai B31 kesembilan
        's_df2_10',    // Nilai B31 kesepuluh
        's_df2_11',    // Nilai B31 kesebelas
        's_df2_12',    // Nilai B31 kedua belas
        's_df2_13',    // Nilai B31 ketiga belas
        's_df2_14',    // Nilai B31 keempat belas
        's_df2_15',    // Nilai B31 kelima belas
        's_df2_16',    // Nilai B31 keenam belas
        's_df2_17',    // Nilai B31 ketujuh belas
        's_df2_18',    // Nilai B31 kedelapan belas
        's_df2_19',    // Nilai B31 kesembilan belas
        's_df2_20',    // Nilai B31 kedua puluh
        's_df2_21',    // Nilai B31 kedua puluh satu
        's_df2_22',    // Nilai B31 kedua puluh dua
        's_df2_23',    // Nilai B31 kedua puluh tiga
        's_df2_24',    // Nilai B31 kedua puluh empat
        's_df2_25',    // Nilai B31 kedua puluh lima
        's_df2_26',    // Nilai B31 kedua puluh enam
        's_df2_27',    // Nilai B31 kedua puluh tujuh
        's_df2_28',    // Nilai B31 kedua puluh delapan
        's_df2_29',    // Nilai B31 kedua puluh sembilan
        's_df2_30',    // Nilai B31 ketiga puluh
        's_df2_31',    // Nilai B31 ketiga puluh satu
        's_df2_32',    // Nilai B31 ketiga puluh dua
        's_df2_33',    // Nilai B31 ketiga puluh tiga
        's_df2_34',    // Nilai B31 ketiga puluh empat
        's_df2_35',    // Nilai B31 ketiga puluh lima
        's_df2_36',    // Nilai B31 ketiga puluh enam
        's_df2_37',    // Nilai B31 ketiga puluh tujuh
        's_df2_38',    // Nilai B31 ketiga puluh delapan
        's_df2_39',    // Nilai B31 ketiga puluh sembilan
        's_df2_40',    // Nilai B31 keempat puluh
        'created_at',  // Tanggal dan waktu dibuat
        'updated_at',  // Tanggal dan waktu diperbarui
    ];

    // Jika menggunakan timestamps, pastikan untuk mengatur ini
    public $timestamps = true;

    // Relasi dengan model lain jika diperlukan, misalnya:
    public function designFactor()
    {
        return $this->belongsTo(DesignFactor2::class, 'df2_id');
    }
}
