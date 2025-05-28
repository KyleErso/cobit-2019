<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstAligngoalsmetr extends Model
{
    use HasFactory;
    protected $table = 'mst_aligngoalsmetr';

    protected $primaryKey = 'aligngoalsmetr_id';
    protected $keyType = 'int';

    protected $fillable = [
        'aligngoalsmetr_id',
        'aligngoals_id',
        'description'
    ];

    public function aligngoals()
    {
        return $this->belongsTo(MstAligngoals::class, 'aligngoals_id');
    }
}
