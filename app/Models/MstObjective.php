<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MstObjective extends Model
{
    protected $table = 'mst_objective';

    protected $primaryKey = 'objective_id';

    // public $incrementing = true;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'objective',
        'objective_description',
        'objective_purpose',
    ];
}
