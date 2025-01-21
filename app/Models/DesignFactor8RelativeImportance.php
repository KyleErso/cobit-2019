<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignFactor8RelativeImportance extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'design_factor_8_relative_importance';

    // Primary key
    protected $primaryKey = 'id';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'id',
        'df8_id',  // ID terkait Design Factor 8
        'r_df8_1', 'r_df8_2', 'r_df8_3', 'r_df8_4', 'r_df8_5',
        'r_df8_6', 'r_df8_7', 'r_df8_8', 'r_df8_9', 'r_df8_10',
        'r_df8_11', 'r_df8_12', 'r_df8_13', 'r_df8_14', 'r_df8_15',
        'r_df8_16', 'r_df8_17', 'r_df8_18', 'r_df8_19', 'r_df8_20',
        'r_df8_21', 'r_df8_22', 'r_df8_23', 'r_df8_24', 'r_df8_25',
        'r_df8_26', 'r_df8_27', 'r_df8_28', 'r_df8_29', 'r_df8_30',
        'r_df8_31', 'r_df8_32', 'r_df8_33', 'r_df8_34', 'r_df8_35',
        'r_df8_36', 'r_df8_37', 'r_df8_38', 'r_df8_39', 'r_df8_40',
        'created_at',
        'updated_at'
    ];

    // Relasi ke model User (jika diperlukan)
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    // Relasi ke model DesignFactor8
    public function designFactor()
    {
        return $this->belongsTo(DesignFactor8::class, 'df8_id');
    }
}