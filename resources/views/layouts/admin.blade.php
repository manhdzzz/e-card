<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Quản trị' }} - Danh Thiếp Điện Tử</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --primary: #001529;
            --primary-dark: #000d1a;
            --primary-light: #f0f4ff;
            --navy: #001529;
            --gold: #FFC107;
            --sidebar-bg: #001529;
            --sidebar-hover: rgba(255,255,255,.08);
            --sidebar-active: rgba(255,193,7,.2);
            --text: #1e293b;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --bg: #f4f7f9;
            --white: #ffffff;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
        }
        body {
            font-family: 'Be Vietnam Pro', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            margin: 0;
        }
        /* SIDEBAR */
        aside.sidebar {
            width: 240px;
            background: var(--sidebar-bg);
            min-height: 100vh;
            display: flex; flex-direction: column;
            position: fixed; left: 0; top: 0; bottom: 0;
            z-index: 100;
            transition: transform .3s ease;
        }
        body.sidebar-collapsed aside.sidebar { transform: translateX(-240px); }
        .sidebar-brand {
            padding: 1.2rem 1.3rem;
            border-bottom: 1px solid rgba(255,255,255,.1);
        }
        .sidebar-brand a {
            display: flex; align-items: center; gap: .6rem;
            text-decoration: none; color: white;
            font-weight: 800; font-size: .92rem;
        }
        .sidebar-brand-icon {
            width: 34px; height: 34px;
            background: var(--gold); border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            color: #000; font-size: .9rem; flex-shrink: 0;
        }
        .sidebar-subtitle { color: rgba(255,255,255,.5); font-size: .72rem; font-weight: 400; display: block; margin-top: .1rem; }
        .sidebar-nav { flex: 1; padding: 1rem 0; }
        .sidebar-nav ul { list-style: none; }
        .sidebar-nav li { margin: .1rem .7rem; }
        .sidebar-nav a {
            display: flex; align-items: center; gap: .75rem;
            padding: .7rem .9rem; border-radius: 9px;
            text-decoration: none; color: rgba(255,255,255,.75);
            font-size: .88rem; font-weight: 500;
            transition: background .15s, color .15s;
        }
        .sidebar-nav a i { width: 18px; text-align: center; font-size: .9rem; }
        .sidebar-nav a:hover { background: var(--sidebar-hover); color: white; }
        .sidebar-nav a.active { background: var(--sidebar-active); color: var(--gold); border-left: 3px solid var(--gold); }
        .sidebar-user {
            padding: 1rem 1.2rem;
            border-top: 1px solid rgba(255,255,255,.1);
            display: flex; align-items: center; gap: .75rem;
        }
        .sidebar-avatar {
            width: 38px; height: 38px; border-radius: 50%;
            background: var(--primary); display: flex; align-items: center; justify-content: center;
            color: white; font-weight: 700; font-size: .9rem; flex-shrink: 0; overflow: hidden;
        }
        .sidebar-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .sidebar-user-info .name { color: white; font-size: .85rem; font-weight: 600; }
        .sidebar-user-info .role { color: rgba(255,255,255,.5); font-size: .75rem; }
        .sidebar-user-arrow { margin-left: auto; color: rgba(255,255,255,.4); font-size: .75rem; cursor: pointer; }
        /* MAIN */
        .admin-main {
            margin-left: 240px;
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            transition: margin-left .3s ease;
            width: auto;
        }
        body.sidebar-collapsed .admin-main { margin-left: 0; }
        /* TOP BAR */
        .admin-topbar {
            background: white;
            border-bottom: 1px solid var(--border);
            height: 60px;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 1.8rem;
            position: sticky; top: 0; z-index: 50;
            box-shadow: 0 1px 3px rgba(0,0,0,.05);
        }
        .topbar-left { display: flex; align-items: center; gap: 1rem; }
        .hamburger { background: none; border: none; cursor: pointer; color: var(--text-muted); font-size: 1.1rem; }
        .topbar-right { display: flex; align-items: center; gap: .8rem; }
        .topbar-bell {
            width: 36px; height: 36px;
            background: var(--primary-light); border: none; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: var(--primary); font-size: .85rem; cursor: pointer; position: relative;
        }
        .topbar-bell .badge {
            position: absolute; top: 2px; right: 2px;
            width: 8px; height: 8px; background: #ef4444; border-radius: 50%;
        }
        .topbar-user {
            display: flex; align-items: center; gap: .6rem;
            cursor: pointer;
        }
        .topbar-avatar {
            width: 36px; height: 36px; border-radius: 50%;
            background: var(--navy); display: flex; align-items: center; justify-content: center;
            color: white; font-weight: 700; font-size: .85rem; overflow: hidden;
        }
        .topbar-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .topbar-user-info .name { font-size: .85rem; font-weight: 600; color: var(--text); }
        .topbar-user-info .role { font-size: .72rem; color: var(--text-muted); }
        /* CONTENT */
        .admin-content { flex: 1; padding: 1.8rem; }
        .breadcrumb { display: flex; align-items: center; gap: .4rem; font-size: .78rem; color: var(--text-muted); margin-bottom: .5rem; }
        .breadcrumb a { color: var(--text-muted); text-decoration: none; }
        .breadcrumb a:hover { color: var(--primary); }
        /* ALERTS */
        .alert { padding: .75rem 1rem; border-radius: 8px; margin-bottom: 1rem; font-size: .85rem; display: flex; align-items: center; gap: .6rem; }
        .alert-success { background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; }
        .alert-danger { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }
        .alert .close-btn { margin-left: auto; background: none; border: none; cursor: pointer; color: inherit; opacity: .7; }
        /* CARDS */
        .card { background: white; border-radius: 12px; border: 1px solid var(--border); }
        /* BUTTONS */
        .btn { display: inline-flex; align-items: center; gap: .45rem; padding: .55rem 1.1rem; border-radius: 8px; font-size: .85rem; font-weight: 600; cursor: pointer; border: none; font-family: inherit; text-decoration: none; transition: all .2s; }
        .btn-primary { background: var(--navy); color: white; }
        .btn-primary:hover { background: var(--primary-dark); }
        .btn-outline { background: white; color: var(--primary); border: 1.5px solid var(--primary); }
        .btn-outline:hover { background: var(--primary-light); }
        .btn-gray { background: #f1f5f9; color: var(--text); border: 1.5px solid var(--border); }
        .btn-gray:hover { background: #e2e8f0; }
        .btn-danger { background: var(--danger); color: white; }
        .btn-danger:hover { background: #dc2626; }
        .btn-icon { width: 32px; height: 32px; padding: 0; justify-content: center; border-radius: 7px; font-size: .85rem; }
        /* TABLE */
        table { width: 100%; border-collapse: collapse; }
        th { padding: .75rem 1rem; text-align: left; font-size: .78rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: .5px; border-bottom: 2px solid var(--border); white-space: nowrap; }
        td { padding: .85rem 1rem; font-size: .85rem; color: var(--text); border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
        tr:hover td { background: #fafbff; }
        /* FOOTER */
        footer.admin-footer {
            background: var(--navy);
            color: rgba(255,255,255,.6);
            padding: 1.2rem 1.8rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: .75rem;
            margin-top: auto;
            width: 100%;
        }
        .footer-links { display: flex; gap: 1.5rem; }
        .footer-links a { color: rgba(255,255,255,.5); text-decoration: none; transition: color .2s; }
        .footer-links a:hover { color: white; }

        /* GLOBAL PAGINATION */
        .pagination { display:flex; align-items:center; justify-content:space-between; padding:.9rem 1.2rem; border-top:1px solid #f1f5f9; }
        .pag-info { font-size:.78rem; color:#64748b; }
        .pag-btns { display:flex; align-items:center; gap:.3rem; }
        .pag-btn { width:32px; height:32px; border-radius:8px; border:1.5px solid #e2e8f0; background:white; cursor:pointer; font-size:.82rem; font-weight:600; color:#64748b; display:flex; align-items:center; justify-content:center; transition:all .15s; text-decoration:none; }
        .pag-btn:hover, .pag-btn.active { background:#2563eb; border-color:#2563eb; color:white; }
        .pag-btn.disabled { opacity:.4; cursor:not-allowed; pointer-events:none; }
        .pag-select { border:1.5px solid #e2e8f0; border-radius:8px; padding:.3rem .6rem; font-size:.78rem; font-family:inherit; outline:none; color:#64748b; }
    </style>
    @stack('styles')
</head>
<body>
    <aside class="sidebar">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">
                @if(\App\Models\SiteSetting::get('site_logo'))
                    <img src="{{ asset(\App\Models\SiteSetting::get('site_logo')) }}" style="max-height: 34px; margin-right: 8px;">
                @else
                    <div class="sidebar-brand-icon"><i class="fa-solid fa-bolt"></i></div>
                @endif
                <div>
                    <span style="color:var(--gold);font-weight:900;">ECARD</span> NALA
                    <span class="sidebar-subtitle">Trang quản trị</span>
                </div>
            </a>
        </div>
        <nav class="sidebar-nav">
            <ul>
                <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-house"></i> Tổng quan
                </a></li>
                <li><a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">
                    <i class="fa-solid fa-users"></i> Quản lý người dùng
                </a></li>
                <li><a href="{{ route('admin.cards') }}" class="{{ request()->routeIs('admin.cards') ? 'active' : '' }}">
                    <i class="fa-solid fa-address-card"></i> Quản lý danh thiếp
                </a></li>
                <li><a href="{{ route('admin.statistics') }}" class="{{ request()->routeIs('admin.statistics') ? 'active' : '' }}">
                    <i class="fa-solid fa-chart-bar"></i> Thống kê
                </a></li>
                <li><a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-cart-shopping"></i> Quản lý đơn hàng
                </a></li>
                <li><a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-box"></i> Giải pháp & Bảng giá
                </a></li>
                <li><a href="{{ route('admin.knowledge.index') }}" class="{{ request()->routeIs('admin.knowledge.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-book"></i> Kiến thức ECard
                </a></li>
                <li><a href="{{ route('admin.settings') }}" class="{{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                    <i class="fa-solid fa-gear"></i> Cài đặt hệ thống
                </a></li>
            </ul>
        </nav>
        <div class="sidebar-user">
            <div class="sidebar-avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="sidebar-user-info">
                <div class="name">{{ Auth::user()->name }}</div>
                <div class="role">{{ Auth::user()->email }}</div>
            </div>
            <i class="fa-solid fa-chevron-up sidebar-user-arrow"></i>
        </div>
    </aside>

    <div class="admin-main">
        <div class="admin-topbar">
            <div class="topbar-left">
                <button class="hamburger"><i class="fa-solid fa-bars"></i></button>
            </div>
            <div class="topbar-right">
                <button class="topbar-bell">
                    <i class="fa-regular fa-bell"></i>
                    <span class="badge"></span>
                </button>
                <div class="topbar-user" id="adminUserDropdown">
                    <div class="topbar-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                    <div class="topbar-user-info">
                        <div class="name">{{ Auth::user()->name }}</div>
                        <div class="role">Quản trị viên</div>
                    </div>
                    <i class="fa-solid fa-chevron-down" style="font-size:.7rem;color:var(--text-muted);margin-left:.3rem"></i>
                    
                    <div class="user-menu" id="adminUserMenu" style="position: absolute; right: 0; top: calc(100% + 10px); background: white; border: 1px solid var(--border); border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,.1); min-width: 180px; padding: .5rem; display: none; z-index: 300;">
                        <a href="{{ route('profile.edit') }}" style="display: flex; align-items: center; gap: .7rem; padding: .6rem .8rem; text-decoration: none; color: var(--text); font-size: .85rem; font-weight: 500; border-radius: 8px;"><i class="fa-regular fa-user"></i> Hồ sơ</a>
                        <a href="{{ route('dashboard') }}" style="display: flex; align-items: center; gap: .7rem; padding: .6rem .8rem; text-decoration: none; color: var(--text); font-size: .85rem; font-weight: 500; border-radius: 8px;"><i class="fa-solid fa-house"></i> Về trang chủ</a>
                        <hr style="margin: .4rem 0; border: none; border-top: 1px solid var(--border);">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" style="display: flex; align-items: center; gap: .7rem; padding: .6rem .8rem; text-decoration: none; color: #dc2626; font-size: .85rem; font-weight: 500; border-radius: 8px; width: 100%; text-align: left; background: none; border: none; cursor: pointer; font-family: inherit;"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const adminUserBtn = document.getElementById('adminUserDropdown');
                const adminUserMenu = document.getElementById('adminUserMenu');
                if (adminUserBtn && adminUserMenu) {
                    adminUserBtn.addEventListener('click', function(e) {
                        e.stopPropagation();
                        adminUserMenu.style.display = adminUserMenu.style.display === 'block' ? 'none' : 'block';
                    });
                    window.addEventListener('click', function(e) {
                        if (!adminUserBtn.contains(e.target)) {
                            adminUserMenu.style.display = 'none';
                        }
                    });
                }

                // Sidebar Toggle
                const hamburger = document.querySelector('.hamburger');
                if (hamburger) {
                    hamburger.addEventListener('click', function() {
                        document.body.classList.toggle('sidebar-collapsed');
                    });
                }
            });
        </script>

        <div class="admin-content">
            @if(session('success'))
            <div class="alert alert-success">
                <i class="fa-solid fa-circle-check"></i>
                {{ session('success') }}
                <button class="close-btn" onclick="this.parentElement.remove()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger">
                <i class="fa-solid fa-circle-exclamation"></i>
                {{ session('error') }}
                <button class="close-btn" onclick="this.parentElement.remove()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            @endif

            {{ $slot }}
        </div>

        <footer class="admin-footer">
            <span>© {{ date('Y') }} ECARD NALA - CTY CỔ PHẦN NALA GROUP</span>
            <div class="footer-links">
                <a href="#">Chính sách bảo mật</a>
                <a href="#">Điều khoản sử dụng</a>
                <a href="#">Hỗ trợ</a>
            </div>
        </footer>
    </div>

    @stack('scripts')
</body>
</html>
