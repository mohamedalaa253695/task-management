<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto bg-gray-800 rounded-lg shadow-md p-8">
            <h2 class="text-2xl font-semibold mb-4 text-gray-200">Statistics</h2>

            <div class="overflow-x-auto">
                <table class="table-auto w-full text-left">
                    <thead>
                        <tr class="bg-gray-700">
                            <th class="px-4 py-2 text-gray-300">User Name</th>

                            <th class="px-4 py-2 text-gray-300">Task Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($statistics as $statistic)
                        <tr>
                            <td class="border px-4 py-2 text-gray-200">{{ $users->where('id', $statistic->user_id)->first()->name }}</td>
                            <td class="border px-4 py-2 text-gray-200">{{ $statistic->task_count }}</td>

                        </tr>
                        @endforeach
                        <!-- End of PHP loop -->
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->

        </div>
    </div>
</x-app-layout>