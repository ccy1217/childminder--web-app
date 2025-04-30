<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Message;
use App\Models\User;

class MessageBoard extends Component
{
    public $sender_id, $receiver_id;
    public $sender_user_type, $receiver_user_type;
    public $client_id, $client_first_name, $client_last_name;
    public $childminder_id, $childminder_user_id, $childminder_first_name, $childminder_last_name;
    public $message;
    public $messages = []; 
    public $sender_name, $receiver_name;

    public function markMessagesAsRead()
    {
        Message::where('sender_id', $this->receiver_id) 
            ->where('receiver_id', $this->sender_id)   
            ->where('is_read', false)
            ->update(['is_read' => true]);
    }


    public function mount(
        $sender_id, $client_id, $client_first_name, $client_last_name, 
        $childminder_id, $childminder_user_id, $childminder_first_name, $childminder_last_name, 
        $receiver_id, $sender_user_type, $receiver_user_type) {
        $this->sender_id = $sender_id;
        $this->receiver_id = $receiver_id;
        $this->client_id = $client_id;
        $this->client_first_name = $client_first_name;
        $this->client_last_name = $client_last_name;
        $this->childminder_id = $childminder_id;
        $this->childminder_user_id = $childminder_user_id;
        $this->childminder_first_name = $childminder_first_name;
        $this->childminder_last_name = $childminder_last_name;
        $this->sender_user_type = $sender_user_type;
        $this->receiver_user_type = $receiver_user_type;

        $this->loadMessages();
        $this->markMessagesAsRead();  //mark them read when board is opened
        $this->loadSenderReceiverNames();
    }

    public function loadMessages()
    {
        $this->messages = Message::where(function ($query) {
            $query->where('sender_id', $this->sender_id)
                  ->where('receiver_id', $this->receiver_id);
        })
        ->orWhere(function ($query) {
            $query->where('sender_id', $this->receiver_id)
                  ->where('receiver_id', $this->sender_id);
        })
        ->orderBy('created_at', 'asc')
        ->get();
    }

    public function loadSenderReceiverNames()
    {
        $sender = User::find($this->sender_id);
        $receiver = User::find($this->receiver_id);

        $this->sender_name = $sender ? "{$sender->first_name} {$sender->last_name}" : "Unknown Sender";
        $this->receiver_name = $receiver ? "{$receiver->first_name} {$receiver->last_name}" : "Unknown Receiver";
    }

    public function sendMessage()
    {
        if (empty(trim($this->message))) {
            session()->flash('error', 'Message cannot be empty.');
            return;
        }

        Message::create([
            'sender_id' => $this->sender_id,
            'receiver_id' => $this->receiver_id,
            'sender_user_type' => $this->sender_user_type,
            'receiver_user_type' => $this->receiver_user_type,
            'message' => $this->message,
            'is_read' => false,
        ]);

        session()->flash('success', 'Message sent successfully!');
        $this->message = '';
        $this->loadMessages();
    }

    public function render()
    {
        return view('livewire.message-board')->layout('layouts.app');
    }
}
