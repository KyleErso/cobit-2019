<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrsPracticeGuidance extends Model
{
    use HasFactory;

    public $incrementing = false;

    public $timestamps = false;

    protected $table = 'trs_practiceguidance';

    protected $primaryKey = ['practice_id', 'guidance_id'];

    // protected $keyType = 'string';

    protected $casts = [
        'practice_id' => 'string',
        'guidance_id' => 'integer',
    ];

    protected $fillable = [
        'practice_id',
        'guidance_id',
    ];


    public function practice()
    {
        return $this->belongsTo(MstPractice::class, 'practice_id');
    }

    public function guidance()
    {
        return $this->belongsTo(MstGuidance::class, 'guidance_id');
    }
}
