<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    // Mendaftarkan kolom yang boleh diisi secara massal
    protected $fillable = ['user_id', 'title', 'content'];

    // Relasi: Artikel ini dibuat oleh satu User (Admin/Kreator)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Artikel ini bisa memiliki banyak Likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}