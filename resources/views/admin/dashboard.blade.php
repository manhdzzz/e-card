<x-admin-layout>
    <x-slot name="title">Tổng quan</x-slot>

    @push('styles')
    <style>
        .stats-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:1rem; margin-bottom:1.5rem; }
        .stat-card { background:white; border-radius:12px; padding:1.2rem 1.3rem; border:1px solid #e2e8f0; display:flex; align-items:center; gap:1rem; }
        .stat-icon { width:48px; height:48px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.2rem; flex-shrink:0; }
        .stat-label { font-size:.75rem; color:#64748b; font-weight:500; margin-bottom:.2rem; }
        .stat-value { font-size:1.5rem; font-weight:800; color:#1e293b; line-height:1; }
        .stat-change { font-size:.75rem; font-weight:600; margin-top:.2rem; display:flex; align-items:center; gap:.25rem; }
        .stat-change.up { color:#10b981; }
        .stat-change.down { color:#ef4444; }
        .stat-meta { font-size:.72rem; color:#94a3b8; margin-top:.1rem; }
        /* Charts row */
        .charts-row { display:grid; grid-template-columns:1fr 320px; gap:1rem; margin-bottom:1rem; }
        .chart-card { background:white; border-radius:12px; border:1px solid #e2e8f0; padding:1.2rem; }
        .chart-title { font-size:.88rem; font-weight:700; color:#1e293b; margin-bottom:1rem; display:flex; align-items:center; justify-content:space-between; }
        .chart-placeholder { height:200px; background:#f8faff; border-radius:10px; display:flex; align-items:center; justify-content:center; color:#94a3b8; font-size:.85rem; flex-direction:column; gap:.5rem; }
        /* Recent activity */
        .recent-row { display:grid; grid-template-columns:1fr 1fr; gap:1rem; }
        .recent-card { background:white; border-radius:12px; border:1px solid #e2e8f0; padding:1.2rem; }
        .rc-title { font-size:.88rem; font-weight:700; color:#1e293b; margin-bottom:.9rem; display:flex; align-items:center; justify-content:space-between; }
        .rc-title a { font-size:.75rem; color:#2563eb; text-decoration:none; font-weight:600; }
        .rc-item { display:flex; align-items:center; gap:.75rem; padding:.55rem 0; border-bottom:1px solid #f8faff; }
        .rc-item:last-child { border-bottom:none; }
        .rc-avatar { width:34px; height:34px; border-radius:50%; background:#eff6ff; display:flex; align-items:center; justify-content:center; color:#2563eb; font-weight:700; font-size:.8rem; flex-shrink:0; overflow:hidden; }
        .rc-avatar img { width:100%; height:100%; object-fit:cover; }
        .rc-name { font-size:.83rem; font-weight:600; color:#1e293b; }
        .rc-meta { font-size:.73rem; color:#94a3b8; margin-top:.1rem; }
        .rc-badge { padding:.2rem .55rem; border-radius:20px; font-size:.7rem; font-weight:700; margin-left:auto; flex-shrink:0; }
        .badge-active { background:#dcfce7; color:#16a34a; }
        .badge-locked { background:#fee2e2; color:#dc2626; }
        .badge-published { background:#dcfce7; color:#16a34a; }
        .badge-draft { background:#fef9c3; color:#ca8a04; }
        /* Mini bar chart */
        .mini-bars { display:flex; align-items:flex-end; gap:4px; height:60px; margin-top:.5rem; }
        .mini-bar { flex:1; border-radius:4px 4px 0 0; background:linear-gradient(180deg,#60a5fa,#2563eb); min-height:4px; transition:opacity .2s; }
        .mini-bar:hover { opacity:.8; }
    </style>
    @endpush

    <div class="breadcrumb">
        <a href="{{ route('admin.dashboard') }}">Trang chủ</a>
        <span>/</span>
        <span>Tổng quan</span>
    </div>
    <h1 style="font-size:1.4rem;font-weight:800;color:#1e293b;margin-bottom:1.2rem">Tổng quan hệ thống</h1>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon" style="background:#eff6ff;color:#2563eb"><i class="fa-solid fa-users"></i></div>
            <div>
                <div class="stat-label">Tổng số người dùng</div>
                <div class="stat-value">{{ number_format($stats['total_users'] ?? 0) }}</div>
                <div class="stat-change {{ $stats['user_change'] >= 0 ? 'up' : 'down' }}">
                    <i class="fa-solid fa-arrow-{{ $stats['user_change'] >= 0 ? 'up' : 'down' }}"></i> 
                    {{ abs($stats['user_change']) }}% 
                    <span style="color:#94a3b8;font-weight:400">tăng trưởng</span>
                </div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:#f0fdf4;color:#10b981"><i class="fa-solid fa-address-card"></i></div>
            <div>
                <div class="stat-label">Tổng số danh thiếp</div>
                <div class="stat-value">{{ number_format($stats['total_cards'] ?? 0) }}</div>
                <div class="stat-meta">Đã tạo trong hệ thống</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:#fdf4ff;color:#a855f7"><i class="fa-solid fa-share-nodes"></i></div>
            <div>
                <div class="stat-label">Danh thiếp đã chia sẻ</div>
                <div class="stat-value">{{ number_format($stats['shared_cards'] ?? 0) }}</div>
                <div class="stat-meta">Có ít nhất 1 lượt xem</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:#fff7ed;color:#f97316"><i class="fa-regular fa-eye"></i></div>
            <div>
                <div class="stat-label">Lượt xem danh thiếp</div>
                <div class="stat-value">{{ number_format($stats['total_views'] ?? 0) }}</div>
                <div class="stat-meta">Tổng lượt truy cập thực tế</div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="charts-row">
        <div class="chart-card">
            <div class="chart-title">
                <span style="display:flex;align-items:center;gap:.4rem"><i class="fa-solid fa-chart-line" style="color:#2563eb"></i> Số liệu hoạt động theo ngày</span>
                <select onchange="window.location.href='{{ route('admin.dashboard') }}?days=' + this.value" style="border:1px solid #e2e8f0;border-radius:7px;padding:.3rem .6rem;font-size:.78rem;color:#64748b;outline:none;font-family:inherit">
                    <option value="7" {{ $days == 7 ? 'selected' : '' }}>7 ngày qua</option>
                    <option value="30" {{ $days == 30 ? 'selected' : '' }}>30 ngày qua</option>
                    <option value="90" {{ $days == 90 ? 'selected' : '' }}>90 ngày qua</option>
                </select>
            </div>
            <div style="display:flex;gap:1rem;margin-bottom:.8rem">
                <span style="display:flex;align-items:center;gap:.35rem;font-size:.75rem;color:#64748b"><span style="width:10px;height:3px;background:#2563eb;border-radius:2px;display:inline-block"></span>Người dùng mới</span>
                <span style="display:flex;align-items:center;gap:.35rem;font-size:.75rem;color:#64748b"><span style="width:10px;height:3px;background:#10b981;border-radius:2px;display:inline-block"></span>Danh thiếp tạo mới</span>
                <span style="display:flex;align-items:center;gap:.35rem;font-size:.75rem;color:#64748b"><span style="width:10px;height:3px;background:#f97316;border-radius:2px;display:inline-block"></span>Lượt xem</span>
            </div>
            <div style="height:220px; position:relative;">
                <canvas id="activityChart"></canvas>
            </div>
            @push('scripts')
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('activityChart').getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($activity['labels'] ?? []) !!},
                        datasets: [{
                            label: 'Người dùng mới',
                            data: {!! json_encode($activity['users'] ?? []) !!},
                            borderColor: '#2563eb',
                            backgroundColor: 'rgba(37,99,235,0.05)',
                            fill: true,
                            tension: 0.4,
                            pointRadius: 4,
                            pointHoverRadius: 6
                        }, {
                            label: 'Danh thiếp mới',
                            data: {!! json_encode($activity['cards'] ?? []) !!},
                            borderColor: '#10b981',
                            backgroundColor: 'rgba(16,185,129,0.05)',
                            fill: true,
                            tension: 0.4,
                            pointRadius: 4,
                            pointHoverRadius: 6
                        }, {
                            label: 'Lượt xem',
                            data: {!! json_encode($activity['views'] ?? []) !!},
                            borderColor: '#f97316',
                            backgroundColor: 'rgba(249,115,22,0.05)',
                            fill: true,
                            tension: 0.4,
                            pointRadius: 4,
                            pointHoverRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            y: { beginAtZero: true, grid: { color: '#f1f5f9' } },
                            x: { grid: { display: false } }
                        }
                    }
                });
            });
            </script>
            @endpush
        </div>
        <div class="chart-card">
            <div class="chart-title">
                <span style="display:flex;align-items:center;gap:.4rem"><i class="fa-solid fa-chart-pie" style="color:#a855f7"></i> Tỷ lệ danh thiếp được chia sẻ</span>
            </div>
            <div style="text-align:center;padding:1rem 0">
                <div style="width:160px;height:160px;margin:0 auto;position:relative">
                    <canvas id="shareRatioChart"></canvas>
                    <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);font-size:1.1rem;font-weight:800;color:#1e293b">{{ $stats['share_ratio'] ?? 0 }}%</div>
                </div>
                @push('scripts')
                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const ctxShare = document.getElementById('shareRatioChart').getContext('2d');
                    new Chart(ctxShare, {
                        type: 'doughnut',
                        data: {
                            labels: ['Đã chia sẻ', 'Chưa chia sẻ'],
                            datasets: [{
                                data: [{{ $stats['share_ratio'] ?? 0 }}, {{ 100 - ($stats['share_ratio'] ?? 0) }}],
                                backgroundColor: ['#10b981', '#e2e8f0'],
                                borderWidth: 0,
                                cutout: '75%'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: { legend: { display: false } }
                        }
                    });
                });
                </script>
                @endpush
                <div style="margin-top:.8rem;font-size:.75rem;color:#64748b">Tỷ lệ danh thiếp đã có tương tác</div>
                <div style="display:flex;flex-direction:column;gap:.4rem;margin-top:.8rem">
                    <div style="display:flex;align-items:center;justify-content:space-between;font-size:.78rem">
                        <span style="display:flex;align-items:center;gap:.4rem"><span style="width:10px;height:10px;background:#10b981;border-radius:50%;display:inline-block"></span>Đã chia sẻ</span>
                        <span style="font-weight:700;color:#1e293b">{{ number_format($stats['shared_cards'] ?? 0) }} ({{ $stats['share_ratio'] ?? 0 }}%)</span>
                    </div>
                    <div style="display:flex;align-items:center;justify-content:space-between;font-size:.78rem">
                        <span style="display:flex;align-items:center;gap:.4rem"><span style="width:10px;height:10px;background:#e2e8f0;border-radius:50%;display:inline-block"></span>Chưa chia sẻ</span>
                        <span style="font-weight:700;color:#1e293b">{{ number_format(($stats['total_cards'] ?? 0) - ($stats['shared_cards'] ?? 0)) }} ({{ 100 - ($stats['share_ratio'] ?? 0) }}%)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="recent-row">
        <div class="recent-card">
            <div class="rc-title">
                <span><i class="fa-solid fa-users" style="color:#2563eb;margin-right:.4rem"></i>Người dùng mới nhất</span>
                <div>
                    <a href="{{ route('admin.users.export') }}" style="font-size:.75rem; color:#10b981; text-decoration:none; font-weight:600; margin-right:1rem;"><i class="fa-solid fa-download"></i> Xuất CSV</a>
                    <a href="{{ route('admin.users') }}">Xem tất cả →</a>
                </div>
            </div>
            @foreach($recentUsers ?? [] as $user)
            <div class="rc-item">
                <div class="rc-avatar">{{ strtoupper(substr($user->name,0,1)) }}</div>
                <div>
                    <div class="rc-name">{{ $user->name }}</div>
                    <div class="rc-meta">{{ $user->email }} · {{ $user->created_at->diffForHumans() }}</div>
                </div>
                <span class="rc-badge {{ $user->is_active ? 'badge-active' : 'badge-locked' }}">
                    {{ $user->is_active ? 'Hoạt động' : 'Đã khóa' }}
                </span>
            </div>
            @endforeach
            @if(count($recentUsers ?? []) === 0)
            <div style="text-align:center;padding:2rem;color:#94a3b8;font-size:.85rem">Chưa có người dùng nào</div>
            @endif
        </div>

        <div class="recent-card">
            <div class="rc-title">
                <span><i class="fa-solid fa-address-card" style="color:#2563eb;margin-right:.4rem"></i>Danh thiếp mới nhất</span>
                <a href="{{ route('admin.cards') }}">Xem tất cả →</a>
            </div>
            @foreach($recentCards ?? [] as $card)
            <div class="rc-item">
                <div class="rc-avatar" style="background:linear-gradient(135deg,#2563eb,#60a5fa);color:white">
                    {{ strtoupper(substr($card->full_name,0,1)) }}
                </div>
                <div>
                    <div class="rc-name">{{ $card->full_name }}</div>
                    <div class="rc-meta">{{ $card->user->email ?? '' }} · {{ $card->created_at->diffForHumans() }}</div>
                </div>
                <span class="rc-badge badge-published">
                    Đã xuất bản
                </span>
            </div>
            @endforeach
            @if(count($recentCards ?? []) === 0)
            <div style="text-align:center;padding:2rem;color:#94a3b8;font-size:.85rem">Chưa có danh thiếp nào</div>
            @endif
        </div>
    </div>
</x-admin-layout>
