<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignFactor1 extends Model
{
    use HasFactory;

    protected $table = 'design_factor_1';

    protected $fillable = [
        'id',
        'df_id',
        'input1df1',
        'input2df1',
        'input3df1',
        'input4df1',
        'assessment_id',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;
}
