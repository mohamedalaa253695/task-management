<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    @if(session()->has('success'))
    <div class="bg-green-600 flex justify-center items-center  text-white px-4 py-2 rounded-md mb-4">
        {{ session('success') }}
    </div>
    @endif

    @if ($errors->any())
    <div class="bg-red-500 text-white px-4 py-2 rounded-md mb-4">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto bg-gray-800 rounded-lg shadow-md p-8">
            <h2 class="text-2xl font-semibold mb-4 text-gray-200">Tasks</h2>
            <div class="mb-4 flex justify-end">
                <a href="/tasks/create" class="bg-blue-500 text-white rounded-md px-4 py-2 hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Create New Task</a>
            </div>
            <div class="overflow-x-auto">
                <table class="table-auto w-full text-left">
                    <thead>
                        <tr class="bg-gray-700">
                            <th class="px-4 py-2 text-gray-300">Title</th>
                            <th class="px-4 py-2 text-gray-300">Description</th>
                            <th class="px-4 py-2 text-gray-300">Assigned Name</th>
                            <th class="px-4 py-2 text-gray-300">Admin Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                        <tr>
                            <td class="border px-4 py-2 text-gray-200">{{$task->title}}</td>
                            <td class="border px-4 py-2 text-gray-200">{{$task->description}}</td>
                            <td class="border px-4 py-2 text-gray-200">{{$task->user->name}}</td>
                            <td class="border px-4 py-2 text-gray-200">{{$task->admin->name}}</td>
                        </tr>
                        @endforeach
                        <!-- End of PHP loop -->
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="mt-4 flex justify-end">
                <nav class="relative z-0 inline-flex shadow-sm -space-x-px" aria-label="Pagination">
                    @if ($tasks->onFirstPage())
                    <span class="relative inline-flex items-center px-2 py-2 rounded-l-md bg-gray-700 text-sm font-medium text-gray-300">Previous</span>
                    @else
                    <a href="{{ $tasks->previousPageUrl() }}" class="relative inline-flex items-center px-2 py-2 rounded-l-md bg-gray-700 text-sm font-medium text-gray-300 hover:bg-gray-600 focus:z-10 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">Previous</a>
                    @endif

                    @foreach ($tasks->getUrlRange(1, $tasks->lastPage()) as $page => $url)
                    @if ($page == $tasks->currentPage())
                    <span aria-current="page" class="z-10 bg-blue-500 text-white px-4 py-2 text-sm font-medium">{{ $page }}</span>
                    @else
                    <a href="{{ $url }}" class="z-10 bg-gray-700 text-white hover:bg-gray-600 px-4 py-2 text-sm font-medium">{{ $page }}</a>
                    @endif
                    @endforeach

                    @if ($tasks->hasMorePages())
                    <a href="{{ $tasks->nextPageUrl() }}" class="relative inline-flex items-center px-2 py-2 rounded-r-md bg-gray-700 text-sm font-medium text-gray-300 hover:bg-gray-600 focus:z-10 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">Next</a>
                    @else
                    <span class="relative inline-flex items-center px-2 py-2 rounded-r-md bg-gray-700 text-sm font-medium text-gray-300">Next</span>
                    @endif
                </nav>
            </div>

        </div>
    </div>
</x-app-layout>