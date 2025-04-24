<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignFactor1RelativeImportance extends Model
{
    use HasFactory;

    // Specify the table name if it doesn't follow Laravel's naming convention
    protected $table = 'design_factor_1_relative_importance';

    // Specify the primary key, especially if it doesn't follow the convention 'id'
    protected $primaryKey = 'id';

    // Define fillable properties to allow mass assignment
    protected $fillable = [
        'id',
        'df1_id',
        'assessment_id',
        'r_df1_1', 'r_df1_2', 'r_df1_3', 'r_df1_4', 'r_df1_5',
        'r_df1_6', 'r_df1_7', 'r_df1_8', 'r_df1_9', 'r_df1_10',
        'r_df1_11', 'r_df1_12', 'r_df1_13', 'r_df1_14', 'r_df1_15',
        'r_df1_16', 'r_df1_17', 'r_df1_18', 'r_df1_19', 'r_df1_20',
        'r_df1_21', 'r_df1_22', 'r_df1_23', 'r_df1_24', 'r_df1_25',
        'r_df1_26', 'r_df1_27', 'r_df1_28', 'r_df1_29', 'r_df1_30',
        'r_df1_31', 'r_df1_32', 'r_df1_33', 'r_df1_34', 'r_df1_35',
        'r_df1_36', 'r_df1_37', 'r_df1_38', 'r_df1_39', 'r_df1_40',
        'created_at', 'updated_at'
    ];

    // Define relationships if necessary
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function designFactor()
    {
        return $this->belongsTo(DesignFactor1::class, 'df1_id');
    }
}
