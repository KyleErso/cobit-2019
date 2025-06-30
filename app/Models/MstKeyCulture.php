<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstKeyCulture extends Model
{
    use HasFactory;

    protected $table = 'mst_keyculture';

    protected $primaryKey = 'keyculture_id';

    // public $incrementing = false;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'keyculture_id',
        'objective_id',
        'element',
        // 'objective_purpose',
    ];
}
