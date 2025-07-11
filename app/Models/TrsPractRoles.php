<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrsPractRoles extends Model
{
    use HasFactory;

    protected $table = 'trs_practroles';

    protected $primaryKey = ['objective_id', 'guidance_id'];

    public $incrementing = false;

    // protected $keyType = 'int';

    protected $casts = [
        'objective_id' => 'string',
        'guidance_id' => 'integer',
    ];

    public $timestamps = false;

    protected $fillable = [
        'objective_id',
        'guidance_id',
        'component'
        // 'skill',
        // 'objective_purpose',
    ];
}
