<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstSkill extends Model
{
    use HasFactory;

    protected $table = 'mst_skill';

    protected $primaryKey = 'skill_id';

    // public $incrementing = false;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'skill_id',
        'objective_id',
        'skill',
        // 'objective_purpose',
    ];
}
