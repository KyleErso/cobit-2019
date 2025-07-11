<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstArea extends Model
{
    use HasFactory;
    protected $table = 'mst_area';

    protected $primaryKey = 'area';
    protected $keyType = 'string';

    public $timestamps = false;
    protected $fillable = [
        'area',
    ];
}
