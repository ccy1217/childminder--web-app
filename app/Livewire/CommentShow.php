<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Comment;
use App\Models\ChildminderProfile;

class CommentShow extends Component
{
    use WithPagination;

    public $childminderId;
    protected $paginationTheme = 'tailwind';

    public function mount($childminderId)
    {
        $this->childminderId = $childminderId;
    }

    public function render()
    {
        $comments = Comment::where('childminder_id', $this->childminderId)
            ->latest()
            ->paginate(5);

        return view('livewire.comment-show', [
            'comments' => $comments
        ]);
    }
}
