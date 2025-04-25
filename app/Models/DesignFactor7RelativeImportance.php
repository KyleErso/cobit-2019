<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignFactor7RelativeImportance extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'design_factor_7_relative_importance';

    // Primary key
    protected $primaryKey = 'id';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'id',
        'df7_id',  // ID terkait Design Factor 7
        'assessment_id',
        'r_df7_1', 'r_df7_2', 'r_df7_3', 'r_df7_4', 'r_df7_5',
        'r_df7_6', 'r_df7_7', 'r_df7_8', 'r_df7_9', 'r_df7_10',
        'r_df7_11', 'r_df7_12', 'r_df7_13', 'r_df7_14', 'r_df7_15',
        'r_df7_16', 'r_df7_17', 'r_df7_18', 'r_df7_19', 'r_df7_20',
        'r_df7_21', 'r_df7_22', 'r_df7_23', 'r_df7_24', 'r_df7_25',
        'r_df7_26', 'r_df7_27', 'r_df7_28', 'r_df7_29', 'r_df7_30',
        'r_df7_31', 'r_df7_32', 'r_df7_33', 'r_df7_34', 'r_df7_35',
        'r_df7_36', 'r_df7_37', 'r_df7_38', 'r_df7_39', 'r_df7_40',
        'created_at',
        'updated_at'
    ];

    // Relasi ke model User (jika diperlukan)
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    // Relasi ke model DesignFactor7
    public function designFactor()
    {
        return $this->belongsTo(DesignFactor7::class, 'df7_id');
    }
}