<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstAligngoals extends Model
{
    use HasFactory;
    protected $table = 'mst_aligngoals';

    protected $primaryKey = 'aligngoals_id';
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'aligngoals_id',
        'description'
    ];

    public function aligngoalsmetr()
    {
        return $this->hasMany(MstAligngoalsmetr::class, 'aligngoals_id', 'aligngoals_id');
    }
}
