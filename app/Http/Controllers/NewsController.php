<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::orderBy('created_at', 'desc')->get();
        return view('news.indexNews', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('news.createNews');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required',  'max:255'],
            'content' => ['required'],
            'image' => 'nullable|mimes:jpeg,png,jpg,gif',
        ]);

        $uploadedimage = $request->file('image');

        if ($uploadedimage) {
            $imagePath = $uploadedimage->store('news_images', 'public');
        } else {
            $imagePath = null; // No image provided.
        }

        $news = new News();
        $news->title = $request->input('title');
        $news->content = nl2br($request->input('content'));
        $news->image = $imagePath; 
        $news->admin_id = Auth::id();
        $news->created_at = now();
        $news->save();

        $action = "añadido";
        
        return redirect('news')->with('news', 'agregada');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        return view('news.showNews', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        return view('news.editNews', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => ['required',  'max:255'],
            'content' => ['required'],
            'image' => 'nullable|mimes:jpeg,png,jpg,gif',
        ]);

        if ($request->hasFile('image')) {
            if ($news->image) {
                Storage::delete($news->image);
            }
    
            $uploadedImage = $request->file('image');
            $imagePath = $uploadedImage->store('news_images', 'public');
    
            $news->image = $imagePath;
        }
    
        $news->title = $request->input('title');
        $news->content = $request->input('content');
        $news->save();

        $action = "editada";
        
        return redirect()->route('news.show', $news)->with('news', 'editada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        if($news->image){
            Storage::delete($news->image);
        }

        $type = 'News';
        $comments = Comment::where('commentable_type', $type)
            ->where('commentable_id', $news->id)
            ->get();
        foreach($comments as $comment){
            $comment->delete();
        };
        $news->delete();

        return redirect()->route('news.index')->with('news', 'eliminada');
    }
}
