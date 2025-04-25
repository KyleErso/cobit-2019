<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignFactor5RelativeImportance extends Model
{
    use HasFactory;

    // Specify the table name if it doesn't follow Laravel's naming convention
    protected $table = 'design_factor_5_relative_importance';

    // Specify the primary key, especially if it doesn't follow the convention 'id'
    protected $primaryKey = 'id';

    // Define fillable properties to allow mass assignment
    protected $fillable = [
        'id',
        'df5_id',
        'assessment_id',
        'r_df5_1',
        'r_df5_2',
        'r_df5_3',
        'r_df5_4',
        'r_df5_5',
        'r_df5_6',
        'r_df5_7',
        'r_df5_8',
        'r_df5_9',
        'r_df5_10',
        'r_df5_11',
        'r_df5_12',
        'r_df5_13',
        'r_df5_14',
        'r_df5_15',
        'r_df5_16',
        'r_df5_17',
        'r_df5_18',
        'r_df5_19',
        'r_df5_20',
        'r_df5_21',
        'r_df5_22',
        'r_df5_23',
        'r_df5_24',
        'r_df5_25',
        'r_df5_26',
        'r_df5_27',
        'r_df5_28',
        'r_df5_29',
        'r_df5_30',
        'r_df5_31',
        'r_df5_32',
        'r_df5_33',
        'r_df5_34',
        'r_df5_35',
        'r_df5_36',
        'r_df5_37',
        'r_df5_38',
        'r_df5_39',
        'r_df5_40',
        'created_at',
        'updated_at'
    ];

    // Define relationships if necessary
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function designFactor()
    {
        return $this->belongsTo(DesignFactor5::class, 'df5_id');
    }
}
