<div class="p-6">
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.submissions') }}" class="p-2 rounded-full hover:bg-neutral-100 dark:hover:bg-neutral-800">
            <svg class="w-5 h-5 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h1 class="text-2xl font-bold dark:text-white">Verifying: {{ $user->name }}</h1>
    </div>

    @if($message)
     <div x-data 
             x-on:clear-message.window="setTimeout(() => $wire.set('message', ''), 3000)"
             class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
            {{ $message }}
        </div>
    @endif

    <div class="space-y-6">
        @if ($submissions->isEmpty())
            <div class="min-h-screen flex items-center justify-center">
                <h1 class="text-red-500 text-lg font-medium text-center">
                    No Requirements Passed.
                </h1>
            </div>
        @else
        @foreach($submissions as $submission)
            <div wire:key="submission-{{ $submission->id }}"
              class="bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-700 rounded-xl overflow-hidden">
                <div class="p-4 bg-neutral-50 dark:bg-neutral-800 flex justify-between items-center">
                    <h3 class="font-semibold dark:text-white">{{ $submission->requirement->name }}</h3>
                    <span class="px-2 py-1 text-xs rounded-full 
                        {{ $submission->status === 'approved' ? 'bg-green-100 text-green-700' : '' }}
                        {{ $submission->status === 'submitted' ? 'bg-yellow-100 text-yellow-700' : '' }}
                        {{ $submission->status === 'rejected' ? 'bg-red-100 text-red-700' : '' }}
                    ">
                        {{ strtoupper($submission->status->value) }}
                    </span>
                </div>

                <div class="p-6 grid md:grid-cols-2 gap-6">
                    {{--  File input area --}}
                    <div class="bg-neutral-100 dark:bg-neutral-800 rounded-lg min-h-[300px] flex items-center justify-center p-4">
                        @php
                        /**
                         * pathinfo($path, PATH_INFO): Looks at a string and strips everything away except the dot and returns 
                         *  the file type e.g(tubol.jpg)
                         * 
                         * in_array($extension, ['jpg', 'png' ...]): in_array() searches an array for a specific value. 
                         *   ($extension, ['jpg', 'png'] ...): It asks the file extension just found is allowed
                         * 
                         * Storage:url($path): Is a filesystem method that turns an internal server path
                         *  into a public web URL (e.g https://example.com/storage/avatars/user.jpg)
                         * 
                         */
                            $extension = pathinfo($submission->file_path, PATHINFO_EXTENSION);
                        @endphp

                        @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                            <img src="{{ Storage::url($submission->file_path) }}" class="max-h-[500px] rounded shadow-lg">
                        @elseif($extension === 'pdf')
                            <iframe src="{{ Storage::url($submission->file_path) }}" class="w-full h-[500px]"></iframe>
                        @else
                            <a href="{{ Storage::url($submission->file_path) }}" target="_blank" class="text-blue-500 underline">Download Attachment</a>
                        @endif
                    </div>

                    <!-- Actions Area -->
                    <div class="flex flex-col justify-center space-y-4">
                        <p class="text-sm text-neutral-500 dark:text-neutral-400">Review the document carefully before deciding.</p>

                        {{--  Note input Area:
                            An area that an admin give feedback why did they reject a requirement --}}
                        <div>
                            <label class="block text-xs font-medium text-neutral-500 mb-1">Internal Note / Feedback (Optional)</label>
                            <textarea 
                                wire:model="notes.{{ $submission->requirement_id }}" 
                                placeholder="e.g. Image is blurry, please re-upload."
                                class="w-full text-sm rounded-lg border-neutral-200 dark:bg-neutral-800 dark:border-neutral-700 dark:text-white"
                            ></textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <button wire:click="updateStatus({{ $submission->requirement_id }}, 'approved')" 
                                class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition">
                                Approve
                            </button>
                            <button wire:click="updateStatus({{ $submission->requirement_id }}, 'rejected')" 
                                class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition">
                                Reject
                            </button>
                        </div>
                    </div>
                </div> 
            </div> 
        @endforeach
        @endif
    </div> 
</div> 