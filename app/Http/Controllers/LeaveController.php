<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf; // 🌟 Required for PDF generation

class LeaveController extends Controller
{
    /**
     * Display a listing of all leave applications (Admin Only).
     */
    public function index()
    {
        $leaves = Leave::with('user')->latest()->get();
        return view('leaves.index', compact('leaves'));
    }

    /**
     * Show the form for creating a new leave application (Employee).
     */
    public function create()
    {
        return view('leaves.create');
    }

    /**
     * Store a newly created leave application in the database (Employee).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'leave_type' => 'required|string|max:255',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string|max:1000',
        ]);

        // Create the leave record tied to the logged-in employee
        Auth::user()->leaves()->create($validated);

        return redirect()->route('dashboard')->with('success', 'Leave application submitted successfully!');
    }

    /**
     * Display the full details of a specific leave application (Admin).
     */
    public function show(Leave $leave)
    {
        $leave->load('user');
        return view('leaves.show', compact('leave'));
    }

    /**
     * Show the form for editing an employee's leave application (Admin).
     */
    public function edit(Leave $leave)
    {
        return view('leaves.edit', compact('leave'));
    }

    /**
     * Update the employee's leave application details (Admin).
     */
    public function update(Request $request, Leave $leave)
    {
        $validated = $request->validate([
            'leave_type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:Pending,Approved,Rejected',
        ]);

        $leave->update($validated);

        return redirect()->route('leaves.index')->with('success', 'Leave application updated successfully!');
    }

    /**
     * Update only the status of the leave application (Admin Quick Actions).
     */
    public function updateStatus(Request $request, Leave $leave)
    {
        $validated = $request->validate([
            'status' => 'required|in:Approved,Rejected,Pending',
        ]);

        $leave->update([
            'status' => $validated['status']
        ]);

        return redirect()->route('leaves.index')->with('success', 'Application status updated successfully!');
    }

    /**
     * Remove the specified leave application from storage (Admin & Employee).
     */
    public function destroy(Leave $leave)
    {
        $leave->delete();

        // Redirect back depending on who deleted it
        if (Auth::user()->isAdmin()) {
            return redirect()->route('leaves.index')->with('success', 'Leave application deleted successfully!');
        }

        return redirect()->route('dashboard')->with('success', 'Leave application canceled successfully!');
    }

    /**
     * Export all leave applications into a clean printable PDF format (Admin).
     */
    public function downloadPDF()
    {
        $leaves = Leave::with('user')->latest()->get();

        $pdf = Pdf::loadView('leaves.pdf', compact('leaves'));

        return $pdf->download('Employee-Leave-Report-' . now()->format('Y-m-d') . '.pdf');
    }
}