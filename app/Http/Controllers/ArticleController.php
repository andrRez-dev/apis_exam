<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Author;

class ArticleController extends Controller
{
    public function __construct(){
        // $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $authors = Author::all(); 

        $query = Article::with('author');

        if ($request->has('author_filter') && $request->author_filter != '') {
            $query->where('author_id', $request->author_filter);
        }
        $sortOrder = $request->get('sort_date', 'desc'); 
    
        if (in_array($sortOrder, ['asc', 'desc'])) {
            $query->orderBy('created_at', $sortOrder);
        }
        $articles = $query->get(); 

        return view('articles', [
            'articles' => $articles,
            'authors' => $authors
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $articles = Article::all();
        $authors = Author::all();

        return view('article', [
            'articles' => $articles,
            'authors' => $authors
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'author_id' => 'required|exists:authors,id',
            'title' => 'required|alpha',
            'description' => 'required|alpha' 
        ]);

        $article=Article::create($request->all());
        $article->save();
        
        return redirect()->to('/articles');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article=Article::find($id);
        $authors = Author::all();
        return view('article', compact('article', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'author_id' => 'required|exists:authors,id',
            'title' => 'required|alpha',
            'description' => 'required|alpha' 
        ]);

        $article->update($request->all());
        $article->save();
        return redirect()->to('/articles');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::find($id);
        $article->delete();

        return redirect()->to('/articles');
    }
}
