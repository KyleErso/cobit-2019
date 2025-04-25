<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignFactor3Score extends Model
{
    use HasFactory;

    // Specify the table name if it doesn't follow Laravel's naming convention
    protected $table = 'design_factor_3_score';

    // Define fillable properties for mass assignment
    protected $fillable = [
        'id',         // ID user who saves the score
        'df3_id',     // ID of the related design factor
        'assessment_id', // ID of the assessment
        's_df3_1',    // Score value 1
        's_df3_2',    // Score value 2
        's_df3_3',    // Score value 3
        's_df3_4',    // Score value 4
        's_df3_5',    // Score value 5
        's_df3_6',    // Score value 6
        's_df3_7',    // Score value 7
        's_df3_8',    // Score value 8
        's_df3_9',    // Score value 9
        's_df3_10',   // Score value 10
        's_df3_11',   // Score value 11
        's_df3_12',   // Score value 12
        's_df3_13',   // Score value 13
        's_df3_14',   // Score value 14
        's_df3_15',   // Score value 15
        's_df3_16',   // Score value 16
        's_df3_17',   // Score value 17
        's_df3_18',   // Score value 18
        's_df3_19',   // Score value 19
        's_df3_20',   // Score value 20
        's_df3_21',   // Score value 21
        's_df3_22',   // Score value 22
        's_df3_23',   // Score value 23
        's_df3_24',   // Score value 24
        's_df3_25',   // Score value 25
        's_df3_26',   // Score value 26
        's_df3_27',   // Score value 27
        's_df3_28',   // Score value 28
        's_df3_29',   // Score value 29
        's_df3_30',   // Score value 30
        's_df3_31',   // Score value 31
        's_df3_32',   // Score value 32
        's_df3_33',   // Score value 33
        's_df3_34',   // Score value 34
        's_df3_35',   // Score value 35
        's_df3_36',   // Score value 36
        's_df3_37',   // Score value 37
        's_df3_38',   // Score value 38
        's_df3_39',   // Score value 39
        's_df3_40',   // Score value 40
        'created_at', // Creation timestamp
        'updated_at', // Update timestamp
    ];

    // If using timestamps, make sure this is set to true
    public $timestamps = true;

    // Define any relationships with other models if necessary
    public function designFactor()
    {
        return $this->belongsTo(DesignFactor3a::class, 'df3_id');
    }
}
