<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstPractice extends Model
{
    use HasFactory;

    protected $table = 'mst_practice';

    protected $primaryKey = 'practice_id';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'practice_id',
        'objective_id',
        'practice_name',
        'practice_description',
    ];

    public function objective()
    {
        return $this->belongsTo(MstObjective::class, 'objective_id');
    }
}
