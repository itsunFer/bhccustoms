<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\News;
use App\Models\Comment;
use Auth;

class CommentSection extends Component
{
    public $postType; 
    public $postId; 
    public $content;
    public $editedComments = [];
    public $editingCommentId = null;

    protected $listeners = ['commentAdded' => '$refresh', 'commentDeleted' => 'deleteComment'];

    public function mount($postType, $postId)
    {
        $this->postType = $postType;
        $this->postId = $postId;
    }

    public function render()
    {

        $comments = Comment::where('commentable_type', $this->postType)
            ->where('commentable_id', $this->postId)
            ->get();

        return view('livewire.comment-section', ['comments' => $comments]);

    }

    public function submitComment()
    {
        $this->validate([
            'content' => 'required|max:2000',
        ]);

        $comment = Comment::create([
            'commentable_type' => $this->postType,
            'commentable_id' => $this->postId,
            'comment_text' => $this->content,
            'user_id' => Auth::id(),
        ]);

        $this->content = '';
        $this->emit('commentAdded', $comment->id);
    }
    
    public function editComment($commentId)
    {
        $this->editingCommentId = $commentId;
        $this->editedComments[$commentId] = Comment::find($commentId)->comment_text;
    }

    public function updateComment($commentId)
    {
        $this->validate([
            "editedComments.$commentId" => 'required',
        ]);
    
        $comment = Comment::find($commentId);
        $comment->comment_text = $this->editedComments[$commentId];
        $comment->save();
    
        $this->editingCommentId = null;
    }

    public function deleteComment($commentId)
    {
        $comment = Comment::find($commentId);

        if ($comment) {
            $comment->delete();
            $this->emit('commentDeleted', $commentId);
        }
    }
}
