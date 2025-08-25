<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstInfoflowOutput extends Model
{
    use HasFactory;

    protected $table = 'mst_infoflowoutput';

    protected $primaryKey = 'output_id';

    // public $incrementing = false;

    protected $keyType = 'int';
    // protected $keyType = 'unsignedBigInteger';

    public $timestamps = false;

    protected $fillable = [
        'output_id',
        'practice_id',
        // 'to',
        'description',
        // 'skill',
        // 'objective_purpose',
    ];

    public function practiceoutputs()
    {
        return $this->hasMany(
            MstPracticeOutput::class, // related model
            'output_id',              // foreign key on mst_practiceoutput
            'output_id'               // local key on mst_infoflowoutput
        );
    }
}
