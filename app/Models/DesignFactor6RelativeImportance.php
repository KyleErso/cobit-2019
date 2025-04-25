<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignFactor6RelativeImportance extends Model
{
    use HasFactory;

    // Specify the table name if it doesn't follow Laravel's naming convention
    protected $table = 'design_factor_6_relative_importance';

    // Specify the primary key, especially if it doesn't follow the convention 'id'
    protected $primaryKey = 'id';

    // Define fillable properties to allow mass assignment
    protected $fillable = [
        'id',
        'df6_id',
        'assessment_id',
        'r_df6_1',
        'r_df6_2',
        'r_df6_3',
        'r_df6_4',
        'r_df6_5',
        'r_df6_6',
        'r_df6_7',
        'r_df6_8',
        'r_df6_9',
        'r_df6_10',
        'r_df6_11',
        'r_df6_12',
        'r_df6_13',
        'r_df6_14',
        'r_df6_15',
        'r_df6_16',
        'r_df6_17',
        'r_df6_18',
        'r_df6_19',
        'r_df6_20',
        'r_df6_21',
        'r_df6_22',
        'r_df6_23',
        'r_df6_24',
        'r_df6_25',
        'r_df6_26',
        'r_df6_27',
        'r_df6_28',
        'r_df6_29',
        'r_df6_30',
        'r_df6_31',
        'r_df6_32',
        'r_df6_33',
        'r_df6_34',
        'r_df6_35',
        'r_df6_36',
        'r_df6_37',
        'r_df6_38',
        'r_df6_39',
        'r_df6_40',
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
        return $this->belongsTo(DesignFactor6::class, 'df6_id');
    }
}
