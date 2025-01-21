<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignFactor7Score extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'design_factor_7_score';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'id',         // ID user yang menyimpan skor
        'df7_id',     // ID terkait Design Factor 7
        's_df7_1',    // Skor 1
        's_df7_2',    // Skor 2
        's_df7_3',    // Skor 3
        's_df7_4',    // Skor 4
        's_df7_5',    // Skor 5
        's_df7_6',    // Skor 6
        's_df7_7',    // Skor 7
        's_df7_8',    // Skor 8
        's_df7_9',    // Skor 9
        's_df7_10',   // Skor 10
        's_df7_11',   // Skor 11
        's_df7_12',   // Skor 12
        's_df7_13',   // Skor 13
        's_df7_14',   // Skor 14
        's_df7_15',   // Skor 15
        's_df7_16',   // Skor 16
        's_df7_17',   // Skor 17
        's_df7_18',   // Skor 18
        's_df7_19',   // Skor 19
        's_df7_20',   // Skor 20
        's_df7_21',   // Skor 21
        's_df7_22',   // Skor 22
        's_df7_23',   // Skor 23
        's_df7_24',   // Skor 24
        's_df7_25',   // Skor 25
        's_df7_26',   // Skor 26
        's_df7_27',   // Skor 27
        's_df7_28',   // Skor 28
        's_df7_29',   // Skor 29
        's_df7_30',   // Skor 30
        's_df7_31',   // Skor 31
        's_df7_32',   // Skor 32
        's_df7_33',   // Skor 33
        's_df7_34',   // Skor 34
        's_df7_35',   // Skor 35
        's_df7_36',   // Skor 36
        's_df7_37',   // Skor 37
        's_df7_38',   // Skor 38
        's_df7_39',   // Skor 39
        's_df7_40',   // Skor 40
        'created_at', // Timestamp created_at
        'updated_at', // Timestamp updated_at
    ];

    // Aktifkan timestamps
    public $timestamps = true;

    // Relasi ke model DesignFactor7
    public function designFactor()
    {
        return $this->belongsTo(DesignFactor7::class, 'df7_id');
    }
}