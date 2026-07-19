<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 dark:text-white tracking-tight flex items-center">
    <span class="mr-3 text-3xl">👋</span>
    <span class="text-gray-900 ">Welcome Back,</span> 
    
    <span class="ml-2 text-indigo-600 dark:text-indigo-400 font-extrabold">{{ auth()->user()->name }}</span>
</h2>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Submit new leave requests or track the status of pending applications.</p>
            </div>

            <a href="{{ route('leaves.create') }}" class="inline-flex items-center justify-center bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white text-sm font-bold px-6 py-3 rounded-xl shadow-lg shadow-indigo-600/10 hover:shadow-indigo-600/20 transition-all duration-150 transform hover:-translate-y-0.5">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                </svg>
                Request Leave Absence
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50 dark:bg-slate-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            @if(session('success'))
                <div class="p-4 bg-emerald-50 dark:bg-emerald-950/20 border-l-4 border-emerald-500 text-emerald-800 dark:text-emerald-300 rounded-xl shadow-md flex items-center transition-all">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-semibold">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-xl sm:rounded-2xl border border-slate-100 dark:border-slate-700/50">
                <div class="p-6 border-b border-slate-100 dark:border-slate-700/50 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-slate-800 dark:text-white">Leave Application History</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Summary of your personal requested absences.</p>
                    </div>
                </div>

                @if($leaves->isEmpty())
                    <div class="p-16 text-center">
                        <div class="w-16 h-16 bg-slate-100 dark:bg-slate-700/50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"></path>
                            </svg>
                        </div>
                        <p class="text-slate-500 dark:text-slate-400 text-lg font-medium">You haven't submitted any leave requests yet.</p>
                        <a href="{{ route('leaves.create') }}" class="mt-4 inline-flex items-center text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:underline">
                            Request your first leave absence &rarr;
                        </a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-100 dark:divide-slate-700/50 text-sm">
                            <thead class="bg-slate-50/70 dark:bg-slate-900/50 text-left text-xs text-slate-500 dark:text-slate-400 font-bold uppercase tracking-wider">
                                <tr>
                                    <th class="px-6 py-4">Leave Type</th>
                                    <th class="px-6 py-4">Start Date</th>
                                    <th class="px-6 py-4">End Date</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50 text-slate-700 dark:text-slate-300">
                                @foreach($leaves as $leave)
                                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/20 transition-colors">
                                        <td class="px-6 py-4">
                                            <span class="font-bold text-slate-800 dark:text-white">{{ $leave->leave_type }}</span>
                                        </td>
                                        <td class="px-6 py-4 font-medium text-slate-600 dark:text-slate-400">
                                            {{ \Carbon\Carbon::parse($leave->start_date)->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 font-medium text-slate-600 dark:text-slate-400">
                                            {{ \Carbon\Carbon::parse($leave->end_date)->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1.5 text-xs font-bold rounded-full shadow-sm inline-flex items-center
                                                {{ $leave->status == 'Pending' ? 'bg-amber-50 text-amber-700 border border-amber-200 dark:bg-amber-950/20 dark:text-amber-300 dark:border-amber-900/50' : '' }}
                                                {{ $leave->status == 'Approved' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200 dark:bg-emerald-950/20 dark:text-emerald-300 dark:border-emerald-900/50' : '' }}
                                                {{ $leave->status == 'Rejected' ? 'bg-rose-50 text-rose-700 border border-rose-200 dark:bg-rose-950/20 dark:text-rose-300 dark:border-rose-900/50' : '' }}">
                                                <span class="w-1.5 h-1.5 rounded-full mr-1.5
                                                    {{ $leave->status == 'Pending' ? 'bg-amber-500' : '' }}
                                                    {{ $leave->status == 'Approved' ? 'bg-emerald-500' : '' }}
                                                    {{ $leave->status == 'Rejected' ? 'bg-rose-500' : '' }}"></span>
                                                {{ $leave->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            @if($leave->status == 'Pending')
                                                <form action="{{ route('leaves.destroy', $leave->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this application?');" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-rose-50 dark:bg-rose-950/30 text-rose-600 dark:text-rose-400 hover:bg-rose-100 dark:hover:bg-rose-950/50 text-xs px-4 py-2 rounded-lg font-bold transition">
                                                        Cancel Request
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-xs text-slate-400 dark:text-slate-500 italic">Locked</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>