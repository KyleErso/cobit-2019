<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignFactor9RelativeImportance extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'design_factor_9_relative_importance';

    // Primary key
    protected $primaryKey = 'id';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'id',
        'df9_id',  // ID terkait Design Factor 9
        'r_df9_1', 'r_df9_2', 'r_df9_3', 'r_df9_4', 'r_df9_5',
        'r_df9_6', 'r_df9_7', 'r_df9_8', 'r_df9_9', 'r_df9_10',
        'r_df9_11', 'r_df9_12', 'r_df9_13', 'r_df9_14', 'r_df9_15',
        'r_df9_16', 'r_df9_17', 'r_df9_18', 'r_df9_19', 'r_df9_20',
        'r_df9_21', 'r_df9_22', 'r_df9_23', 'r_df9_24', 'r_df9_25',
        'r_df9_26', 'r_df9_27', 'r_df9_28', 'r_df9_29', 'r_df9_30',
        'r_df9_31', 'r_df9_32', 'r_df9_33', 'r_df9_34', 'r_df9_35',
        'r_df9_36', 'r_df9_37', 'r_df9_38', 'r_df9_39', 'r_df9_40',
        'created_at',
        'updated_at'
    ];

    // Relasi ke model User (jika diperlukan)
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    // Relasi ke model DesignFactor9
    public function designFactor()
    {
        return $this->belongsTo(DesignFactor9::class, 'df9_id');
    }
}