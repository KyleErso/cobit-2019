<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignFactor2 extends Model
{
    use HasFactory;

    protected $table = 'design_factor_2';

    protected $fillable = [
        'id',
        'df_id',
        'assessment_id',
        'input1df2',
        'input2df2',
        'input3df2',
        'input4df2',
        'input5df2',
        'input6df2',
        'input7df2',
        'input8df2',
        'input9df2',
        'input10df2',
        'input11df2',
        'input12df2',
        'input13df2',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;
}
