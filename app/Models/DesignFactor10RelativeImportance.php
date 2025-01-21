<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignFactor10RelativeImportance extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'design_factor_10_relative_importance';

    // Primary key
    protected $primaryKey = 'id';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'id',
        'df10_id',  // ID terkait Design Factor 10
        'r_df10_1', 'r_df10_2', 'r_df10_3', 'r_df10_4', 'r_df10_5',
        'r_df10_6', 'r_df10_7', 'r_df10_8', 'r_df10_9', 'r_df10_10',
        'r_df10_11', 'r_df10_12', 'r_df10_13', 'r_df10_14', 'r_df10_15',
        'r_df10_16', 'r_df10_17', 'r_df10_18', 'r_df10_19', 'r_df10_20',
        'r_df10_21', 'r_df10_22', 'r_df10_23', 'r_df10_24', 'r_df10_25',
        'r_df10_26', 'r_df10_27', 'r_df10_28', 'r_df10_29', 'r_df10_30',
        'r_df10_31', 'r_df10_32', 'r_df10_33', 'r_df10_34', 'r_df10_35',
        'r_df10_36', 'r_df10_37', 'r_df10_38', 'r_df10_39', 'r_df10_40',
        'created_at',
        'updated_at'
    ];

    // Relasi ke model User (jika diperlukan)
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    // Relasi ke model DesignFactor10
    public function designFactor()
    {
        return $this->belongsTo(DesignFactor10::class, 'df10_id');
    }
}