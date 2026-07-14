<x-app-layout>
    <x-slot name="header">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h2 class="font-bold text-2xl text-slate-800 tracking-tight flex items-center">
                <svg class="w-7 h-7 mr-2.5 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"></path>
                </svg>
                {{ __('Admin Management Control Portal') }}
            </h2>
            
            <p class="text-slate-600 mt-1">
                Review, authorize, export, and record employee leave submissions.
            </p>
        </div>
        
        <a href="{{ route('leaves.pdf') }}" class="inline-flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold px-5 py-2.5 rounded-xl shadow-lg transition duration-200">
            Export PDF Report
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
                <div class="p-6 border-b border-slate-100 dark:border-slate-700/50">
                    <h3 class="text-lg font-bold text-slate-800 dark:text-white">Leave Application Database</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5 font-medium">Real-time status tracking dashboard.</p>
                </div>
                
                @if($leaves->isEmpty())
                    <div class="p-16 text-center">
                        <svg class="w-16 h-16 text-slate-300 dark:text-slate-600 mx-auto mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <p class="text-slate-500 dark:text-slate-400 text-lg font-medium">No active leave submissions recorded yet.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-100 dark:divide-slate-700/50 text-sm">
                            <thead class="bg-slate-50/70 dark:bg-slate-900/50 text-left text-xs text-slate-500 dark:text-slate-400 font-bold uppercase tracking-wider">
                                <tr>
                                    <th class="px-6 py-4">Employee</th>
                                    <th class="px-6 py-4">Leave Type</th>
                                    <th class="px-6 py-4">Requested Dates</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50 text-slate-700 dark:text-slate-300">
                                @foreach($leaves as $leave)
                                    <tr class="hover:bg-slate-50/30 dark:hover:bg-slate-700/10 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-9 h-9 rounded-xl bg-indigo-50 dark:bg-indigo-950/50 flex items-center justify-center font-black text-indigo-600 dark:text-indigo-400 shadow-sm border border-indigo-100 dark:border-indigo-900/30">
                                                    {{ strtoupper(substr($leave->user->name ?? 'U', 0, 1)) }}
                                                </div>
                                                <span class="font-bold text-slate-800 dark:text-white">{{ $leave->user->name ?? 'Unknown User' }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="font-bold text-slate-700 dark:text-slate-300">{{ $leave->leave_type }}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-xs space-y-0.5">
                                                <div class="flex items-center text-slate-700 dark:text-slate-300 font-semibold">
                                                    <span class="text-indigo-500 mr-1">Start:</span> {{ \Carbon\Carbon::parse($leave->start_date)->format('M d, Y') }}
                                                </div>
                                                <div class="flex items-center text-slate-500 dark:text-slate-400">
                                                    <span class="text-rose-400 mr-1">End:</span> {{ \Carbon\Carbon::parse($leave->end_date)->format('M d, Y') }}
                                                </div>
                                            </div>
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
                                            <div class="flex items-center justify-center space-x-2">
                                                <a href="{{ route('leaves.show', $leave->id) }}" class="bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-700 dark:text-white text-xs px-3 py-1.5 rounded-lg font-bold transition shadow-sm">
                                                    View
                                                </a>

                                                <a href="{{ route('leaves.edit', $leave->id) }}" class="bg-indigo-50 hover:bg-indigo-100 dark:bg-indigo-950/30 dark:hover:bg-indigo-950/50 text-indigo-600 dark:text-indigo-400 text-xs px-3 py-1.5 rounded-lg font-bold transition shadow-sm">
                                                    Edit
                                                </a>

                                                @if($leave->status == 'Pending')
                                                    <form action="{{ route('leaves.updateStatus', $leave->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="Approved">
                                                        <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs px-3 py-1.5 rounded-lg font-bold transition shadow-sm">
                                                            Approve
                                                        </button>
                                                    </form>

                                                    <form action="{{ route('leaves.updateStatus', $leave->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="Rejected">
                                                        <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white text-xs px-3 py-1.5 rounded-lg font-bold transition shadow-sm">
                                                            Reject
                                                        </button>
                                                    </form>
                                                @endif

                                                <form action="{{ route('leaves.destroy', $leave->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to completely delete this record?');" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-rose-50 dark:bg-rose-950/20 hover:bg-rose-100 dark:hover:bg-rose-950/40 text-rose-600 dark:text-rose-400 text-xs px-3 py-1.5 rounded-lg font-bold transition">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
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