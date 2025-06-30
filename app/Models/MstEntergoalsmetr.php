<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstEntergoalsmetr extends Model
{
    use HasFactory;
    protected $table = 'mst_entergoalsmetr';

    protected $primaryKey = 'entergoalsmetr_id';
    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'entergoalsmetr_id',
        'entergoals_id',
        'description'
    ];

    public function entergoals()
    {
        return $this->belongsTo(MstEntergoals::class, 'entergoals_id');
    }
}
