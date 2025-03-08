<div class="py-12">
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg mt-8 border">
        <div class="mt-6">
            <h2 class="text-xl font-semibold mb-4">Recent Activities</h2>
            @if ($notifications->isEmpty())
                <h1>This is empty.</h1>
            @else
                @foreach ($notifications as $item)
                    @if ($item->type == 'report')
                        <div class="border-b py-4 flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-medium flex">
                                    <a href="#" class="text-blue-600 hover:underline">
                                        {{ $item->post->name }}
                                    </a>
                                    @if ($item->status == 'resolved')
                                        <x-mary-badge value="Resolved" class="text-black bg-green-400 mt-1 ml-2" />
                                    @elseif($item->status == 'under_review')
                                        <x-mary-badge value="Under review" class="text-black bg-orange-400 mt-1 ml-2" />
                                    @endif
                                </h3>
                                <h2 class="text-black font-semibold text-lg">{{$item->content}}
                                </h2>
                                <p class="text-gray-600 text-sm">Reported by: <a class="text-blue-400 hover:underline"
                                        href="/admin/user/{{ $item->user->username }}/view">{{ $item->user->username }}</a>
                                </p>
                                <span class="text-gray-400 text-xs">{{ $item->created_at->diffForHumans() }}</span>
                            </div>

                            @if ($item->status == 'under_review')
                                <div class="flex space-x-2">
                                    <!-- Edit Button -->
                                    <button type="button" wire:click="ResolvePost"
                                        class="hover:text-gray-400 bg-slate-100 border border-black shadow-md rounded-md p-1">
                                        Resolve
                                    </button>
                                </div>
                            @endif
                        </div>
                    @elseif ($item->type == 'approval')
                        <div class="border-b py-4 flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-medium flex">
                                    <a href="#" class="text-blue-600 hover:underline">
                                        {{ $item->post->name }}
                                    </a>
                                    @if ($item->status == 'approved')
                                        <x-mary-badge value="Approved" class="text-black bg-green-400 mt-1 ml-2" />
                                    @elseif($item->status == 'under_review')
                                        <x-mary-badge value="Waiting for approval"
                                            class="text-black bg-yellow-300 mt-1 ml-2" />
                                    @endif
                                </h3>
                                <p class="text-gray-600 text-sm">Posted by: <a class="text-blue-400 hover:underline"
                                        href="/admin/user/{{ $item->user->username }}/view">{{ $item->user->username }}</a>
                                </p>
                                <span class="text-gray-400 text-xs">{{ $item->created_at->diffForHumans() }}</span>
                            </div>

                            @if ($item->status == 'under_review')
                                <div class="flex space-x-2">
                                    <!-- Edit Button -->
                                    <button type="button" wire:click="ApprovePost"
                                        class="hover:text-gray-400 bg-slate-100 border border-black shadow-md rounded-md p-1">
                                        Approve
                                    </button>
                                </div>
                            @endif
                        </div>
                    @endif
                @endforeach

            @endif

        </div>

    </div>
</div>
