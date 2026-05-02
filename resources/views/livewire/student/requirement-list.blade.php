<div class="space-y-6">
        @if(Auth::user()->isEnrolled())
        <div class="p-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl flex justify-between items-center">
            <div>
                <h3 class="font-semibold text-green-700 dark:text-green-400">You are officially enrolled!</h3>
                <p class="text-sm text-green-600 dark:text-green-500">You may now download your Certificate of Enrollment.</p>
            </div>
            <a href="{{ route('student.coe.download') }}" 
            class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm rounded-lg transition">
                Download COE
            </a>
        </div>
    @endif
 <div class="flex justify-between items-center">
        <h2 class="text-xl font-bold dark:text-white">Enrollment Requirements</h2>
        @if (session()->has('message'))
            <span class="text-sm text-green-500 font-medium animate-bounce">{{ session('message') }}</span>
        @endif
    </div>

    <div class="grid gap-4">
        @foreach($requirements as $requirement)
            @php
                $status = $studentSubmissions[$requirement->id] ?? 'incomplete';
                // Find the submission to check for admin comments
                $sub = Auth::user()->requirements->where('id', $requirement->id)->first();
            @endphp

            <div wire:key="row-{{ $requirement->id }}" 
                class="p-5 rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 flex flex-col md:flex-row md:items-center justify-between gap-4 transition-all hover:shadow-md">
                
                {{-- Left: Info & Status --}}
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-1">
                        <h3 class="font-bold dark:text-white">{{ $requirement->name }}</h3>
                        
                        {{-- Status Badges --}}
                        @if($status === 'approved')
                            <span class="px-2 py-0.5 text-[10px] rounded-full bg-green-100 text-green-700">Approved</span> 
                        @elseif($status === 'submitted')
                        <span class="px-2 py-0.5 text-[10px] rounded-full bg-green-100 text-green-700">Subbmitted</span>
                        @elseif($status === 'approved')
                            <span class="px-2 py-0.5 text-[10px] rounded-full bg-green-100 text-green-700">Complete</span>
                        @elseif($status === 'rejected')
                            <span class="px-2 py-0.5 text-[10px] rounded-full bg-red-100 text-red-700">Rejected</span>
                        @else
                            <span class="px-2 py-0.5 text-[10px] rounded-full bg-neutral-100 text-neutral-500">Incomplete</span>
                        @endif
                    </div>
                    <p class="text-sm text-neutral-500 dark:text-neutral-400">{{ $requirement->description }}</p>

                    {{-- Admin Feedback (If Rejected) --}}
                    @if($status === 'rejected' && $sub && $sub->pivot->admin_comment)
                        <div class="mt-2 p-2 bg-red-50 dark:bg-red-900/20 rounded border-l-4 border-red-500">
                            <p class="text-xs text-red-600 dark:text-red-400 font-medium italic">
                                Note: {{ $sub->pivot->admin_comment }}
                            </p>
                        </div>
                    @endif
                </div>

                {{-- Right: Input Area --}}
                <div class="flex items-center gap-4">
                    @if($status !== 'approved')
                        <div class="flex flex-col items-end">
                            <input type="file" 
                                id="file-{{ $requirement->id }}"
                                wire:model="files.{{ $requirement->id }}" 
                                class="text-xs text-neutral-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer"
                            >
                            @error('files.' . $requirement->id) 
                                <span class="text-[10px] text-red-500 mt-1">{{ $message }}</span> 
                            @enderror
                        </div>
                    @else
                        <div class="flex items-center text-green-600 text-sm font-bold">
                            <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path></svg>
                            Verified
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

 
    <div class="mt-10 flex flex-col items-end gap-3 p-6 bg-neutral-50 dark:bg-neutral-900 rounded-2xl border border-neutral-200 dark:border-neutral-700">
        <div class="text-right">
            <h4 class="font-bold dark:text-white">Ready to submit?</h4>
            <p class="text-xs text-neutral-500">Clicking below will upload all chosen files to the registrar.</p>
        </div>
        
        <button wire:click="uploadRequirements" 
                wire:loading.attr="disabled"
                class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-500/20 transition-all active:scale-95 disabled:opacity-50">
            <span wire:loading.remove wire:target="uploadRequirements">Submit</span>
            <span wire:loading wire:target="uploadRequirements" class="flex items-center">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                Processing Uploads...
            </span>
        </button>
    </div>
</div>
