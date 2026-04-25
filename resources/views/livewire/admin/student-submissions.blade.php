<div class="p-6">
    <h1 class="text-2xl font-bold mb-6 dark:text-white">Student Submissions</h1>

    <div class="overflow-x-auto rounded-lg border border-neutral-200 dark:border-neutral-700">
        <table class="w-full text-sm text-left">
            <thead class="bg-neutral-50 dark:bg-neutral-800 text-neutral-500 uppercase">
                <tr class="px-6 py-3">
                    <th>Student Name</th>
                    <th class="px-6 py-3 text-center">Progress</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>
                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700 bg-white dark:bg-neutral-900">
                    @foreach ($students as $student )
                        <tr>
                            <td class="px-6 py-4 dark:text-white font-medium">{{$student->name}}</td>
                            <td class="px-6 py-4 text-center">
                                {{-- $student->requirements_count is Laravel's
                                        withCount that automatically creates a virtual variable 
                                        called: $student->requirements_count.
                                --}}
                                <span class="px-3 py-1 rounded-full text-xs {{ $student->requirements_count === $totalRequirements ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                    {{$student->requirements_count}}
                                </span>
                                
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.verify', $student->id) }}"  class="text-blue-600 hover:underline">Review Files</a>
                            </td>
                        </tr>    
                    @endforeach
                </tbody>
        </table>
    </div>
</div>
