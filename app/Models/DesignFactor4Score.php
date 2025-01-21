<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignFactor4Score extends Model
{
    use HasFactory;

    // Specify the table name if it doesn't follow Laravel's naming convention
    protected $table = 'design_factor_4_score';

    // Define fillable properties for mass assignment
    protected $fillable = [
        'id',         // ID user who saves the score
        'df4_id',     // ID of the related design factor
        's_df4_1',    // Score value 1
        's_df4_2',    // Score value 2
        's_df4_3',    // Score value 3
        's_df4_4',    // Score value 4
        's_df4_5',    // Score value 5
        's_df4_6',    // Score value 6
        's_df4_7',    // Score value 7
        's_df4_8',    // Score value 8
        's_df4_9',    // Score value 9
        's_df4_10',   // Score value 10
        's_df4_11',   // Score value 11
        's_df4_12',   // Score value 12
        's_df4_13',   // Score value 13
        's_df4_14',   // Score value 14
        's_df4_15',   // Score value 15
        's_df4_16',   // Score value 16
        's_df4_17',   // Score value 17
        's_df4_18',   // Score value 18
        's_df4_19',   // Score value 19
        's_df4_20',   // Score value 20
        's_df4_21',   // Score value 21
        's_df4_22',   // Score value 22
        's_df4_23',   // Score value 23
        's_df4_24',   // Score value 24
        's_df4_25',   // Score value 25
        's_df4_26',   // Score value 26
        's_df4_27',   // Score value 27
        's_df4_28',   // Score value 28
        's_df4_29',   // Score value 29
        's_df4_30',   // Score value 30
        's_df4_31',   // Score value 31
        's_df4_32',   // Score value 32
        's_df4_33',   // Score value 33
        's_df4_34',   // Score value 34
        's_df4_35',   // Score value 35
        's_df4_36',   // Score value 36
        's_df4_37',   // Score value 37
        's_df4_38',   // Score value 38
        's_df4_39',   // Score value 39
        's_df4_40',   // Score value 40
        'created_at', // Creation timestamp
        'updated_at', // Update timestamp
    ];

    // If using timestamps, make sure this is set to true
    public $timestamps = true;

    // Define any relationships with other models if necessary
    public function designFactor()
    {
        return $this->belongsTo(DesignFactor4::class, 'df4_id');
    }
}
