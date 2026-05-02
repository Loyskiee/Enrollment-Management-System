<div>
    {{-- Filter Tabs --}}
    <div class="flex gap-2 mb-4">
        <button wire:click="$set('filter', 'all')"
            class="px-4 py-1.5 text-xs font-bold rounded-lg transition
                {{ $filter === 'all' ? 'bg-neutral-800 text-white dark:bg-white dark:text-neutral-900' : 'bg-neutral-100 text-neutral-500 hover:bg-neutral-200 dark:bg-neutral-800 dark:text-neutral-400' }}">
            All
        </button>
        <button wire:click="$set('filter', 'pending')"
            class="px-4 py-1.5 text-xs font-bold rounded-lg transition
                {{ $filter === 'pending' ? 'bg-yellow-500 text-white' : 'bg-neutral-100 text-neutral-500 hover:bg-neutral-200 dark:bg-neutral-800 dark:text-neutral-400' }}">
            Pending
        </button>
        <button wire:click="$set('filter', 'approved')"
            class="px-4 py-1.5 text-xs font-bold rounded-lg transition
                {{ $filter === 'approved' ? 'bg-green-600 text-white' : 'bg-neutral-100 text-neutral-500 hover:bg-neutral-200 dark:bg-neutral-800 dark:text-neutral-400' }}">
            Approved
        </button>
        <button wire:click="$set('filter', 'rejected')"
            class="px-4 py-1.5 text-xs font-bold rounded-lg transition
                {{ $filter === 'rejected' ? 'bg-red-500 text-white' : 'bg-neutral-100 text-neutral-500 hover:bg-neutral-200 dark:bg-neutral-800 dark:text-neutral-400' }}">
            Rejected
        </button>
    </div>

    {{-- Table --}}
    <div class="overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 shadow-sm">
        <table class="w-full text-sm text-left">
            <thead class="bg-neutral-50 dark:bg-neutral-800 text-neutral-500 font-medium">
                <tr>
                    <th class="px-6 py-4">Student Name</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                @forelse($students as $student)
                    <tr wire:key="student-{{ $student->id }}" class="hover:bg-neutral-50 dark:hover:bg-neutral-800/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="font-semibold dark:text-white">{{ $student->name }}</div>
                            <div class="text-xs text-neutral-500">{{ $student->email }}</div>
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            @if($student->status !== 'approved')
                                <button wire:click="approve({{ $student->id }})" class="inline-flex items-center px-4 py-1.5 bg-green-600 hover:bg-green-700 text-white text-xs font-bold rounded-lg transition shadow-sm">
                                    Approve
                                </button>
                            @endif
                            @if($student->status !== 'rejected')
                                <button wire:click="reject({{ $student->id }})" class="inline-flex items-center px-4 py-1.5 bg-red-500 dark:bg-red-600 border border-red-600 text-white text-xs font-bold rounded-lg transition hover:bg-red-600 dark:hover:bg-red-700">
                                    Reject
                                </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-6 py-10 text-center text-neutral-500 dark:text-neutral-400 italic">
                            No students found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>