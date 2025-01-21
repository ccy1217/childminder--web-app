<?php
namespace App\Livewire;

use App\Models\Comment;
use Livewire\Component;

class CommentShow extends Component
{
    public $childminderId;
    public $comments;

    public function mount($childminderId)
    {
        // Fetch all comments related to the specific childminder profile
        $this->childminderId = $childminderId;
        $this->comments = Comment::where('childminder_id', $this->childminderId)->get();  // Get all comments for the specific childminder
    }

    public function render()
    {
        return view('livewire.comment-show');
    }
}

