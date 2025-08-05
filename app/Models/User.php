<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'id', 'name', 'email', 'password', 'organisasi', 'jabatan', 'role',
    ];

    protected $hidden = [
        'password', 'remember_token','role'
    ];

    /**
     * Menggunakan boot untuk menambahkan logika sebelum menyimpan user.
     */
    protected static function booted()
    {
        static::creating(function ($user) {
            // Pastikan nomor_id dan jabatan ada
            if ($user->nomor_id && $user->jabatan) {
                // Format ID dengan format yang diinginkan: U{NomorID}{Inisial Jabatan}
                $user->id = 'U' . $user->nomor_id . strtoupper(substr($user->jabatan, 0, 1));
            }
        });
    }

    /**
     * Get the user's full name (for display purposes).
     */
    public function getFullNameAttribute()
    {
        return ucfirst($this->name);
    }
}
