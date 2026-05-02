<x-layouts::app>
    <div class="p-6 lg:p-8 flex flex-col gap-8">
    

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="p-5 bg-white dark:bg-neutral-800 rounded-xl border border-neutral-200 dark:border-neutral-700 shadow-sm">
                <p class="text-sm font-medium text-neutral-500">Pending Students</p>
                <h3 class="text-2xl font-bold mt-1 text-red-600 dark:text-red-400">{{ $pendingStudents}}</h3>
            </div>

            {{-- Total of Enrolled Students --}}
            <div class="p-5 bg-white dark:bg-neutral-800 rounded-xl border border-neutral-200 dark:border-neutral-700 shadow-sm">
                <p class="text-sm font-medium text-neutral-500">Students Enrolled</p>
                <h3 class="text-2xl font-bold mt-1 dark:text-white">{{ $totalEnrolled }}</h3>
            </div>

            {{-- Total pending requirements that needs to be verified --}}
             <div class="p-5 bg-white dark:bg-neutral-800 rounded-xl border border-neutral-200 dark:border-neutral-700 shadow-sm">
                <a class="text-sm font-medium text-neutral-500" href="{{ route('admin.submissions') }}">Requirements to Verify</a>
                <h3 class="text-2xl font-bold mt-1 text-yellow-600 dark:text-yellow-400">{{$pendingRequirements }}</h3>
            </div>
        </div>

        <div class="bg-white dark:bg-neutral-800 rounded-xl border border-neutral-200 dark:border-neutral-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-neutral-50 dark:bg-neutral-900/50 text-neutral-500">
                        <tr>
                            <th class="px-6 py-3 font-medium">Name</th>
                            <th class="px-6 py-3 font-medium text-right">Date Enrolled</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-100 dark:divide-neutral-700">
                        @foreach($recentEnrollments as $enrollment)
                            <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-700/30 transition-colors">
                                <td class="px-6 py-4 font-medium dark:text-neutral-200">{{ $enrollment->user->name }}</td>
                                <td class="px-6 py-4 text-right text-neutral-500">{{ $enrollment->created_at->format('F d, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts::app>