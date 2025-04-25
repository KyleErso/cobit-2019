<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignFactor8Score extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'design_factor_8_score';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'id',         // ID user yang menyimpan skor
        'df8_id',     // ID terkait Design Factor 8
        'assessment_id',
        's_df8_1',    // Skor 1
        's_df8_2',    // Skor 2
        's_df8_3',    // Skor 3
        's_df8_4',    // Skor 4
        's_df8_5',    // Skor 5
        's_df8_6',    // Skor 6
        's_df8_7',    // Skor 7
        's_df8_8',    // Skor 8
        's_df8_9',    // Skor 9
        's_df8_10',   // Skor 10
        's_df8_11',   // Skor 11
        's_df8_12',   // Skor 12
        's_df8_13',   // Skor 13
        's_df8_14',   // Skor 14
        's_df8_15',   // Skor 15
        's_df8_16',   // Skor 16
        's_df8_17',   // Skor 17
        's_df8_18',   // Skor 18
        's_df8_19',   // Skor 19
        's_df8_20',   // Skor 20
        's_df8_21',   // Skor 21
        's_df8_22',   // Skor 22
        's_df8_23',   // Skor 23
        's_df8_24',   // Skor 24
        's_df8_25',   // Skor 25
        's_df8_26',   // Skor 26
        's_df8_27',   // Skor 27
        's_df8_28',   // Skor 28
        's_df8_29',   // Skor 29
        's_df8_30',   // Skor 30
        's_df8_31',   // Skor 31
        's_df8_32',   // Skor 32
        's_df8_33',   // Skor 33
        's_df8_34',   // Skor 34
        's_df8_35',   // Skor 35
        's_df8_36',   // Skor 36
        's_df8_37',   // Skor 37
        's_df8_38',   // Skor 38
        's_df8_39',   // Skor 39
        's_df8_40',   // Skor 40
        'created_at', // Timestamp created_at
        'updated_at', // Timestamp updated_at
    ];

    // Aktifkan timestamps
    public $timestamps = true;

    // Relasi ke model DesignFactor8
    public function designFactor()
    {
        return $this->belongsTo(DesignFactor8::class, 'df8_id');
    }
}