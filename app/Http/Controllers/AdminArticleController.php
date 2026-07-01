<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class AdminArticleController extends Controller
{
    // Menyimpan tulisan baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $article = Article::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return response()->json(['message' => 'Karya berhasil diterbitkan!', 'data' => $article]);
    }

    // Memperbarui isi tulisan
    public function update(Request $request, $id)
    {
        $article = Article::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        
        $article->update($request->only(['title', 'content']));

        return response()->json(['message' => 'Karya berhasil diperbarui!', 'data' => $article]);
    }

    // Menghapus tulisan
    public function destroy($id)
    {
        $article = Article::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $article->delete();

        return response()->json(['message' => 'Karya berhasil dihapus!']);
    }
}