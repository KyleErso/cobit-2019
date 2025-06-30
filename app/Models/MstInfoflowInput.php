<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstInfoflowInput extends Model
{
    use HasFactory;

    protected $table = 'mst_infoflowinput';

    protected $primaryKey = 'input_id';

    // public $incrementing = false;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'input_id',
        'objective_id',
        'from',
        'description',
        // 'skill',
        // 'objective_purpose',
    ];
}
