<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Comment;
use App\Models\Booking;
use App\Models\ClientProfile;
use Illuminate\Support\Facades\Auth;

class CommentShow extends Component
{
    use WithPagination;

    public $childminderId;
    public $commentText;
    public $rating;
    public $canComment = false;
    protected $paginationTheme = 'tailwind';

    public $currentProfile; // Add this property to store the current profile

    public function mount($childminderId)
    {
        $this->childminderId = $childminderId;
        $this->checkClientPermission();
        $this->currentProfile = ClientProfile::where('user_id', Auth::id())->first(); // Get current profile
    }

    private function checkClientPermission()
    {
        if (!Auth::check()) {
            $this->canComment = false;
            return;
        }

        $client = ClientProfile::where('user_id', Auth::id())->first();

        if ($client) {
            $hasConfirmedBooking = Booking::where('client_id', $client->id)
                ->where('childminder_id', $this->childminderId)
                ->where('status', 'confirmed') // Only confirmed bookings
                ->exists();

            $this->canComment = $hasConfirmedBooking;
        }
    }

    public function submitComment()
    {
        if (!$this->canComment) {
            session()->flash('error', 'You can only comment if your booking is confirmed.');
            return;
        }

        $this->validate([
            'commentText' => 'required|string|min:3',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        $client = ClientProfile::where('user_id', Auth::id())->first();

        Comment::create([
            'childminder_id' => $this->childminderId,
            'client_id' => $client->id,
            'comment' => $this->commentText,
            'rating' => $this->rating,
        ]);

        session()->flash('success', 'Comment added successfully.');
        $this->reset(['commentText', 'rating']);
    }

    public function render()
    {
        $comments = Comment::where('childminder_id', $this->childminderId)
            ->with('clientProfile') // Eager load client profile for images
            ->latest()
            ->paginate(5);

        return view('livewire.comment-show', [
            'comments' => $comments,
            'canComment' => $this->canComment,
            'currentProfile' => $this->currentProfile // Pass the current profile to the view
        ]);
    }
}
