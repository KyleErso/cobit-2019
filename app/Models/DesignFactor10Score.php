<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignFactor10Score extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'design_factor_10_score';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'id',         // ID user yang menyimpan skor
        'df10_id',    // ID terkait Design Factor 10
        'assessment_id',
        's_df10_1',   // Skor 1
        's_df10_2',   // Skor 2
        's_df10_3',   // Skor 3
        's_df10_4',   // Skor 4
        's_df10_5',   // Skor 5
        's_df10_6',   // Skor 6
        's_df10_7',   // Skor 7
        's_df10_8',   // Skor 8
        's_df10_9',   // Skor 9
        's_df10_10',  // Skor 10
        's_df10_11',  // Skor 11
        's_df10_12',  // Skor 12
        's_df10_13',  // Skor 13
        's_df10_14',  // Skor 14
        's_df10_15',  // Skor 15
        's_df10_16',  // Skor 16
        's_df10_17',  // Skor 17
        's_df10_18',  // Skor 18
        's_df10_19',  // Skor 19
        's_df10_20',  // Skor 20
        's_df10_21',  // Skor 21
        's_df10_22',  // Skor 22
        's_df10_23',  // Skor 23
        's_df10_24',  // Skor 24
        's_df10_25',  // Skor 25
        's_df10_26',  // Skor 26
        's_df10_27',  // Skor 27
        's_df10_28',  // Skor 28
        's_df10_29',  // Skor 29
        's_df10_30',  // Skor 30
        's_df10_31',  // Skor 31
        's_df10_32',  // Skor 32
        's_df10_33',  // Skor 33
        's_df10_34',  // Skor 34
        's_df10_35',  // Skor 35
        's_df10_36',  // Skor 36
        's_df10_37',  // Skor 37
        's_df10_38',  // Skor 38
        's_df10_39',  // Skor 39
        's_df10_40',  // Skor 40
        'created_at', // Timestamp created_at
        'updated_at', // Timestamp updated_at
    ];

    // Aktifkan timestamps
    public $timestamps = true;

    // Relasi ke model DesignFactor10
    public function designFactor()
    {
        return $this->belongsTo(DesignFactor10::class, 'df10_id');
    }
}