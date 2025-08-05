<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstActivities extends Model
{
    use HasFactory;

    protected $table = 'mst_activities';

    protected $primaryKey = 'activity_id';

    // public $incrementing = false;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'activity_id',
        'practice_id',
        'description',
        // 'objective_purpose',
    ];

    public function practices()
    {
        return $this->belongsTo(MstPractice::class, 'practice_id');
    }
}
