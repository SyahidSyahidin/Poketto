<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Like;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // Menampilkan semua tulisan di beranda
    public function index()
    {
        $articles = Article::with('user')->withCount('likes')->latest()->get();
        return response()->json($articles);
    }

    // Menampilkan detail satu tulisan saat diklik
    public function show($id)
    {
        $article = Article::with('user')->withCount('likes')->findOrFail($id);
        return response()->json($article);
    }

    // Fitur Mengurutkan Tulisan dari Like Terbanyak (Halaman Popular)
    public function popular()
    {
        $popularArticles = Article::with('user')
            ->withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->get();

        return response()->json($popularArticles);
    }

    // Fitur Toggle Like (Jika belum like -> tambah, jika sudah -> hapus)
    public function toggleLike($id)
    {
        $userId = auth()->id();
        
        $like = Like::where('user_id', $userId)->where('article_id', $id)->first();

        if ($like) {
            $like->delete();
            return response()->json(['message' => 'Like dihapus']);
        }

        Like::create([
            'user_id' => $userId,
            'article_id' => $id
        ]);

        return response()->json(['message' => 'Berhasil menyukai tulisan']);
    }
}