<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstEntergoals extends Model
{
    use HasFactory;
    protected $table = 'mst_entergoals';

    protected $primaryKey = 'entergoals_id';
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'entergoals_id',
        'description'
    ];
}
