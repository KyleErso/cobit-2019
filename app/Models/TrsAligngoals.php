<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrsAligngoals extends Model
{
    public $incrementing = false;

    public $timestamps = false;

    protected $table = 'trs_aligngoals';

    protected $primaryKey = ['objective_id', 'aligngoals_id'];

    protected $keyType = 'string';

    protected $fillable = [
        'objective_id',
        'aligngoals_id',
    ];

    public function objective()
    {
        return $this->belongsTo(MstObjective::class, 'objective_id');
    }

    public function aligngoals()
    {
        return $this->belongsTo(MstAligngoals::class, 'aligngoals_id');
    }
}
