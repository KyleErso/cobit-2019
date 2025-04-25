<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignFactor3c extends Model
{
    use HasFactory;

    // Tentukan nama tabel yang digunakan oleh model ini
    protected $table = 'design_factor_3_c';

    // Tentukan kolom-kolom yang dapat diisi
    protected $fillable = [
        'id', // ID pengguna (foreign key)
        'df_id', // ID dari view atau button terkait
        'assessment_id',
        'likelihood1',
        'likelihood2',
        'likelihood3',
        'likelihood4',
        'likelihood5',
        'likelihood6',
        'likelihood7',
        'likelihood8',
        'likelihood9',
        'likelihood10',
        'likelihood11',
        'likelihood12',
        'likelihood13',
        'likelihood14',
        'likelihood15',
        'likelihood16',
        'likelihood17',
        'likelihood18',
        'likelihood19',
        'created_at',
        'updated_at',
    ];

    // Aktifkan timestamps
    public $timestamps = true;

    // Jika Anda ingin mendefinisikan relasi, Anda bisa menambahkannya di sini, misalnya:
    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'id');
    // }
}
