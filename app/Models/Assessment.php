<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    // Nama tabel
    protected $table = 'assessment';

    // Primary key
    protected $primaryKey = 'assessment_id';

    // Biarkan auto-increment untuk assessment_id
    public $incrementing = true;

    // Tipe key: pakai integer karena assessment_id adalah integer auto-increment
    protected $keyType = 'int'; // bila numeric manual, atau 'string' bila UUID

    // Biarkan timestamps (created_at, updated_at)
    public $timestamps = true;

    // Kolom mana saja yang boleh di‐mass‐assign
    protected $fillable = [
        'assessment_id',
        'instansi',
        'user_id',
        'kode_assessment', // Kolom baru untuk kode_assessment
    ];

    public function users()
{
    return $this->belongsToMany(User::class);
}
    // Relasi ke User
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke design factors
    public function df1()
    {
        return $this->hasMany(DesignFactor1::class, 'assessment_id', 'assessment_id');
    }

    // dst. untuk DF2–DF10…

    // Fungsi untuk mendapatkan assessment dengan kode 'guest'
    public static function getGuestAssessment()
    {
        return self::where('kode_assessment', 'guest')->first();
    }
}
