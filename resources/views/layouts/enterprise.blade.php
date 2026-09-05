<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Quản lý Doanh nghiệp' }} - ECARD NALA</title>
    @php
        $logo = \App\Models\SiteSetting::get('site_logo');
        $faviconUrl = $logo ? (\Illuminate\Support\Str::startsWith($logo, ['http://', 'https://']) ? $logo : asset($logo)) : asset('assets/images/favicon.png');
    @endphp
    <link href="{{ $faviconUrl }}" rel="icon" type="image/png" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.47.0/tabler-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --e-navy: #052542;
            --e-gold: #FFC107;
            --e-bg: #f4f7f9;
            --sidebar-bg: #052542;
            --sidebar-hover: rgba(255,255,255,.08);
            --sidebar-active: rgba(255,193,7,.15);
        }
        body { font-family: 'Be Vietnam Pro', sans-serif; background: var(--e-bg); color: #1e293b; min-height: 100vh; display: flex; }

        /* SIDEBAR */
        aside.ent-sidebar {
            width: 250px; background: var(--sidebar-bg); min-height: 100vh;
            display: flex; flex-direction: column; position: fixed; left: 0; top: 0; bottom: 0; z-index: 100;
        }
        .ent-brand { padding: 1.2rem 1.5rem; display: flex; align-items: center; gap: .7rem; text-decoration: none; border-bottom: 1px solid rgba(255,255,255,.08); }
        .ent-brand-icon { width: 36px; height: 36px; background: var(--e-gold); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: var(--e-navy); font-size: 1rem; font-weight: 900; }
        .ent-brand-text { color: white; font-weight: 800; font-size: .95rem; letter-spacing: .3px; }
        .ent-brand-sub { color: var(--e-gold); font-size: .65rem; font-weight: 600; display: block; margin-top: .1rem; letter-spacing: 1px; text-transform: uppercase; }

        .ent-nav { flex: 1; padding: 1rem 0; overflow-y: auto; }
        .ent-nav-label { color: rgba(255,255,255,.3); font-size: .7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; padding: .8rem 1.5rem .4rem; }
        .ent-nav a {
            display: flex; align-items: center; gap: .7rem; padding: .7rem 1.5rem;
            color: rgba(255,255,255,.65); text-decoration: none; font-size: .88rem; font-weight: 500;
            transition: all .15s; border-left: 3px solid transparent;
        }
        .ent-nav a:hover { background: var(--sidebar-hover); color: white; }
        .ent-nav a.active { background: var(--sidebar-active); color: var(--e-gold); border-left-color: var(--e-gold); font-weight: 700; }
        .ent-nav a i { width: 20px; text-align: center; font-size: 1rem; }
        .ent-nav-divider { height: 1px; background: rgba(255,255,255,.06); margin: .5rem 1.5rem; }

        .ent-user { padding: 1rem 1.5rem; border-top: 1px solid rgba(255,255,255,.08); display: flex; align-items: center; gap: .7rem; }
        .ent-user-avatar { width: 34px; height: 34px; border-radius: 50%; background: var(--e-gold); display: flex; align-items: center; justify-content: center; color: var(--e-navy); font-weight: 800; font-size: .8rem; }
        .ent-user-info { flex: 1; }
        .ent-user-name { color: white; font-size: .82rem; font-weight: 600; }
        .ent-user-role { color: rgba(255,255,255,.4); font-size: .7rem; }

        /* MAIN */
        main.ent-main { flex: 1; margin-left: 250px; padding: 1.5rem 2rem; min-height: 100vh; }

        /* COMMON */
        .breadcrumb { display: flex; align-items: center; gap: .5rem; font-size: .82rem; color: #64748b; margin-bottom: 1rem; }
        .breadcrumb a { color: #2563eb; text-decoration: none; }
        .breadcrumb a:hover { text-decoration: underline; }

        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 6px; font-weight: 700; border-radius: 8px; transition: .2s; text-decoration: none !important; cursor: pointer; border: none; padding: .55rem 1.1rem; font-size: .85rem; font-family: inherit; }
        .btn-primary { background: var(--e-gold) !important; color: #000 !important; }
        .btn-primary:hover { background: #e6ae00 !important; }
        .btn-gray { background: #f1f5f9 !important; color: #475569 !important; }
        .btn-gray:hover { background: #e2e8f0 !important; }
        .btn-danger { background: #fee2e2 !important; color: #ef4444 !important; }
        .btn-danger:hover { background: #fecaca !important; }

        .uk-alert { padding: .8rem 1rem; border-radius: 8px; margin-bottom: 1rem; font-size: .85rem; }
        .uk-alert-success { background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; }
        .uk-alert-danger { background: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; }

        table { width: 100%; border-collapse: collapse; }
        th { background: #f8fafc; padding: .75rem 1rem; text-align: left; font-size: .78rem; color: #64748b; font-weight: 700; text-transform: uppercase; border-bottom: 1px solid #e2e8f0; }
        td { padding: .75rem 1rem; border-bottom: 1px solid #f1f5f9; font-size: .88rem; }
        tr:hover { background: #f8faff; }

        @media(max-width: 768px) {
            aside.ent-sidebar { transform: translateX(-250px); }
            main.ent-main { margin-left: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>

<aside class="ent-sidebar">
    <a href="{{ route('enterprise.dashboard') }}" class="ent-brand">
        <div class="ent-brand-icon"><i class="ti ti-building"></i></div>
        <div>
            <span class="ent-brand-text">{{ auth()->user()->ownedCompany->name ?? 'Doanh nghiệp' }}</span>
            <span class="ent-brand-sub">Enterprise Panel</span>
        </div>
    </a>

    <nav class="ent-nav">
        <div class="ent-nav-label">Tổng quan</div>
        <a href="{{ route('enterprise.dashboard') }}" class="{{ request()->routeIs('enterprise.dashboard') ? 'active' : '' }}"><i class="ti ti-dashboard"></i> Bảng điều khiển</a>
        <a href="{{ route('enterprise.statistics') }}" class="{{ request()->routeIs('enterprise.statistics') ? 'active' : '' }}"><i class="ti ti-chart-bar"></i> Thống kê</a>

        <div class="ent-nav-divider"></div>
        <div class="ent-nav-label">Quản lý</div>
        <a href="{{ route('enterprise.departments.index') }}" class="{{ request()->routeIs('enterprise.departments.*') ? 'active' : '' }}"><i class="ti ti-sitemap"></i> Phòng ban</a>
        <a href="{{ route('enterprise.employees.index') }}" class="{{ request()->routeIs('enterprise.employees.*') ? 'active' : '' }}"><i class="ti ti-users-group"></i> Nhân viên</a>
        <a href="{{ route('enterprise.cards') }}" class="{{ request()->routeIs('enterprise.cards') ? 'active' : '' }}"><i class="ti ti-id-badge"></i> Danh thiếp</a>

        <div class="ent-nav-divider"></div>
        <div class="ent-nav-label">Cài đặt</div>
        <a href="{{ route('enterprise.settings') }}" class="{{ request()->routeIs('enterprise.settings') ? 'active' : '' }}"><i class="ti ti-settings"></i> Thông tin DN</a>

        <div class="ent-nav-divider"></div>
        <a href="{{ url('/') }}"><i class="ti ti-home"></i> Về trang chủ</a>
        <a href="{{ route('cards.index') }}"><i class="ti ti-id-badge-2"></i> Thẻ cá nhân</a>
    </nav>

    <div class="ent-user">
        <div class="ent-user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
        <div class="ent-user-info">
            <div class="ent-user-name">{{ auth()->user()->name }}</div>
            <div class="ent-user-role">Quản trị doanh nghiệp</div>
        </div>
    </div>
</aside>

<main class="ent-main">
    @if(session('success'))
    <div class="uk-alert uk-alert-success">
        <i class="ti ti-circle-check" style="margin-right: 5px;"></i> {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="uk-alert uk-alert-danger">
        <i class="ti ti-circle-x" style="margin-right: 5px;"></i> {{ session('error') }}
    </div>
    @endif

    {{ $slot }}
</main>

@stack('scripts')
</body>
</html>
