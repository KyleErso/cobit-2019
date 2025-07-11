<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrsPolicyGuidance extends Model
{
    use HasFactory;

    protected $table = 'trs_policyguidance';

    protected $primaryKey = ['policy_id', 'guidance_id'];

    public $incrementing = false;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'policy_id',
        'objective_id',
        // 'skill',
        // 'objective_purpose',
    ];
}
