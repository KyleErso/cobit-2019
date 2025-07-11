<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrsInfoflowIO extends Model
{
    use HasFactory;

    protected $table = 'trs_infoflowio';

    protected $primaryKey = ['input_id', 'output_id'];

    public $incrementing = false;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'input_id',
        'output_id',
        // 'skill',
        // 'objective_purpose',
    ];
}
