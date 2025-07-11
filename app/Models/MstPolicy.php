<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstPolicy extends Model
{
    use HasFactory;

    protected $table = 'mst_policy';

    protected $primaryKey = 'policy_id';

    // public $incrementing = false;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'policy_id',
        'objective_id',
        'policy',
        'description',
        // 'objective_purpose',
    ];

    public function objective()
    {
        return $this->belongsTo(MstObjective::class, 'objective_id');
    }

    public function guidances()
    {
        return $this->belongsToMany(
            MstGuidance::class,
            'trs_policyguidance',  // pivot table
            'policy_id',           // this model’s FK on pivot
            'guidance_id'            // other model’s FK on pivot
        );
    }
}

