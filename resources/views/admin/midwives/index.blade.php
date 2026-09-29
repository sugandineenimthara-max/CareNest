<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Midwives - CareNest</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --font-main: 'Plus Jakarta Sans', sans-serif;
            --font-heading: 'Outfit', sans-serif;
            --bg-gradient: linear-gradient(135deg, #eef2ff 0%, #f0fdf4 50%, #f0f9ff 100%);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: var(--font-main);
            background: var(--bg-gradient);
            background-attachment: fixed;
            color: #1e293b;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Top Header */
        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 48px;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            position: sticky;
            top: 0;
            z-index: 90;
        }

        .brand-logo {
            font-family: var(--font-heading);
            font-size: 24px;
            font-weight: 800;
            color: #1b4d3e;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-back {
            background: #f1f5f9;
            color: #475569;
            padding: 10px 20px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .btn-back:hover {
            background: #e2e8f0;
            color: #1e293b;
        }

        /* Content Container */
        .content-container {
            padding: 40px 48px;
            max-width: 1400px;
            width: 100%;
            margin: 0 auto;
            flex: 1;
        }

        .page-title {
            font-family: var(--font-heading);
            font-size: 32px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .page-subtitle {
            font-size: 14px;
            color: #64748b;
            margin-bottom: 30px;
        }

        .alert-success {
            background: #dcfce7;
            border: 1px solid #bbf7d0;
            color: #166534;
            padding: 16px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Table Card */
        .table-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 30px;
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.04);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #64748b;
            text-align: left;
            padding: 16px;
            border-bottom: 2px solid #f1f5f9;
        }

        td {
            padding: 20px 16px;
            font-size: 14px;
            color: #334155;
            border-bottom: 1px solid #f8fafc;
            vertical-align: middle;
        }

        .name-cell {
            font-weight: 700;
            color: #0f172a;
        }

        .action-form {
            display: inline-block;
            margin-right: 8px;
        }

        .btn-action {
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
        }

        .btn-edit {
            background: #e0f2fe;
            color: #0284c7;
            border: 1px solid #bae6fd;
        }
        .btn-edit:hover { background: #bae6fd; }

        .btn-delete {
            background: #fff1f2;
            color: #e11d48;
            border: 1px solid #fecdd3;
        }
        .btn-delete:hover { background: #ffe4e6; }

    </style>
</head>
<body>

    <!-- Header -->
    <header class="top-header">
        <a href="{{ route('admin.dashboard') }}" class="brand-logo">
            <i class="fa-solid fa-leaf" style="color: #00c853;"></i> CareNest
        </a>
        <a href="{{ route('admin.dashboard') }}" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Back to Dashboard
        </a>
    </header>

    <!-- Main Content -->
    <main class="content-container">
        <h1 class="page-title">Manage Midwives</h1>
        <p class="page-subtitle">View, edit, and remove approved midwives from the system.</p>

        @if(session('success'))
            <div class="alert-success">
                <i class="fa-solid fa-circle-check"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="table-card">
            <table>
                <thead>
                    <tr>
                        <th>Midwife Name</th>
                        <th>Email Address</th>
                        <th>Assigned Area</th>
                        <th>Approved On</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($midwives as $midwifeUser)
                        <tr>
                            <td class="name-cell">{{ $midwifeUser->name }}</td>
                            <td>{{ $midwifeUser->email }}</td>
                            <td>
                                <i class="fa-solid fa-location-dot" style="color: #00c853; margin-right: 6px;"></i>
                                {{ $midwifeUser->midwife->area->area_name ?? 'N/A' }}
                            </td>
                            <td>{{ $midwifeUser->updated_at->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('admin.midwives.edit', $midwifeUser->id) }}" class="btn-action btn-edit">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                                
                                <form action="{{ route('admin.midwives.destroy', $midwifeUser->id) }}" method="POST" class="action-form" onsubmit="return confirm('Are you sure you want to delete this midwife?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 40px; color: #64748b;">
                                <i class="fa-solid fa-user-nurse" style="font-size: 32px; color: #cbd5e1; margin-bottom: 12px; display: block;"></i>
                                No approved midwives found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>
