<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // ← WAJIB TAMBAHKAN INI agar role bisa disimpan ke database
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    // Relasi ke artikel yang dibuat (Jika dia admin/kreator)
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    // Relasi Many-to-Many ke Artikel yang disukai
    public function likedArticles()
    {
        return $this->belongsToMany(Article::class, 'likes');
    }
}