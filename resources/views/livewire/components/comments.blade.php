<div class="p-4 border rounded-md flex justify-between items-start">
    <div>
        <div class="flex">
            <p class="text-sm text-gray-600 flex items-center gap-1">
                {{ $comment->user->username }} - {{ $comment->created_at->diffForHumans() }}
                
                @if ($comment->updated_at > $comment->created_at)
                    <x-mary-popover>
                        <x-slot:trigger>
                            <span class="ml-2 text-sm text-gray-500">(edited)</span>
                        </x-slot:trigger>
                        <x-slot:content>
                            edited {{ $comment->updated_at->diffForHumans() }}
                        </x-slot:content>
                    </x-mary-popover>
                @endif
            </p>
        </div>
        
        
        <p class="mt-1">{{ $comment->content }}</p>
    </div>


    <!-- Buttons (Edit & Delete) -->
    @auth
    @if (auth()->user()->id == $comment->user->id)
        <div class="flex gap-2">
            <!-- Edit Button -->
            <x-mary-button wire:click="setEditID({{ $comment->id }}, '{{ addslashes($comment->content) }}')"
                class="btn btn-primary btn-sm flex items-center gap-1" icon="o-pencil"
                @click="$wire.commentEditModal = true" />


            <!-- Delete Button -->
            <button class="btn btn-danger btn-sm flex items-center gap-1" wire:click="deleteComment({{ $comment->id }})"
                onclick="confirm('Are you sure?') || event.stopImmediatePropagation()">
                <x-mary-icon name="o-trash" />
            </button>
        </div>
    @endif
    @endauth

</div>
