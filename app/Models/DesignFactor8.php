<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignFactor8 extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'design_factor_8';  // Pastikan nama tabel sesuai dengan database

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'id',          // ID record
        'df_id',       // ID terkait Design Factor
        'assessment_id', // ID assessment
        'input1df8',   // Input field 1 untuk Design Factor 8
        'input2df8',   // Input field 2 untuk Design Factor 8
        'input3df8',   // Input field 3 untuk Design Factor 8
        'created_at',  // Timestamp created_at
        'updated_at',  // Timestamp updated_at
    ];

    // Aktifkan timestamps (created_at dan updated_at)
    public $timestamps = true;
}