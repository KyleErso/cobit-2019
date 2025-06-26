<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstObjective extends Model
{
    use HasFactory;
    
    protected $table = 'mst_objective';

    protected $primaryKey = 'objective_id';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'objective_id',
        'objective',
        'objective_description',
        'objective_purpose',
    ];

    public function domains()
    {
        return $this->belongsToMany(
            MstArea::class,
            'trs_domain',
            'objective_id',
            'area'
        )->withPivot('domain');
    }

    public function practices()
    {
        return $this->hasMany(MstPractice::class, 'objective_id', 'objective_id');
    }

    public function policies()
    {
        return $this->hasMany(MstPolicy::class, 'objective_id', 'objective_id');
    }

    public function SIA()
    {
        return $this->hasMany(MstSIA::class, 'objective_id', 'objective_id');
    }
}
