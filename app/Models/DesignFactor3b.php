<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignFactor3b extends Model
{
    use HasFactory;

    // Tentukan nama tabel yang digunakan oleh model ini
    protected $table = 'design_factor_3_b';

    // Tentukan kolom-kolom yang dapat diisi
    protected $fillable = [
        'id', // ID pengguna (foreign key)
        'df_id', // ID dari view atau button terkait
        'assessment_id',
        'impact1',
        'impact2',
        'impact3',
        'impact4',
        'impact5',
        'impact6',
        'impact7',
        'impact8',
        'impact9',
        'impact10',
        'impact11',
        'impact12',
        'impact13',
        'impact14',
        'impact15',
        'impact16',
        'impact17',
        'impact18',
        'impact19',
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
