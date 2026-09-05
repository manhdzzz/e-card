<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'ECARD NALA') }}</title>
    @php
        $logo = \App\Models\SiteSetting::get('site_logo');
        $faviconUrl = $logo ? (\Illuminate\Support\Str::startsWith($logo, ['http://', 'https://']) ? $logo : asset($logo)) : asset('assets/images/favicon.png');
    @endphp
    <link href="{{ $faviconUrl }}" rel="icon" type="image/png" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.5/css/uikit.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.47.0/tabler-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="{{ asset('css/bootstrap-ecard.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/ecard-original.css') }}" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --e-navy: #052542;
            --e-gold: #FFC107;
            --e-bg: #f4f7f9;
        }
        body {
            font-family: 'Be Vietnam Pro', sans-serif;
            background: var(--e-navy);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        /* MAIN CONTENT */
        main.guest-main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 1rem;
            position: relative;
        }
        /* Decorative background */
        main.guest-main::before {
            content: '';
            position: absolute;
            top: -150px; right: -150px;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(255,193,7,0.08) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }
        main.guest-main::after {
            content: '';
            position: absolute;
            bottom: -100px; left: -100px;
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(255,255,255,0.03) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }
        /* FORM STYLES */
        .form-group { margin-bottom: 1.1rem; }
        .form-label { display: block; font-size: .85rem; font-weight: 600; color: #1e293b; margin-bottom: .4rem; }
        .input-wrap { position: relative; }
        .input-wrap i.fi { position: absolute; left: 13px; top: 50%; transform: translateY(-50%); color: #64748b; font-size: .9rem; }
        .form-control {
            width: 100%;
            padding: .7rem 1rem .7rem 2.6rem;
            border: 1.5px solid #e2e8f0;
            border-radius: 8px;
            font-size: .9rem;
            font-family: inherit;
            color: #1e293b;
            background: white;
            transition: border-color .2s, box-shadow .2s;
            outline: none;
        }
        .form-control:focus { border-color: var(--e-gold); box-shadow: 0 0 0 3px rgba(255,193,7,.12); }
        .form-control.no-icon { padding-left: 1rem; }
        .guest-btn-primary {
            width: 100%;
            padding: .8rem;
            background: var(--e-gold);
            color: #000;
            border: none;
            border-radius: 8px;
            font-size: .95rem;
            font-weight: 700;
            cursor: pointer;
            transition: background .2s, transform .1s;
            font-family: inherit;
        }
        .guest-btn-primary:hover { background: #e6ae00; }
        .guest-btn-primary:active { transform: scale(.99); }
        .toggle-pw {
            position: absolute; right: 13px; top: 50%; transform: translateY(-50%);
            background: none; border: none; cursor: pointer; color: #64748b;
            font-size: .85rem; z-index: 2;
        }
        .toggle-pw:hover { color: var(--e-navy); }
        .error-msg { color: #ef4444; font-size: .78rem; margin-top: .25rem; }
        .alert { padding: .75rem 1rem; border-radius: 8px; margin-bottom: 1rem; font-size: .85rem; }
        .alert-danger { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }
        .alert-success { background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; }
    </style>
    @stack('styles')
</head>
<body>

@include('partials.header')

<main class="guest-main">
    {{ $slot }}
</main>

@include('partials.homepage.footer')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.5/js/uikit.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.5/js/components/sticky.min.js"></script>
@stack('scripts')
</body>
</html>
