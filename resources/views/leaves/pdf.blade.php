<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Employee Leave Applications Report</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; margin: 0; padding: 0; }
        .header { text-align: center; margin-bottom: 30px; border-b: 2px solid #333; padding-bottom: 10px; }
        .header h1 { margin: 0; font-size: 22px; color: #1e293b; }
        .header p { margin: 5px 0 0 0; color: #64748b; font-size: 13px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th { bg-color: #f1f5f9; background-color: #f1f5f9; border: 1px solid #cbd5e1; padding: 10px; text-align: left; font-weight: bold; }
        td { border: 1px solid #e2e8f0; padding: 10px; }
        tr:nth-child(even) { background-color: #f8fafc; }
        .status { font-weight: bold; text-transform: uppercase; font-size: 11px; }
        .status-pending { color: #b45309; }
        .status-approved { color: #15803d; }
        .status-rejected { color: #b91c1c; }
        .footer { text-align: right; margin-top: 50px; font-size: 10px; color: #94a3b8; }
    </style>
</head>
<body>

    <div class="header">
        <h1>Employee Leave Applications Report</h1>
        <p>Generated on: {{ now()->format('F d, Y h:i A') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Employee Name</th>
                <th>Leave Type</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($leaves as $leave)
                <tr>
                    <td style="font-weight: 600;">{{ $leave->user->name ?? 'Unknown' }}</td>
                    <td>{{ $leave->leave_type }}</td>
                    <td>{{ $leave->start_date }}</td>
                    <td>{{ $leave->end_date }}</td>
                    <td>
                        <span class="status 
                            {{ $leave->status == 'Pending' ? 'status-pending' : '' }}
                            {{ $leave->status == 'Approved' ? 'status-approved' : '' }}
                            {{ $leave->status == 'Rejected' ? 'status-rejected' : '' }}">
                            {{ $leave->status }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        System Administrator - Internal Leave Management Document
    </div>

</body>
</html>