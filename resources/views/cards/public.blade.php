<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết danh thiếp - {{ $card->full_name ?? 'Danh Thiếp Điện Tử' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.5/css/uikit.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.47.0/tabler-icons.min.css" rel="stylesheet" />
    <link href="{{ asset('css/bootstrap-ecard.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/ecard-original.css') }}" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.5/js/uikit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.5/js/components/slider.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.5/js/components/sticky.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.5/js/components/accordion.min.js"></script>

    <style>
        :root {
            --primary: #1a6ef5;
            --primary-dark: #1356c7;
            --primary-light: #e8f0fe;
            --teal: #00b4d8;
            --zalo: #0068ff;
            --facebook: #1877f2;
            --linkedin: #0a66c2;
            --text-dark: #0f172a;
            --text-mid: #374151;
            --text-muted: #6b7280;
            --border: #e5e7eb;
            --bg: #eef2fb;
            --white: #ffffff;
            --radius: 14px;
            --shadow: 0 2px 16px rgba(26,110,245,.10);
            --shadow-lg: 0 8px 32px rgba(26,110,245,.14);
        }

        body {
            font-family: 'Be Vietnam Pro', sans-serif;
            background: var(--bg);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── MAIN WRAPPER ── */
        .main-wrapper {
            flex: 1;
            padding: 28px 32px 48px;
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
        }

        /* ── BREADCRUMB ── */
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: var(--text-muted);
            margin-bottom: 22px;
        }
        .breadcrumb a { text-decoration: none; color: var(--text-muted); transition: color .2s; }
        .breadcrumb a:hover { color: var(--primary); }
        .breadcrumb .sep { color: #c3c8d4; }
        .breadcrumb .current { color: var(--text-mid); font-weight: 500; }

        /* ── PAGE HEADER ── */
        .page-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 28px;
            flex-wrap: wrap;
            gap: 16px;
        }
        .page-title-group {}
        .page-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 24px;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 4px;
        }
        .page-title .eye-icon { color: var(--primary); }
        .page-subtitle { font-size: 13.5px; color: var(--text-muted); }
        .header-actions { display: flex; gap: 10px; }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 18px;
            border-radius: 9px;
            font-size: 13.5px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all .2s;
            border: none;
        }
        .btn-outline {
            background: var(--white);
            color: var(--primary);
            border: 1.5px solid var(--primary);
        }
        .btn-outline:hover { background: var(--primary-light); }
        .btn-primary {
            background: var(--primary);
            color: #fff;
        }
        .btn-primary:hover { background: var(--primary-dark); }

        /* ── CONTENT GRID ── */
        .content-grid {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 24px;
            align-items: start;
        }

        /* ── CARD PANEL ── */
        .card-panel {
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        /* Card hero */
        .card-hero {
            background: linear-gradient(120deg, #1a6ef5 0%, #1356c7 60%, #0d4ab3 100%);
            padding: 32px 32px 36px;
            display: flex;
            align-items: center;
            gap: 24px;
            position: relative;
            overflow: hidden;
        }
        .card-hero::before {
            content: '';
            position: absolute;
            bottom: -30px;
            left: 0;
            right: 0;
            height: 80px;
            background: rgba(255,255,255,.07);
            border-radius: 50% 50% 0 0 / 100% 100% 0 0;
        }
        .card-hero::after {
            content: '';
            position: absolute;
            top: 10px;
            right: 30px;
            width: 180px;
            height: 180px;
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 50%;
            pointer-events: none;
        }
        /* Wave dots pattern */
        .hero-dots {
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            width: 220px;
            background-image:
                radial-gradient(circle, rgba(255,255,255,.12) 1px, transparent 1px),
                radial-gradient(circle, rgba(255,255,255,.07) 1px, transparent 1px);
            background-size: 22px 22px, 11px 11px;
            background-position: 0 0, 11px 11px;
        }
        .hero-avatar-wrap {
            flex-shrink: 0;
            z-index: 1;
        }
        .hero-avatar {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid rgba(255,255,255,.55);
            display: block;
        }
        .hero-avatar-placeholder {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            background: rgba(255,255,255,.18);
            border: 4px solid rgba(255,255,255,.55);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 38px;
            font-weight: 800;
            color: #fff;
        }
        .hero-info { z-index: 1; }
        .hero-name {
            font-size: 26px;
            font-weight: 800;
            color: #fff;
            letter-spacing: -.5px;
            margin-bottom: 10px;
        }
        .hero-badge {
            display: inline-block;
            background: rgba(255,255,255,.18);
            color: #fff;
            border: 1px solid rgba(255,255,255,.28);
            border-radius: 20px;
            padding: 4px 14px;
            font-size: 12.5px;
            font-weight: 500;
            margin-bottom: 10px;
        }
        .hero-company {
            font-size: 14px;
            color: rgba(255,255,255,.85);
            font-weight: 500;
        }

        /* Contact section */
        .contact-section {
            padding: 28px 28px 0;
        }
        .section-title {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 15px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 18px;
        }
        .contact-list { display: flex; flex-direction: column; gap: 0; }
        .contact-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 16px 0;
            border-bottom: 1px solid var(--border);
        }
        .contact-item:last-child { border-bottom: none; }
        .contact-icon-wrap {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: var(--primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .contact-icon-wrap svg { color: var(--primary); }
        .contact-info { flex: 1; min-width: 0; }
        .contact-label { font-size: 11.5px; color: var(--text-muted); margin-bottom: 2px; }
        .contact-value { font-size: 14.5px; font-weight: 600; color: var(--text-dark); }
        .contact-actions { display: flex; align-items: center; gap: 8px; }
        .btn-action-circle {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--primary);
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background .2s, transform .15s;
        }
        .btn-action-circle:hover { background: var(--primary-dark); transform: scale(1.07); }
        .btn-action-circle svg { color: #fff; }
        .btn-copy {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: none;
            border: 1.5px solid var(--border);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: border-color .2s, background .2s;
            color: var(--text-muted);
        }
        .btn-copy:hover { border-color: var(--primary); background: var(--primary-light); color: var(--primary); }

        /* Social section */
        .social-section {
            padding: 24px 28px 28px;
        }
        .social-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }
        .btn-social {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 13px 10px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
            color: #fff;
            text-decoration: none;
            cursor: pointer;
            border: none;
            transition: opacity .2s, transform .15s;
        }
        .btn-social:hover { opacity: .88; transform: translateY(-2px); }
        .btn-facebook { background: var(--facebook); }
        .btn-zalo { background: var(--zalo); }
        .btn-linkedin { background: var(--linkedin); }

        /* ── RIGHT SIDEBAR ── */
        .sidebar { display: flex; flex-direction: column; gap: 16px; }

        .sidebar-card {
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 22px;
        }

        .sidebar-card-title {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 15px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 6px;
        }

        /* QR Card */
        .qr-subtitle { font-size: 12.5px; color: var(--text-muted); margin-bottom: 16px; }
        .qr-wrapper {
            width: 100%;
            aspect-ratio: 1;
            max-width: 200px;
            margin: 0 auto;
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .qr-wrapper img { width: 100%; height: 100%; object-fit: contain; display: block; }
        .qr-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 8px;
            color: var(--text-muted);
            font-size: 12px;
        }
        .qr-placeholder .qr-icon { opacity: .35; }

        /* Share Card */
        .share-desc { font-size: 12.5px; color: var(--text-muted); line-height: 1.6; margin-bottom: 16px; }
        .link-label { font-size: 12px; font-weight: 700; color: var(--text-dark); margin-bottom: 8px; }
        .link-box {
            display: flex;
            align-items: center;
            background: #f4f6fb;
            border: 1.5px solid var(--border);
            border-radius: 9px;
            padding: 9px 10px 9px 14px;
            gap: 8px;
        }
        .link-text {
            flex: 1;
            font-size: 12.5px;
            color: var(--text-mid);
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .btn-copy-sm {
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
            color: var(--text-muted);
            border-radius: 6px;
            display: flex;
            align-items: center;
            transition: color .2s, background .2s;
        }
        .btn-copy-sm:hover { color: var(--primary); background: var(--primary-light); }

        .footer-links { display: flex; gap: 24px; }

        /* Toast */
        .toast {
            position: fixed;
            bottom: 28px;
            right: 28px;
            background: #1a2540;
            color: #fff;
            padding: 11px 18px;
            border-radius: 10px;
            font-size: 13.5px;
            font-weight: 500;
            box-shadow: 0 4px 20px rgba(0,0,0,.25);
            opacity: 0;
            transform: translateY(10px);
            transition: all .3s;
            z-index: 9999;
            pointer-events: none;
        }
        .toast.show { opacity: 1; transform: translateY(0); }

        @media (max-width: 900px) {
            .content-grid { grid-template-columns: 1fr; }
            .main-wrapper { padding: 20px 16px 36px; }
            .navbar { padding: 0 16px; }
        }
    </style>
</head>
<body>

@include('partials.header')

{{-- ── MAIN ── --}}
<div class="main-wrapper">

    {{-- Breadcrumb --}}
    <nav class="breadcrumb">
        <a href="{{ url('/') }}">Trang chủ</a>
        <span class="sep">/</span>
        <a href="{{ Route::has('cards.index') ? route('cards.index') : '#' }}">Danh thiếp</a>
        <span class="sep">/</span>
        <span class="current">Chi tiết danh thiếp</span>
    </nav>

    {{-- Page header --}}
    <div class="page-header">
        <div class="page-title-group">
            <h1 class="page-title">
                <svg class="eye-icon" width="26" height="26" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                    <circle cx="12" cy="12" r="3"/>
                </svg>
                Chi tiết danh thiếp
            </h1>
            <p class="page-subtitle">Xem và chia sẻ thông tin danh thiếp của bạn</p>
        </div>
        <div class="header-actions">
            <button class="btn btn-outline" id="btnShare">
                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                    <circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/>
                    <path d="M8.59 13.51l6.83 3.98M15.41 6.51l-6.82 3.98"/>
                </svg>
                Chia sẻ
            </button>
            <a href="{{ isset($card) ? route('cards.edit', $card->id) : '#' }}" class="btn btn-primary">
                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                    <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Chỉnh sửa danh thiếp
            </a>
        </div>
    </div>

    {{-- Content --}}
    <div class="content-grid">

        {{-- LEFT: Card detail --}}
        <div class="card-panel">

            {{-- Hero --}}
            <div class="card-hero">
                <div class="hero-dots"></div>
                <div class="hero-avatar-wrap">
                    @if(isset($card) && $card->avatar)
                        <img src="{{ asset('storage/'.$card->avatar) }}" alt="{{ $card->full_name }}" class="hero-avatar">
                    @else
                        <div class="hero-avatar-placeholder">
                            {{ isset($card) ? mb_substr($card->full_name, 0, 1) : 'N' }}
                        </div>
                    @endif
                </div>
                <div class="hero-info">
                    <div class="hero-name">{{ isset($card) ? strtoupper($card->full_name) : 'NGUYỄN VĂN AN' }}</div>
                    @if(isset($card) && $card->job_title)
                        <span class="hero-badge">{{ $card->job_title }}</span>
                    @else
                        <span class="hero-badge">Nhà phát triển phần mềm</span>
                    @endif
                    <div class="hero-company">
                        {{ isset($card) ? ($card->company ?? '') : 'Công ty TNHH Công Nghệ ABC' }}
                    </div>
                </div>
            </div>

            {{-- Contact info --}}
            <div class="contact-section">
                <div class="section-title">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Thông tin liên hệ
                </div>
                <div class="contact-list">

                    {{-- Phone --}}
                    <div class="contact-item">
                        <div class="contact-icon-wrap">
                            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div class="contact-info">
                            <div class="contact-label">Số điện thoại</div>
                            <div class="contact-value">{{ isset($card) ? ($card->phone ?? '—') : '0123 456 789' }}</div>
                        </div>
                        <div class="contact-actions">
                            @if(isset($card) && $card->phone)
                            <a href="tel:{{ $card->phone }}" class="btn-action-circle">
                                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                                    <path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </a>
                            @endif
                            <button class="btn-copy" onclick="copyText('{{ isset($card) ? $card->phone : '0123456789' }}')" title="Sao chép">
                                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="contact-item">
                        <div class="contact-icon-wrap">
                            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="contact-info">
                            <div class="contact-label">Email</div>
                            <div class="contact-value">{{ isset($card) ? ($card->email ?? '—') : 'nguyenvanan@example.com' }}</div>
                        </div>
                        <div class="contact-actions">
                            @if(isset($card) && $card->email)
                            <a href="mailto:{{ $card->email }}" class="btn-action-circle">
                                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                                    <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </a>
                            @endif
                            <button class="btn-copy" onclick="copyText('{{ isset($card) ? $card->email : '' }}')" title="Sao chép">
                                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Address --}}
                    <div class="contact-item">
                        <div class="contact-icon-wrap">
                            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div class="contact-info">
                            <div class="contact-label">Địa chỉ</div>
                            <div class="contact-value">{{ isset($card) ? ($card->address ?? '—') : 'Hà Nội, Việt Nam' }}</div>
                        </div>
                        <div class="contact-actions">
                            <button class="btn-copy" onclick="copyText('{{ isset($card) ? $card->address : 'Hà Nội, Việt Nam' }}')" title="Sao chép">
                                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Website --}}
                    <div class="contact-item">
                        <div class="contact-icon-wrap">
                            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/>
                            </svg>
                        </div>
                        <div class="contact-info">
                            <div class="contact-label">Website</div>
                            <div class="contact-value">{{ isset($card) ? ($card->website ?? '—') : 'www.example.com' }}</div>
                        </div>
                        <div class="contact-actions">
                            @if(isset($card) && $card->website)
                            <a href="{{ $card->website }}" target="_blank" rel="noopener" class="btn-action-circle">
                                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                                    <circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/>
                                </svg>
                            </a>
                            @endif
                            <button class="btn-copy" onclick="copyText('{{ isset($card) ? $card->website : 'www.example.com' }}')" title="Sao chép">
                                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Social --}}
            <div class="social-section">
                <div class="section-title">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/>
                        <path d="M8.59 13.51l6.83 3.98M15.41 6.51l-6.82 3.98"/>
                    </svg>
                    Liên kết mạng xã hội
                </div>
                <div class="social-grid">
                    <a href="{{ isset($card) ? ($card->facebook_url ?? '#') : '#' }}" target="_blank" rel="noopener" class="btn-social btn-facebook">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                        Facebook
                    </a>
                    <a href="{{ isset($card) ? ($card->zalo_url ?? '#') : '#' }}" target="_blank" rel="noopener" class="btn-social btn-zalo">
                        <svg width="20" height="20" viewBox="0 0 32 32" fill="currentColor">
                            <text x="2" y="24" font-size="22" font-weight="900" font-family="Arial,sans-serif">Z</text>
                        </svg>
                        Zalo
                    </a>
                    <a href="{{ isset($card) ? ($card->linkedin_url ?? '#') : '#' }}" target="_blank" rel="noopener" class="btn-social btn-linkedin">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                        LinkedIn
                    </a>
                </div>
            </div>

        </div>{{-- /card-panel --}}

        {{-- RIGHT: Sidebar --}}
        <div class="sidebar">

            {{-- QR Code --}}
            <div class="sidebar-card">
                <div class="sidebar-card-title">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
                        <path d="M14 14h3v3h-3zM17 17h3v3h-3zM14 20h3"/>
                    </svg>
                    Mã QR danh thiếp
                </div>
                <p class="qr-subtitle">Quét mã để lưu danh thiếp</p>
                <div class="qr-wrapper">
                    @if(isset($card) && $card->qr_code)
                        <img src="{{ asset('storage/'.$card->qr_code) }}" alt="QR Code">
                    @elseif(isset($qrCode))
                        {!! $qrCode !!}
                    @else
                        {{-- Fallback: generate via Google Charts API --}}
                        <img
                            src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data={{ urlencode(isset($card) ? url('/cards/'.$card->slug) : url()->current()) }}&color=1a2540&bgcolor=ffffff"
                            alt="QR Code danh thiếp"
                            style="width:100%;height:100%;object-fit:contain;border-radius:8px;"
                        >
                    @endif
                </div>
            </div>

            {{-- Quick Share --}}
            <div class="sidebar-card">
                <div class="sidebar-card-title">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/>
                    </svg>
                    Chia sẻ nhanh chóng
                </div>
                <p class="share-desc">Quét mã QR hoặc chia sẻ link để người khác lưu thông tin của bạn ngay lập tức.</p>
                <div class="link-label">Link danh thiếp</div>
                <div class="link-box">
                    <span class="link-text" id="cardLink">
                        {{ isset($card) ? url('/cards/'.$card->slug) : 'https://danthiepdt.com/vanan' }}
                    </span>
                    <button class="btn-copy-sm" onclick="copyCardLink()" title="Sao chép link">
                        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/>
                        </svg>
                    </button>
                </div>
            </div>

        </div>{{-- /sidebar --}}

    </div>{{-- /content-grid --}}

</div>{{-- /main-wrapper --}}

@include('partials.homepage.footer')

{{-- Toast notification --}}
<div class="toast" id="toast">Đã sao chép!</div>

<script>
    function showToast(msg) {
        const t = document.getElementById('toast');
        t.textContent = msg || 'Đã sao chép!';
        t.classList.add('show');
        setTimeout(() => t.classList.remove('show'), 2200);
    }

    function copyText(text) {
        if (!text) return;
        navigator.clipboard.writeText(text).then(() => showToast('Đã sao chép!')).catch(() => {
            const ta = document.createElement('textarea');
            ta.value = text; document.body.appendChild(ta);
            ta.select(); document.execCommand('copy');
            document.body.removeChild(ta); showToast('Đã sao chép!');
        });
    }

    function copyCardLink() {
        const link = document.getElementById('cardLink').textContent.trim();
        copyText(link);
    }

    document.getElementById('btnShare')?.addEventListener('click', function () {
        const link = document.getElementById('cardLink').textContent.trim();
        if (navigator.share) {
            navigator.share({ title: 'Danh thiếp điện tử', url: link });
        } else {
            copyText(link);
            showToast('Đã sao chép link chia sẻ!');
        }
    });
</script>

</body>
</html>
