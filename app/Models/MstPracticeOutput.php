<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstPracticeOutput extends Model
{
    use HasFactory;

    protected $table = 'mst_practiceoutput';

    protected $primaryKey = 'output_id';

    // public $incrementing = false;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'practiceoutput_id',
        'output_id',
        'practice_id',
        // 'description',
        // 'skill',
        // 'objective_purpose',
    ];

    public function infoflowoutput()
    {
        return $this->belongsTo(
            MstInfoflowOutput::class,
            'output_id',
            'output_id'
        );
    }
}
