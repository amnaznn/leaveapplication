<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-black tracking-tight">
    {{ __('New Leave Application') }}
</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('leaves.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="leave_type" :value="__('Leave Type')" />
                        <select id="leave_type" name="leave_type" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                            <option value="Annual Leave">Annual Leave</option>
                            <option value="Medical Leave">Medical Leave</option>
                            <option value="Emergency Leave">Emergency Leave</option>
                        </select>
                        <x-input-error :messages="$errors->get('leave_type')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="start_date" :value="__('Start Date')" />
                            <x-text-input id="start_date" class="block mt-1 w-full" type="date" name="start_date" required />
                            <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="end_date" :value="__('End Date')" />
                            <x-text-input id="end_date" class="block mt-1 w-full" type="date" name="end_date" required />
                            <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="reason" :value="__('Reason for Leave')" />
                        <textarea id="reason" name="reason" rows="4" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required></textarea>
                        <x-input-error :messages="$errors->get('reason')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ms-4">
                            {{ __('Submit Application') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>