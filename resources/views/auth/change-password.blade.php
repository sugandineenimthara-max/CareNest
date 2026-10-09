<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Change Password - CareNest</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        :root {
            --font-main: 'Plus Jakarta Sans', sans-serif;
            --font-heading: 'Outfit', sans-serif;
            --primary-emerald: #00c853;
            --primary-dark: #1b4d3e;
            --accent-green: #e8f5e9;
            --bg-light: #f8fafc;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --sidebar-width: 260px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: var(--font-main);
            background: #f1f5f9;
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
        }

        /* Sidebar Styling */
        .sidebar {
            width: var(--sidebar-width);
            background: #ffffff;
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            z-index: 100;
        }

        .sidebar-brand {
            padding: 24px 28px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-family: var(--font-heading);
            font-size: 22px;
            font-weight: 800;
            color: var(--primary-dark);
            border-bottom: 1px solid var(--border-color);
        }

        .brand-icon {
            width: 38px;
            height: 38px;
            background: #e8f5e9;
            color: var(--primary-emerald);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .nav-list {
            list-style: none;
            padding: 20px 16px;
            display: flex;
            flex-direction: column;
            gap: 6px;
            flex-grow: 1;
            overflow-y: auto;
        }

        .nav-item a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 12px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.2s;
        }

        .nav-item a:hover {
            background: #f8fafc;
            color: var(--text-dark);
        }

        .nav-item.active a {
            background: #e8f5e9;
            color: var(--primary-emerald);
            font-weight: 700;
        }

        .nav-item a i {
            font-size: 16px;
            width: 20px;
            text-align: center;
        }

        /* Main Wrapper */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background: #f8fafc;
        }

        /* Top Header */
        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 48px;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.6);
            position: sticky;
            top: 0;
            z-index: 90;
            min-height: 76px;
            box-sizing: border-box;
        }

        .header-left {
            font-family: var(--font-heading);
            font-size: 22px;
            font-weight: 800;
            color: var(--primary-dark);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .back-link {
            width: 36px;
            height: 36px;
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 14px;
            transition: all 0.2s;
        }

        .back-link:hover {
            background: #e8f5e9;
            color: var(--primary-emerald);
            border-color: #bbf7d0;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-left: auto;
        }

        /* Content Container */
        .content-container {
            padding: 40px 48px;
            max-width: 900px;
            width: 100%;
            margin: 0 auto;
        }

        /* Card Container */
        .password-card {
            background: #ffffff;
            border-radius: 24px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.05);
            padding: 40px;
        }

        .card-header-box {
            display: flex;
            align-items: flex-start;
            gap: 18px;
            margin-bottom: 32px;
            padding-bottom: 24px;
            border-bottom: 1px solid #f1f5f9;
        }

        .shield-icon {
            width: 52px;
            height: 52px;
            background: #e8f5e9;
            color: var(--primary-emerald);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        .card-header-box h1 {
            font-family: var(--font-heading);
            font-size: 24px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 6px;
        }

        .card-header-box p {
            font-size: 14px;
            color: #64748b;
            line-height: 1.5;
        }

        /* Alerts */
        .alert-box {
            padding: 16px 20px;
            border-radius: 14px;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 24px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            line-height: 1.5;
        }

        .alert-success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
        }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        .alert-info {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            color: #1e40af;
        }

        /* Step Section */
        .step-block {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            padding: 24px;
            margin-bottom: 24px;
            transition: all 0.3s ease;
        }

        .step-block.unlocked {
            border-color: #bbf7d0;
            background: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 200, 83, 0.04);
        }

        .step-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
        }

        .step-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 6px 12px;
            border-radius: 9999px;
            background: #e2e8f0;
            color: #475569;
        }

        .step-badge.verified {
            background: #dcfce7;
            color: #15803d;
        }

        .step-title {
            font-size: 16px;
            font-weight: 700;
            color: #1e293b;
        }

        /* Form Controls */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #475569;
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-field {
            width: 100%;
            height: 48px;
            background: #ffffff;
            border: 1.5px solid #cbd5e1;
            border-radius: 12px;
            padding: 0 46px 0 16px;
            font-family: var(--font-main);
            font-size: 14px;
            font-weight: 500;
            color: #0f172a;
            transition: all 0.2s;
        }

        .input-field:focus {
            outline: none;
            border-color: var(--primary-emerald);
            box-shadow: 0 0 0 4px rgba(0, 200, 83, 0.12);
        }

        .btn-toggle-eye {
            position: absolute;
            right: 14px;
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            font-size: 15px;
            padding: 4px;
            transition: color 0.15s;
        }

        .btn-toggle-eye:hover {
            color: #334155;
        }

        /* Action Buttons */
        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: var(--primary-emerald);
            color: #ffffff;
            border: none;
            border-radius: 12px;
            padding: 13px 28px;
            font-family: var(--font-main);
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 4px 14px rgba(0, 200, 83, 0.25);
        }

        .btn-primary:hover {
            background: #00b34a;
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(0, 200, 83, 0.35);
        }

        .btn-verify {
            background: #1b4d3e;
            box-shadow: 0 4px 14px rgba(27, 77, 62, 0.2);
        }

        .btn-verify:hover {
            background: #163e32;
        }

        /* Forgot password helper box */
        .forgot-helper-box {
            margin-top: 16px;
            padding: 14px 18px;
            background: #f8fafc;
            border: 1px dashed #cbd5e1;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .forgot-helper-text {
            font-size: 13px;
            color: #64748b;
        }

        .btn-forgot-auth {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #ffffff;
            border: 1px solid #cbd5e1;
            padding: 8px 16px;
            border-radius: 10px;
            color: #0f172a;
            text-decoration: none;
            font-size: 12.5px;
            font-weight: 700;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .btn-forgot-auth:hover {
            border-color: #00c853;
            color: #00c853;
            background: #f0fdf4;
        }

        .pw-hint {
            font-size: 12px;
            color: #64748b;
            margin-top: 6px;
        }

        .step-locked-overlay {
            opacity: 0.5;
            pointer-events: none;
            filter: grayscale(0.5);
            transition: all 0.3s;
        }
    </style>
</head>
<body>

    <!-- Sidebar Navigation -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon">
                <i class="fa-solid fa-heart-pulse"></i>
            </div>
            <span>CareNest</span>
        </div>

        <ul class="nav-list">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa-solid fa-chart-pie"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            @if(in_array($role, ['provider', 'admin']))
            <li class="nav-item">
                <a href="{{ route('admin.midwife-requests') }}">
                    <i class="fa-solid fa-user-clock"></i>
                    <span>Midwife Requests</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.midwives.index') }}">
                    <i class="fa-solid fa-user-nurse"></i>
                    <span>Manage Midwives</span>
                </a>
            </li>
            @endif

            <li class="nav-item">
                <a href="{{ route('admin.mothers.index') }}">
                    <i class="fa-solid fa-person-breastfeeding"></i>
                    <span>Mothers Registry</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.children.index') }}">
                    <i class="fa-solid fa-baby"></i>
                    <span>Children Registry</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.immunizations.index') }}">
                    <i class="fa-solid fa-syringe"></i>
                    <span>Immunizations</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.alerts.index') }}">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <span>High-Risk Alerts</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.triposha.index') }}">
                    <i class="fa-solid fa-box-open"></i>
                    <span>Thriposha Book</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.attendances.index') }}">
                    <i class="fa-solid fa-calendar-check"></i>
                    <span>Clinic Attendances</span>
                </a>
            </li>

            <li class="nav-item active" style="margin-top: 16px;">
                <a href="{{ route('password.change') }}">
                    <i class="fa-solid fa-key"></i>
                    <span>Change Password</span>
                </a>
            </li>
        </ul>
    </aside>

    <!-- Main Content Area -->
    <div class="main-wrapper">
        <!-- Top Navigation Header -->
        <header class="top-header">
            <div class="header-left">
                <a href="{{ route('admin.dashboard') }}" class="back-link" title="Back to Dashboard">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <span>Security &amp; Password</span>
            </div>

            <!-- Standardized Right Profile Badge with Dropdown -->
            <div class="header-right">
                @include('partials.top-header-user')
            </div>
        </header>

        <!-- Main Content -->
        <main class="content-container">
            <div class="password-card">
                <div class="card-header-box">
                    <div class="shield-icon">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <div>
                        <h1>Change Account Password</h1>
                        <p>Protect your account by setting a strong password. You can enter your current password to proceed, or authenticate your identity via Forgot Password if needed.</p>
                    </div>
                </div>

                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="alert-box alert-success">
                        <i class="fa-solid fa-circle-check" style="font-size: 18px; margin-top: 1px;"></i>
                        <div>
                            <strong>Success!</strong> {{ session('success') }}
                        </div>
                    </div>
                @endif

                @if(session('status'))
                    <div class="alert-box alert-info">
                        <i class="fa-solid fa-circle-info" style="font-size: 18px; margin-top: 1px;"></i>
                        <div>
                            {{ session('status') }}
                        </div>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert-box alert-error">
                        <i class="fa-solid fa-circle-exclamation" style="font-size: 18px; margin-top: 1px;"></i>
                        <div>
                            <strong>Please fix the errors below:</strong>
                            <ul style="margin: 4px 0 0 16px;">
                                @foreach($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <!-- If Identity Authenticated via Forgot Password -->
                @if($identityVerified)
                    <div class="alert-box alert-success" style="background: #f0fdf4; border-color: #86efac;">
                        <i class="fa-solid fa-user-check" style="font-size: 20px; color: #16a34a; margin-top: 2px;"></i>
                        <div>
                            <strong style="color: #15803d; font-size: 15px;">Identity Authenticated Successfully!</strong>
                            <p style="color: #166534; font-size: 13px; margin-top: 2px;">You have verified your identity via the Forgot Password feature. You do not need your current password; enter and confirm your new password below.</p>
                        </div>
                    </div>
                @endif

                <form action="{{ route('password.update_auth') }}" method="POST" id="changePasswordForm">
                    @csrf

                    <!-- STEP 1: Current Password Access -->
                    @if(!$identityVerified)
                    <div class="step-block" id="step1Block">
                        <div class="step-header">
                            <div>
                                <span class="step-badge" id="step1Badge">Step 1</span>
                                <span class="step-title" style="margin-left: 10px;">Verify Current Password</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="current_password">CURRENT PASSWORD</label>
                            <div class="input-wrapper">
                                <input type="password" 
                                       name="current_password" 
                                       id="current_password" 
                                       class="input-field" 
                                       placeholder="Enter your current password" 
                                       autocomplete="current-password">
                                <button type="button" class="btn-toggle-eye" onclick="togglePasswordVisibility('current_password', this)">
                                    <i class="fa-regular fa-eye"></i>
                                </button>
                            </div>
                            <div id="currentPasswordError" style="color: #ef4444; font-size: 13px; font-weight: 600; margin-top: 6px; display: none;"></div>
                        </div>

                        <div style="display: flex; align-items: center; gap: 14px; margin-top: 14px;">
                            <button type="button" class="btn-primary btn-verify" id="btnVerifyCurrent" onclick="verifyCurrentPasswordAjax()">
                                <i class="fa-solid fa-lock-open"></i>
                                <span>Verify &amp; Continue</span>
                            </button>
                        </div>

                        <!-- Forgot Password Option if user cannot remember current password -->
                        <div class="forgot-helper-box">
                            <div class="forgot-helper-text">
                                <i class="fa-solid fa-circle-question" style="color: #64748b; margin-right: 4px;"></i>
                                Failed to remember your current password? Authenticate your identity using Forgot Password.
                            </div>
                            <a href="{{ route('password.request') }}?from=change-password" class="btn-forgot-auth">
                                <i class="fa-solid fa-fingerprint" style="color: #00c853;"></i>
                                <span>Forgot Password</span>
                            </a>
                        </div>
                    </div>
                    @endif

                    <!-- STEP 2: New Password & Confirmation -->
                    <div class="step-block {{ $identityVerified ? 'unlocked' : 'step-locked-overlay' }}" id="step2Block">
                        <div class="step-header">
                            <div>
                                <span class="step-badge {{ $identityVerified ? 'verified' : '' }}" id="step2Badge">
                                    {{ $identityVerified ? 'Ready' : 'Step 2' }}
                                </span>
                                <span class="step-title" style="margin-left: 10px;">Set New Password</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="new_password">NEW PASSWORD</label>
                            <div class="input-wrapper">
                                <input type="password" 
                                       name="password" 
                                       id="new_password" 
                                       class="input-field" 
                                       placeholder="Enter at least 6 characters" 
                                       {{ $identityVerified ? 'required' : 'disabled' }}
                                       autocomplete="new-password">
                                <button type="button" class="btn-toggle-eye" onclick="togglePasswordVisibility('new_password', this)">
                                    <i class="fa-regular fa-eye"></i>
                                </button>
                            </div>
                            <div class="pw-hint">Must be at least 6 characters.</div>
                        </div>

                        <div class="form-group" style="margin-bottom: 28px;">
                            <label class="form-label" for="password_confirmation">CONFIRM NEW PASSWORD</label>
                            <div class="input-wrapper">
                                <input type="password" 
                                       name="password_confirmation" 
                                       id="password_confirmation" 
                                       class="input-field" 
                                       placeholder="Re-enter your new password" 
                                       {{ $identityVerified ? 'required' : 'disabled' }}
                                       autocomplete="new-password"
                                       oninput="checkPasswordMatch()">
                                <button type="button" class="btn-toggle-eye" onclick="togglePasswordVisibility('password_confirmation', this)">
                                    <i class="fa-regular fa-eye"></i>
                                </button>
                            </div>
                            <div id="matchMessage" style="font-size: 13px; font-weight: 600; margin-top: 6px; display: none;"></div>
                        </div>

                        <button type="submit" class="btn-primary" id="btnSubmitPassword" {{ $identityVerified ? '' : 'disabled' }}>
                            <i class="fa-solid fa-check"></i>
                            <span>Update Password</span>
                        </button>
                    </div>

                </form>
            </div>
        </main>
    </div>

    <script>
        function togglePasswordVisibility(fieldId, btn) {
            const input = document.getElementById(fieldId);
            const icon = btn.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        function checkPasswordMatch() {
            const newPw = document.getElementById('new_password').value;
            const confirmPw = document.getElementById('password_confirmation').value;
            const matchMsg = document.getElementById('matchMessage');

            if (!confirmPw) {
                matchMsg.style.display = 'none';
                return;
            }

            matchMsg.style.display = 'block';
            if (newPw === confirmPw) {
                matchMsg.style.color = '#16a34a';
                matchMsg.innerHTML = '<i class="fa-solid fa-circle-check"></i> Passwords match.';
            } else {
                matchMsg.style.color = '#dc2626';
                matchMsg.innerHTML = '<i class="fa-solid fa-circle-xmark"></i> Passwords do not match.';
            }
        }

        function unlockStep2() {
            const step1Block = document.getElementById('step1Block');
            const step2Block = document.getElementById('step2Block');
            const step1Badge = document.getElementById('step1Badge');
            const step2Badge = document.getElementById('step2Badge');
            const newPw = document.getElementById('new_password');
            const confirmPw = document.getElementById('password_confirmation');
            const btnSubmit = document.getElementById('btnSubmitPassword');

            if (step1Badge) {
                step1Badge.classList.add('verified');
                step1Badge.innerHTML = '<i class="fa-solid fa-check"></i> Verified';
            }

            if (step2Block) {
                step2Block.classList.remove('step-locked-overlay');
                step2Block.classList.add('unlocked');
            }

            if (step2Badge) {
                step2Badge.classList.add('verified');
            }

            if (newPw) newPw.disabled = false;
            if (confirmPw) confirmPw.disabled = false;
            if (btnSubmit) btnSubmit.disabled = false;

            if (newPw) newPw.focus();
        }

        async function verifyCurrentPasswordAjax() {
            const currentPwInput = document.getElementById('current_password');
            const currentPwVal = currentPwInput.value.trim();
            const errDiv = document.getElementById('currentPasswordError');
            const btnVerify = document.getElementById('btnVerifyCurrent');

            if (!currentPwVal) {
                errDiv.style.display = 'block';
                errDiv.innerText = 'Please enter your current password.';
                currentPwInput.focus();
                return;
            }

            btnVerify.disabled = true;
            btnVerify.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Verifying...';
            errDiv.style.display = 'none';

            try {
                const response = await fetch("{{ route('password.verify_current') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ current_password: currentPwVal })
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    btnVerify.style.background = '#15803d';
                    btnVerify.innerHTML = '<i class="fa-solid fa-circle-check"></i> Verified!';
                    unlockStep2();
                } else {
                    errDiv.style.display = 'block';
                    errDiv.innerHTML = (data.message || 'Incorrect current password.') + ' <br><a href="{{ route("password.request") }}?from=change-password" style="color: #00c853; text-decoration: underline; font-weight: 700;">Click here to authenticate using Forgot Password</a>';
                    btnVerify.disabled = false;
                    btnVerify.innerHTML = '<i class="fa-solid fa-lock-open"></i> Verify &amp; Continue';
                }
            } catch (err) {
                errDiv.style.display = 'block';
                errDiv.innerText = 'Connection error. Please try again.';
                btnVerify.disabled = false;
                btnVerify.innerHTML = '<i class="fa-solid fa-lock-open"></i> Verify &amp; Continue';
            }
        }
    </script>
</body>
</html>
