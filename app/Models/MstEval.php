<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstEval extends Model
{
    use HasFactory;

    protected $table = 'mst_eval';
    protected $primaryKey = 'eval_id';
    
    protected $fillable = [
        'user_id'
    ];

    /**
     * Get the user that owns the evaluation
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get all activity evaluations for this evaluation
     */
    public function activityEvaluations()
    {
        return $this->hasMany(TrsActivityeval::class, 'eval_id', 'eval_id');
    }

    /**
     * Scope for filtering by user
     */
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
