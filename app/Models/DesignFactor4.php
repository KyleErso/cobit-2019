<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignFactor4 extends Model
{
    use HasFactory;

    protected $table = 'design_factor_4';

    protected $fillable = [
        'id',
        'df_id',
        
        'input1df4',
        'input2df4',
        'input3df4',
        'input4df4',
        'input5df4',
        'input6df4',
        'input7df4',
        'input8df4',
        'input9df4',
        'input10df4',
        'input11df4',
        'input12df4',
        'input13df4',
        'input14df4',
        'input15df4',
        'input16df4',
        'input17df4',
        'input18df4',
        'input19df4',
        'input20df4',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;
}
