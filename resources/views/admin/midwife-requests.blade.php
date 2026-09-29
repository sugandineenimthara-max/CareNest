@extends('layouts.auth')

@section('title', 'Pending Midwife Registrations - Admin')

@section('styles')
<style>
    .admin-container {
        padding: 40px;
        max-width: 1200px;
        margin: 0 auto;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        margin-top: 40px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #e2e8f0;
    }

    th {
        background-color: #f8fafc;
        font-weight: 700;
        color: #475569;
        font-size: 13px;
        text-transform: uppercase;
    }

    td {
        color: #334155;
        font-size: 14px;
    }

    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
        text-transform: uppercase;
    }

    .status-pending { background: #fef3c7; color: #b45309; }
    .status-approved { background: #dcfce7; color: #15803d; }
    .status-rejected { background: #fee2e2; color: #b91c1c; }

    .action-form {
        display: inline;
    }

    .btn-approve {
        background: #10b981;
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 12px;
        font-weight: bold;
    }

    .btn-reject {
        background: #ef4444;
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 12px;
        font-weight: bold;
    }

    .btn-approve:hover { background: #059669; }
    .btn-reject:hover { background: #dc2626; }

    .header-flex {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
</style>
@endsection

@section('content')
<div class="admin-container">
    <div class="header-flex">
        <h2>Midwife Registration Requests</h2>
        <a href="{{ route('admin.dashboard') }}" class="btn-pink" style="text-decoration: none; padding: 10px 20px; border-radius: 8px;">Back to Dashboard</a>
    </div>

    @if(session('success'))
        <div style="background: #dcfce7; border: 1px solid #bbf7d0; color: #166534; padding: 12px; border-radius: 12px; font-size: 13px; margin-bottom: 20px; text-align: left;">
            <i class="fa-solid fa-check-circle me-1"></i> {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Area</th>
                <th>Requested Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($requests as $request)
                <tr>
                    <td>{{ $request->name }}</td>
                    <td>{{ $request->email }}</td>
                    <td>{{ $request->midwife->area->area_name ?? 'N/A' }}</td>
                    <td>{{ $request->created_at->format('M d, Y h:i A') }}</td>
                    <td>
                        <span class="status-badge status-{{ strtolower($request->status) }}">
                            {{ $request->status }}
                        </span>
                    </td>
                    <td>
                        @if($request->status === 'pending')
                            <form action="{{ route('admin.midwife.approve', $request->id) }}" method="POST" class="action-form">
                                @csrf
                                <button type="submit" class="btn-approve">Approve</button>
                            </form>
                            <form action="{{ route('admin.midwife.reject', $request->id) }}" method="POST" class="action-form">
                                @csrf
                                <button type="submit" class="btn-reject" onclick="return confirm('Are you sure you want to reject this request?');">Reject</button>
                            </form>
                        @else
                            <span style="color: #94a3b8; font-size: 12px;">Processed</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 30px; color: #64748b;">No midwife registration requests found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
