<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignFactor4RelativeImportance extends Model
{
    use HasFactory;

    // Specify the table name if it doesn't follow Laravel's naming convention
    protected $table = 'design_factor_4_relative_importance';

    // Specify the primary key, especially if it doesn't follow the convention 'id'
    protected $primaryKey = 'id';

    // Define fillable properties to allow mass assignment
    protected $fillable = [
        'id',
        'df4_id',
        'r_df4_1',
        'r_df4_2',
        'r_df4_3',
        'r_df4_4',
        'r_df4_5',
        'r_df4_6',
        'r_df4_7',
        'r_df4_8',
        'r_df4_9',
        'r_df4_10',
        'r_df4_11',
        'r_df4_12',
        'r_df4_13',
        'r_df4_14',
        'r_df4_15',
        'r_df4_16',
        'r_df4_17',
        'r_df4_18',
        'r_df4_19',
        'r_df4_20',
        'r_df4_21',
        'r_df4_22',
        'r_df4_23',
        'r_df4_24',
        'r_df4_25',
        'r_df4_26',
        'r_df4_27',
        'r_df4_28',
        'r_df4_29',
        'r_df4_30',
        'r_df4_31',
        'r_df4_32',
        'r_df4_33',
        'r_df4_34',
        'r_df4_35',
        'r_df4_36',
        'r_df4_37',
        'r_df4_38',
        'r_df4_39',
        'r_df4_40',
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
        return $this->belongsTo(DesignFactor4::class, 'df4_id');
    }
}
