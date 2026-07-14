<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-black tracking-tight">
    {{ __('Leave Application Detail') }}
</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-4">
                <a href="{{ route('leaves.index') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline flex items-center">
                    &larr; Back to Management Portal
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-8">
                
                <div class="border-b border-gray-200 dark:border-gray-700 pb-4 mb-6 flex justify-between items-center">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                            {{ $leave->user->name ?? 'Unknown Employee' }}
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Email: {{ $leave->user->email ?? 'N/A' }}
                        </p>
                    </div>
                    <div>
                        <span class="px-3 py-1.5 text-xs font-bold rounded-full shadow-sm
                            {{ $leave->status == 'Pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : '' }}
                            {{ $leave->status == 'Approved' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : '' }}
                            {{ $leave->status == 'Rejected' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' : '' }}">
                            {{ $leave->status }}
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-lg">
                        <span class="block text-xs font-medium text-gray-500 uppercase tracking-wider">Leave Type</span>
                        <span class="text-lg font-semibold text-gray-800 dark:text-gray-200 mt-1 block">{{ $leave->leave_type }}</span>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-lg">
                        <span class="block text-xs font-medium text-gray-500 uppercase tracking-wider">Start Date</span>
                        <span class="text-lg font-semibold text-gray-800 dark:text-gray-200 mt-1 block">{{ $leave->start_date }}</span>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-lg">
                        <span class="block text-xs font-medium text-gray-500 uppercase tracking-wider">End Date</span>
                        <span class="text-lg font-semibold text-gray-800 dark:text-gray-200 mt-1 block">{{ $leave->end_date }}</span>
                    </div>
                </div>

                <div class="mb-8 bg-gray-50 dark:bg-gray-900 p-6 rounded-lg border-l-4 border-indigo-500">
                    <h4 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-2">Reason for Leave Request</h4>
                    <p class="text-gray-700 dark:text-gray-300 text-base leading-relaxed whitespace-pre-line">
                        {{ $leave->reason ?? 'No specific description provided by the employee.' }}
                    </p>
                </div>

                <div class="flex items-center justify-end space-x-3 border-t border-gray-200 dark:border-gray-700 pt-6">
                    <a href="{{ route('leaves.edit', $leave->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium shadow transition">
                        Edit Application
                    </a>

                    @if($leave->status == 'Pending')
                        <form action="{{ route('leaves.updateStatus', $leave->id) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="Approved">
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium shadow transition">
                                Approve
                            </button>
                        </form>

                        <form action="{{ route('leaves.updateStatus', $leave->id) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="Rejected">
                            <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-md text-sm font-medium shadow transition">
                                Reject
                            </button>
                        </form>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>