<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrsSkillGuidance extends Model
{
    use HasFactory;

    protected $table = 'trs_skillguidance';

    protected $primaryKey = ['skill_id', 'guidance_id'];

    public $incrementing = false;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'skill_id',
        'objective_id',
        // 'skill',
        // 'objective_purpose',
    ];
}
