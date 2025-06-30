<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstInfoflowOutput extends Model
{
    use HasFactory;

    protected $table = 'mst_infoflowoutput';

    protected $primaryKey = 'output_id';

    // public $incrementing = false;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'output_id',
        'objective_id',
        'to',
        'description',
        // 'skill',
        // 'objective_purpose',
    ];
}
