<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Message Board') }}
        </h2>
    </x-slot>

<div class="p-4">
    <h2 class="font-semibold text-2xl mb-4">Send Messages:</h2>

    <!-- Send a message section -->
    <div class="mt-6">
        <!-- Message input -->
        <textarea wire:model="message" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Type your message..."></textarea>

        <!-- Send button -->
        <div class="flex justify-end mt-2">
            <button wire:click="sendMessage" class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                📩 Send
            </button>
        </div>
    </div>

    <!-- Display all messages -->
    <div class="space-y-4 mt-4"> <!-- Added mt-4 for margin-top -->
        @foreach ($messages->reverse() as $message)  <!-- Reversed order of messages -->
            <div class="border p-4 rounded-lg bg-gray-50 {{ $message->is_read ? 'bg-gray-100' : 'bg-blue-50' }}">
                <!-- Message Sender Label (Childminder or Client) -->
                <p class="font-medium {{ $message->sender_id == $sender_id ? 'text-blue-500' : 'text-red-500' }}">
                <p class="font-medium {{ $message->sender_id == $sender_id ? 'text-blue-500' : 'text-red-500' }}">
                    @if ($message->sender && $message->sender->user_type === 'client')
                        Client: {{ $client_first_name }} {{ $client_last_name }} (ID: {{ $client_id }})
                    @else
                        Childminder: {{ $childminder_first_name }} {{ $childminder_last_name }} (ID: {{ $childminder_id }})
                    @endif



                </p>
                <!-- Message Content -->
                <p class="mt-2 text-gray-800">{{ $message->message }}</p>
                <!-- Message Timestamp -->
                <small class="text-gray-500 mt-2 block">{{ \Carbon\Carbon::parse($message->created_at)->diffForHumans() }}</small>
            </div>
        @endforeach
    </div>
</div>
