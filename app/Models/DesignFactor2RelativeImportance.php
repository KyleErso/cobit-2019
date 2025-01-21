<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignFactor2RelativeImportance extends Model
{
    use HasFactory;

    // Specify the table name if it doesn't follow Laravel's naming convention
    protected $table = 'design_factor_2_relative_importance';

    // Specify the primary key, especially if it doesn't follow the convention 'id'
    protected $primaryKey = 'id';

    // Define fillable properties to allow mass assignment
    protected $fillable = [
        'id',
        'df2_id',
        'r_df2_1', 'r_df2_2', 'r_df2_3', 'r_df2_4', 'r_df2_5',
        'r_df2_6', 'r_df2_7', 'r_df2_8', 'r_df2_9', 'r_df2_10',
        'r_df2_11', 'r_df2_12', 'r_df2_13', 'r_df2_14', 'r_df2_15',
        'r_df2_16', 'r_df2_17', 'r_df2_18', 'r_df2_19', 'r_df2_20',
        'r_df2_21', 'r_df2_22', 'r_df2_23', 'r_df2_24', 'r_df2_25',
        'r_df2_26', 'r_df2_27', 'r_df2_28', 'r_df2_29', 'r_df2_30',
        'r_df2_31', 'r_df2_32', 'r_df2_33', 'r_df2_34', 'r_df2_35',
        'r_df2_36', 'r_df2_37', 'r_df2_38', 'r_df2_39', 'r_df2_40',
        'created_at', 'updated_at'
    ];

    // Define relationships if necessary
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function designFactor()
    {
        return $this->belongsTo(DesignFactor2::class, 'df2_id');
    }
}
