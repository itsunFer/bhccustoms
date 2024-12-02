<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\Tag;
use App\Models\Comment;
use Illuminate\Http\Request;
use Auth;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $forum = Forum::orderBy('created_at', 'desc')->get();
        return view('forums.indexForum', compact('forum'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all();
        return view('forums.createForum', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:255'],
            'content' => ['required'],
        ]);

        $forum = new Forum();
        $forum->title = $request->input('title');
        $forum->content = nl2br($request->input('content'));
        $forum->user_id = Auth::id();
        $forum->created_at = now();
        $forum->save();

        $selectedTags = $request->input('selectedTags', []);
        $forum->tags()->sync($selectedTags);

        // Create and attach new tags
        $newTags = $request->input('newTags');
        if (!empty($newTags)) {
            $newTagNames = explode(',', $newTags);
            foreach ($newTagNames as $tagName) {
                $tag = Tag::firstOrNew(['tag_name' => trim($tagName)]);
                $tag->save();
                $selectedTags[] = $tag->id;
            }
            $forum->tags()->sync($selectedTags);
        }

        return redirect('forum')->with('forum', 'agregado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Forum $forum)
    {
        return view('forums.showForum', compact('forum'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Forum $forum)
    {
        $tags = Tag::all();
        $selectedTags = $forum->tags->pluck('id')->toArray();
        return view('forums.editForum', compact('forum', 'tags', 'selectedTags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Forum $forum)
    {
        $request->validate([
            'title' => ['required',  'max:255'],
            'content' => ['required'],
        ]);

    
        $forum->title = $request->input('title');
        $forum->content = $request->input('content');
        $forum->tags()->sync($request->input('selectedTags', []));
        $forum->save();
        
        
        return redirect()->route('forum.show', $forum)->with('forum', 'editado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Forum $forum)
    {
        $type = 'Forum';
        $comments = Comment::where('commentable_type', $type)
            ->where('commentable_id', $forum->id)
            ->get();
        foreach($comments as $comment){
            $comment->delete();
        };
        $forum->delete();

        return redirect()->route('forum.index')->with('forum', 'eliminado');
    }
}
