<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignFactor9Score extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'design_factor_9_score';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'id',         // ID user yang menyimpan skor
        'df9_id',     // ID terkait Design Factor 9
        'assessment_id',
        's_df9_1',    // Skor 1
        's_df9_2',    // Skor 2
        's_df9_3',    // Skor 3
        's_df9_4',    // Skor 4
        's_df9_5',    // Skor 5
        's_df9_6',    // Skor 6
        's_df9_7',    // Skor 7
        's_df9_8',    // Skor 8
        's_df9_9',    // Skor 9
        's_df9_10',   // Skor 10
        's_df9_11',   // Skor 11
        's_df9_12',   // Skor 12
        's_df9_13',   // Skor 13
        's_df9_14',   // Skor 14
        's_df9_15',   // Skor 15
        's_df9_16',   // Skor 16
        's_df9_17',   // Skor 17
        's_df9_18',   // Skor 18
        's_df9_19',   // Skor 19
        's_df9_20',   // Skor 20
        's_df9_21',   // Skor 21
        's_df9_22',   // Skor 22
        's_df9_23',   // Skor 23
        's_df9_24',   // Skor 24
        's_df9_25',   // Skor 25
        's_df9_26',   // Skor 26
        's_df9_27',   // Skor 27
        's_df9_28',   // Skor 28
        's_df9_29',   // Skor 29
        's_df9_30',   // Skor 30
        's_df9_31',   // Skor 31
        's_df9_32',   // Skor 32
        's_df9_33',   // Skor 33
        's_df9_34',   // Skor 34
        's_df9_35',   // Skor 35
        's_df9_36',   // Skor 36
        's_df9_37',   // Skor 37
        's_df9_38',   // Skor 38
        's_df9_39',   // Skor 39
        's_df9_40',   // Skor 40
        'created_at', // Timestamp created_at
        'updated_at', // Timestamp updated_at
    ];

    // Aktifkan timestamps
    public $timestamps = true;

    // Relasi ke model DesignFactor9
    public function designFactor()
    {
        return $this->belongsTo(DesignFactor9::class, 'df9_id');
    }
}