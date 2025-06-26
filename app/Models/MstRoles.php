<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstRoles extends Model
{
    use HasFactory;

    protected $table = 'mst_roles';

    protected $primaryKey = 'role_id';

    // public $incrementing = false;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'role_id',
        'role',
        'description',
    ];
}
