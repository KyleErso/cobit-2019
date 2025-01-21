<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignFactor6 extends Model
{
    use HasFactory;

    protected $table = 'design_factor_6';  // Ensure this matches your database table

    protected $fillable = [
        'id',     
        'df_id',
        'input1df6',
        'input2df6',
        'input3df6',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;  // Automatically handles timestamps
}
