<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto bg-gray-800 rounded-lg shadow-md p-8">
            <h2 class="text-2xl font-semibold mb-4 text-gray-200">Create Task</h2>
            @if(session()->has('success'))
            <div class="bg-green-500 text-white px-4 py-2 rounded-md mb-4">
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
            <form action="/tasks" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="adminName" class="block text-gray-300 mb-1">Admin Name</label>
                    <select id="admin_id" name="admin_id" class="w-full text-gray-300 bg-gray-700 border border-gray-600 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @foreach ($admins as $admin)
                        <option class="text-gray-300" value="{{$admin->id}}">{{$admin->name}}</option>

                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="title" class="block text-gray-300 mb-1">Title</label>
                    <input type="text" id="title" name="title" class="w-full text-gray-300 bg-gray-700 border border-gray-600 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Enter title">
                </div>
                <div class="mb-4">
                    <label for="dscription" class="block text-gray-300 mb-1">Description</label>
                    <textarea id="description" name="description" class="w-full text-gray-300  bg-gray-700 border border-gray-600 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" rows="4" placeholder="Enter description"></textarea>
                </div>
                <div class="mb-4">
                    <label for="assignedUser" class="block text-gray-300 mb-1">Assigned User</label>
                    <select id="assignedUser" name="user_id" class="w-full text-gray-300  bg-gray-700 border border-gray-600 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @foreach ($users as $user)
                        <option class="text-gray-300 " value="{{$user->id}}">{{$user->name}}</option>

                        @endforeach
                    </select>
                </div>

                <div class="flex justify-between py-5">
                    <button type="submit" class="w-1/5 bg-blue-500 text-white rounded-md px-4 py-2 hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Create Task</button>
                    <a href="/tasks" class="w-1/5 flex justify-center bg-red-500 align-text-center text-white rounded-md px-4 py-2 ml-2 hover:bg-gray-600 focus:outline-none focus:bg-gray-600">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>