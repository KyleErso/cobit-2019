<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignFactor5 extends Model
{
    use HasFactory;

    protected $table = 'design_factor_5';  // Ensure this matches your database table

    protected $fillable = [
        'id',     
        'df_id',
        'input1df5',
        'input2df5',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;  // Automatically handles timestamps
}
