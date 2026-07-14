<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Leave Application for ') }} {{ $leave->user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('leaves.update', $leave->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="leave_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Leave Type</label>
                        <select id="leave_type" name="leave_type" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="Annual Leave" {{ $leave->leave_type == 'Annual Leave' ? 'selected' : '' }}>Annual Leave</option>
                            <option value="Sick Leave" {{ $leave->leave_type == 'Sick Leave' ? 'selected' : '' }}>Sick Leave</option>
                            <option value="Casual Leave" {{ $leave->leave_type == 'Casual Leave' ? 'selected' : '' }}>Casual Leave</option>
                        </select>
                    </div>

                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Start Date</label>
                        <input type="date" id="start_date" name="start_date" value="{{ $leave->start_date }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">End Date</label>
                        <input type="date" id="end_date" name="end_date" value="{{ $leave->end_date }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Management Status</label>
                        <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="Pending" {{ $leave->status == 'Pending' ? 'selected' : '' }}>Pending (Reset)</option>
                            <option value="Approved" {{ $leave->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                            <option value="Rejected" {{ $leave->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>

                    <div class="flex items-center space-x-3 pt-4">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md font-medium shadow transition">
                            Save Changes
                        </button>
                        <a href="{{ route('leaves.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md font-medium shadow transition">
                            Cancel
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>