<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignFactor3RelativeImportance extends Model
{
    use HasFactory;

    // Specify the table name if it doesn't follow Laravel's naming convention
    protected $table = 'design_factor_3_relative_importance';

    // Specify the primary key, especially if it doesn't follow the convention 'id'
    protected $primaryKey = 'id';

    // Define fillable properties to allow mass assignment
    protected $fillable = [
        'id',
        'df3_id',
        'r_df3_1',
        'r_df3_2',
        'r_df3_3',
        'r_df3_4',
        'r_df3_5',
        'r_df3_6',
        'r_df3_7',
        'r_df3_8',
        'r_df3_9',
        'r_df3_10',
        'r_df3_11',
        'r_df3_12',
        'r_df3_13',
        'r_df3_14',
        'r_df3_15',
        'r_df3_16',
        'r_df3_17',
        'r_df3_18',
        'r_df3_19',
        'r_df3_20',
        'r_df3_21',
        'r_df3_22',
        'r_df3_23',
        'r_df3_24',
        'r_df3_25',
        'r_df3_26',
        'r_df3_27',
        'r_df3_28',
        'r_df3_29',
        'r_df3_30',
        'r_df3_31',
        'r_df3_32',
        'r_df3_33',
        'r_df3_34',
        'r_df3_35',
        'r_df3_36',
        'r_df3_37',
        'r_df3_38',
        'r_df3_39',
        'r_df3_40',
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
        return $this->belongsTo(DesignFactor3a::class, 'df3_id');
    }
}
