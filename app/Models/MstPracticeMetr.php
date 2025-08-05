<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstPracticeMetr extends Model
{
    use HasFactory;

    protected $table = 'mst_practicemetr';

    protected $primaryKey = 'id';

    // public $incrementing = false;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'practice_id',
        'description',
    ];
}
