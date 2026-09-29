<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>High-Risk Alerts - CareNest</title>
    
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
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 700;
            color: #0f172a;
        }

        .area-icon-dot {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        /* Severities */
        .bg-danger { background: #fee2e2; color: #ef4444; }
        .bg-warning { background: #fef3c7; color: #d97706; }
        
        .pill-danger { color: #ef4444; background: #fef2f2; border: 1px solid #fecaca; }
        .pill-warning { color: #d97706; background: #fffbeb; border: 1px solid #fde68a; }

        .condition-pill {
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 12px;
            display: inline-block;
        }

        .action-arrow-btn {
            background: transparent;
            border: none;
            color: #94a3b8;
            font-size: 14px;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .action-arrow-btn:hover {
            color: #00c853;
        }

    </style>
</head>
<body>

    <!-- Header -->
    <header class="top-header">
        <a href="{{ route('dashboard') }}" class="brand-logo">
            <i class="fa-solid fa-leaf" style="color: #00c853;"></i> CareNest
        </a>
        <a href="{{ route('dashboard') }}" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Back to Dashboard
        </a>
    </header>

    <!-- Main Content -->
    <main class="content-container">
        <h1 class="page-title">High-Risk Medical Alerts</h1>
        <p class="page-subtitle">A comprehensive list of mothers requiring immediate medical attention based on clinic tests and health history.</p>

        <div class="table-card">
            <table>
                <thead>
                    <tr>
                        <th>MOTHER'S NAME</th>
                        <th>ALERT TYPE</th>
                        <th>CONDITION / VALUE</th>
                        <th>CLINIC AREA</th>
                        <th>MIDWIFE IN-CHARGE</th>
                        <th>CONTACT NO</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($allAlerts as $alert)
                        <tr>
                            <td>
                                <div class="name-cell">
                                    <div class="area-icon-dot bg-{{ $alert->severity }}">
                                        <i class="fa-solid {{ $alert->icon }}"></i>
                                    </div>
                                    <span>{{ $alert->mother_name }}</span>
                                </div>
                            </td>
                            <td style="font-weight: 600;">{{ $alert->type }}</td>
                            <td>
                                <span class="condition-pill pill-{{ $alert->severity }}">
                                    {{ $alert->condition_text }}
                                </span>
                            </td>
                            <td>{{ $alert->area }}</td>
                            <td>{{ $alert->midwife }}</td>
                            <td>{{ $alert->contact_no }}</td>
                            <td>
                                <button class="action-arrow-btn" title="View Details">
                                    <i class="fa-solid fa-chevron-right"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; color: #94a3b8; padding: 40px;">
                                <i class="fa-solid fa-shield-heart" style="font-size: 32px; color: #e2e8f0; display: block; margin-bottom: 12px;"></i>
                                No high-risk medical alerts found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>
