<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrsKeyCultureGuidance extends Model
{
    use HasFactory;

    protected $table = 'trs_keycultureguidance';

    protected $primaryKey = ['keyculture_id', 'guidance_id'];

    public $incrementing = false;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'keyculture_id',
        'objective_id',
        // 'skill',
        // 'objective_purpose',
    ];
}
