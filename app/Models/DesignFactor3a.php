<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignFactor3a extends Model
{
    use HasFactory;

    protected $table = 'design_factor_3_a';

    protected $fillable = [
        'id',
        'df_id',
        'assessment_id',
        'input1df3',
        'input2df3',
        'input3df3',
        'input4df3',
        'input5df3',
        'input6df3',
        'input7df3',
        'input8df3',
        'input9df3',
        'input10df3',
        'input11df3',
        'input12df3',
        'input13df3',
        'input14df3',
        'input15df3',
        'input16df3',
        'input17df3',
        'input18df3',
        'input19df3',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;
}
