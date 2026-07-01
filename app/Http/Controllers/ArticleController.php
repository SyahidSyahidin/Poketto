<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Like;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('user')->withCount('likes')->latest()->get();
        return response()->json($articles);
    }

    public function show($id)
    {
        $article = Article::with('user')->withCount('likes')->findOrFail($id);
        return response()->json($article);
    }

    public function popular()
    {
        $popularArticles = Article::with('user')
            ->withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->get();

        return response()->json($popularArticles);
    }

    public function search(Request $request)
    {
        $keyword = $request->query('keyword');

        $articles = Article::with('user')
            ->withCount('likes')
            ->where('title', 'like', '%' . $keyword . '%')
            ->orWhere('content', 'like', '%' . $keyword . '%')
            ->latest()
            ->get();

        return response()->json($articles);
    }

    public function toggleLike($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json([
                'message' => 'Artikel tidak ditemukan'
            ], 404);
        }

        $userId = auth()->id();

        $like = Like::where('user_id', $userId)
            ->where('article_id', $id)
            ->first();

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