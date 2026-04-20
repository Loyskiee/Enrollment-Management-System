<div class="space-y-4">
    <h2 class="text-lg font-semibold dark:text-white">Your Requirements</h2>
    
    <div class="grid gap-4">
        @foreach($requirements as $requirement)
            @php
                /**
                * Get the specific status for a requirement.
                * Default value of requirement is missing
                */
                $status = $studentSubmissions[$requirement->id] ?? 'missing';
            @endphp

            <div class="p-4 rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 flex justify-between items-center">
                <div>
                    <h3 class="font-medium dark:text-white">
                        {{ $requirement->name }}
                        @if (!$requirement->is_required)
                            <span class="text-xs font-normal text-neutral-400 font-italic">(If applicable)</span>  
                        @endif
                    </h3>
                    <p class="text-sm text-neutral-500 dark:text-neutral-400">{{ $requirement->description }}</p>
                </div>
                
                <div class="flex items-center gap-4">
                    {{-- Dynamically change the status based on the submission --}}
                    @if($status === 'submitted')
                        <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400">
                            Submitted
                        </span>
                    @elseif($status === 'approved')
                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">
                            Complete
                        </span>
                    @elseif($status === 'rejected')
                        <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400">
                            Rejected
                        </span>
                    @else
                        <span class="px-2 py-1 text-xs rounded-full bg-neutral-100 text-neutral-600 dark:bg-neutral-700 dark:text-neutral-400">
                            Missing
                        </span>
                    @endif

                    <input type="file" wire:model="file" class="text-sm cursor-pointer">

                    <div wire:loading wire:target="file" class="text-xs text-blue-500">
                        Uploading
                    </div>

                    <button wire:click="uploadRequirements({{ $requirement->id }})">
                        Upload
                    </button>    
                    @error("file" )
                    <span class="text-red-500 text-xs block">
                        {{ $message }} </span>
                @enderror
                </div>
            </div>
        @endforeach
    </div>
</div>
