<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    // Mendaftarkan kolom yang wajib diisi saat user menekan tombol like
    protected $fillable = ['user_id', 'article_id'];
}