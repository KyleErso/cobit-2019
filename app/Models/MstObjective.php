<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstObjective extends Model
{
    use HasFactory;
    
    protected $table = 'mst_objective';

    protected $primaryKey = 'objective_id';

    // public $incrementing = true;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'objective_id',
        'objective',
        'objective_description',
        'objective_purpose',
    ];
}
