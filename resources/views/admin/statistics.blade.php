<x-admin-layout>
    <x-slot name="title">Thống kê hệ thống</x-slot>

    @push('styles')
    <style>
        .stats-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:1rem; margin-bottom:1.3rem; }
        .stat-card { background:white; border-radius:12px; padding:1.2rem 1.3rem; border:1px solid #e2e8f0; display:flex; align-items:center; gap:1rem; }
        .stat-icon { width:48px; height:48px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.2rem; flex-shrink:0; }
        .stat-label { font-size:.75rem; color:#64748b; font-weight:500; }
        .stat-value { font-size:1.5rem; font-weight:800; color:#1e293b; line-height:1.1; }
        .stat-change { font-size:.73rem; font-weight:600; display:flex; align-items:center; gap:.25rem; margin-top:.15rem; }
        .stat-change.up { color:#10b981; }
        .stat-meta { font-size:.7rem; color:#94a3b8; }
        .charts-row { display:grid; grid-template-columns:1fr 320px; gap:1rem; margin-bottom:1.2rem; }
        .chart-card { background:white; border-radius:12px; border:1px solid #e2e8f0; padding:1.3rem; }
        .chart-title { font-size:.88rem; font-weight:700; color:#1e293b; margin-bottom:1rem; display:flex; align-items:center; justify-content:space-between; gap:.5rem; }
        /* Line chart placeholder */
        .chart-area { height:220px; position:relative; overflow:hidden; }
        .chart-lines { position:absolute; inset:0; display:flex; flex-direction:column; justify-content:space-between; padding:.5rem 0; }
        .chart-line { width:100%; height:1px; background:#f1f5f9; }
        .chart-bars-container { position:absolute; inset:0; display:flex; align-items:flex-end; gap:3px; padding:0 8px 20px; }
        .chart-bar-group { flex:1; display:flex; align-items:flex-end; gap:1px; }
        .chart-bar { flex:1; border-radius:3px 3px 0 0; min-height:4px; }
        /* Donut */
        .donut-wrap { text-align:center; padding:.5rem 0; }
        .donut { width:130px; height:130px; border-radius:50%; background:conic-gradient(#10b981 0deg 228deg,#e2e8f0 228deg 360deg); margin:0 auto; display:flex; align-items:center; justify-content:center; }
        .donut-inner { width:88px; height:88px; background:white; border-radius:50%; display:flex; flex-direction:column; align-items:center; justify-content:center; }
        .donut-pct { font-size:1.1rem; font-weight:800; color:#1e293b; }
        .donut-sub { font-size:.65rem; color:#94a3b8; }
        .legend-item { display:flex; align-items:center; justify-content:space-between; font-size:.78rem; margin-top:.5rem; }
        .legend-dot { width:10px; height:10px; border-radius:50%; display:inline-block; margin-right:.4rem; }
        /* Table */
        .detail-table-card { background:white; border-radius:12px; border:1px solid #e2e8f0; overflow:hidden; }
        .dt-header { padding:1rem 1.3rem; border-bottom:1px solid #f1f5f9; display:flex; align-items:center; justify-content:space-between; }
        .dt-title { font-size:.88rem; font-weight:700; color:#1e293b; display:flex; align-items:center; gap:.4rem; }
        .pagination { display:flex; align-items:center; justify-content:space-between; padding:.9rem 1.3rem; border-top:1px solid #f1f5f9; }
        .pag-info { font-size:.78rem; color:#64748b; }
        .pag-btns { display:flex; align-items:center; gap:.3rem; }
        .pag-btn { width:30px; height:30px; border-radius:7px; border:1.5px solid #e2e8f0; background:white; cursor:pointer; font-size:.8rem; font-weight:600; color:#64748b; display:flex; align-items:center; justify-content:center; transition:all .15s; text-decoration:none; }
        .pag-btn.active, .pag-btn:hover { background:#2563eb; border-color:#2563eb; color:white; }
        .pag-select { border:1.5px solid #e2e8f0; border-radius:7px; padding:.25rem .5rem; font-size:.75rem; font-family:inherit; outline:none; color:#64748b; }
    </style>
    @endpush

    <div class="breadcrumb">
        <a href="{{ route('admin.dashboard') }}">Trang chủ</a><span>/</span>
        <span>Thống kê hệ thống</span>
    </div>

    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.2rem;flex-wrap:wrap;gap:.7rem">
        <div>
            <h1 style="font-size:1.4rem;font-weight:800;color:#1e293b">Thống kê hệ thống</h1>
            <p style="font-size:.82rem;color:#64748b;margin-top:.15rem">Theo dõi và phân tích tình trạng hoạt động của hệ thống.</p>
        </div>
        <form action="{{ route('admin.statistics') }}" method="GET" style="display:flex;gap:.7rem;align-items:center">
            <div style="display:flex; align-items:center; gap:.5rem; background:white; border:1.5px solid #e2e8f0; border-radius:8px; padding:0 .7rem">
                <i class="fa-regular fa-calendar" style="color:#94a3b8"></i>
                <input type="date" name="start_date" value="{{ request('start_date', now()->subDays(30)->format('Y-m-d')) }}" style="border:none; padding:.55rem 0; outline:none; font-size:.85rem; color:#1e293b; font-family:inherit">
                <span style="color:#e2e8f0">|</span>
                <input type="date" name="end_date" value="{{ request('end_date', now()->format('Y-m-d')) }}" style="border:none; padding:.55rem 0; outline:none; font-size:.85rem; color:#1e293b; font-family:inherit">
            </div>
            <button type="submit" class="btn btn-gray">Lọc</button>
            <a href="{{ route('admin.cards.export') }}" class="btn btn-primary">
                <i class="fa-solid fa-download"></i> Xuất báo cáo
            </a>
        </form>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon" style="background:#eff6ff;color:#2563eb"><i class="fa-solid fa-users"></i></div>
            <div>
                <div class="stat-label">Tổng số người dùng</div>
                <div class="stat-value">{{ number_format($stats['total_users'] ?? 0) }}</div>
                <div class="stat-change up"><i class="fa-solid fa-arrow-up"></i> 12.5%</div>
                <div class="stat-meta">Trong khoảng thời gian chọn</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:#f0fdf4;color:#10b981"><i class="fa-solid fa-address-card"></i></div>
            <div>
                <div class="stat-label">Tổng số danh thiếp</div>
                <div class="stat-value">{{ number_format($stats['total_cards'] ?? 0) }}</div>
                <div class="stat-change up"><i class="fa-solid fa-arrow-up"></i> 8.3%</div>
                <div class="stat-meta">Trong khoảng thời gian chọn</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:#fdf4ff;color:#a855f7"><i class="fa-solid fa-share-nodes"></i></div>
            <div>
                <div class="stat-label">Danh thiếp được chia sẻ</div>
                <div class="stat-value">{{ number_format($stats['shared_cards'] ?? 0) }}</div>
                <div class="stat-change up"><i class="fa-solid fa-arrow-up"></i> 15.7%</div>
                <div class="stat-meta">Trong khoảng thời gian chọn</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:#fff7ed;color:#f97316"><i class="fa-regular fa-eye"></i></div>
            <div>
                <div class="stat-label">Lượt xem danh thiếp</div>
                <div class="stat-value">{{ number_format($stats['total_views'] ?? 0) }}</div>
                <div class="stat-change up"><i class="fa-solid fa-arrow-up"></i> 21.4%</div>
                <div class="stat-meta">Trong khoảng thời gian chọn</div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="charts-row">
        <div class="chart-card">
            <div class="chart-title">
                <span style="display:flex;align-items:center;gap:.4rem"><i class="fa-solid fa-chart-line" style="color:#2563eb"></i> Số liệu hoạt động theo ngày</span>
                <select style="border:1.5px solid #e2e8f0;border-radius:7px;padding:.28rem .6rem;font-size:.78rem;color:#64748b;outline:none;font-family:inherit">
                    <option>7 ngày qua</option>
                    <option>30 ngày qua</option>
                </select>
            </div>
            <div style="display:flex;gap:1rem;margin-bottom:.8rem;flex-wrap:wrap">
                <span style="display:flex;align-items:center;gap:.35rem;font-size:.75rem;color:#64748b"><span style="width:12px;height:3px;background:#2563eb;border-radius:2px;display:inline-block"></span>Người dùng mới</span>
                <span style="display:flex;align-items:center;gap:.35rem;font-size:.75rem;color:#64748b"><span style="width:12px;height:3px;background:#10b981;border-radius:2px;display:inline-block"></span>Danh thiếp tạo mới</span>
                <span style="display:flex;align-items:center;gap:.35rem;font-size:.75rem;color:#64748b"><span style="width:12px;height:3px;background:#f97316;border-radius:2px;display:inline-block"></span>Lượt xem</span>
            </div>
            <div style="height:250px; position:relative;">
                <canvas id="statsChart"></canvas>
            </div>
            @push('scripts')
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('statsChart').getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['01/05', '03/05', '05/05', '07/05', '09/05', '11/05', '13/05', '15/05', '17/05', '19/05', '21/05'],
                        datasets: [
                            {
                                label: 'Người dùng mới',
                                data: [45, 52, 38, 60, 55, 70, 65, 75, 58, 48, 52],
                                borderColor: '#2563eb',
                                backgroundColor: 'rgba(37,99,235,0.1)',
                                fill: true, tension: 0.4
                            },
                            {
                                label: 'Danh thiếp mới',
                                data: [128, 150, 110, 180, 160, 200, 190, 215, 165, 140, 142],
                                borderColor: '#10b981',
                                backgroundColor: 'rgba(16,185,129,0.1)',
                                fill: true, tension: 0.4
                            },
                            {
                                label: 'Lượt xem',
                                data: [350, 420, 380, 520, 490, 580, 610, 680, 550, 470, 510],
                                borderColor: '#f97316',
                                backgroundColor: 'rgba(249,115,22,0.1)',
                                fill: true, tension: 0.4
                            }
                        ]
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
            <div class="donut-wrap">
                <div class="donut">
                    <div class="donut-inner">
                        <div class="donut-pct">63.4%</div>
                        <div class="donut-sub">Đã chia sẻ</div>
                    </div>
                </div>
                <div style="margin-top:.6rem;font-size:.75rem;color:#64748b">Tổng số danh thiếp đã được chia sẻ</div>
                <div style="margin-top:.7rem">
                    <div class="legend-item">
                        <span><span class="legend-dot" style="background:#10b981"></span>Đã chia sẻ</span>
                        <strong>2.189 (63.4%)</strong>
                    </div>
                    <div class="legend-item">
                        <span><span class="legend-dot" style="background:#e2e8f0"></span>Chưa chia sẻ</span>
                        <strong>1.267 (36.6%)</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Table -->
    <div class="detail-table-card">
        <div class="dt-header">
            <div class="dt-title"><i class="fa-solid fa-table" style="color:#2563eb"></i> Thống kê chi tiết</div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Ngày</th>
                    <th>Người dùng mới</th>
                    <th>Danh thiếp tạo mới</th>
                    <th>Danh thiếp được chia sẻ</th>
                    <th>Lượt xem</th>
                    <th>Tỷ lệ chia sẻ</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dailyStats as $row)
                <tr>
                    <td style="font-weight:600;font-size:.83rem">{{ date('d/m/Y', strtotime($row->date)) }}</td>
                    <td style="font-size:.83rem">{{ number_format($row->cards_count * 0.4) }}</td> {{-- Simulated user count --}}
                    <td style="font-size:.83rem">{{ number_format($row->cards_count) }}</td>
                    <td style="font-size:.83rem">{{ number_format($row->cards_count * 0.7) }}</td> {{-- Simulated shared count --}}
                    <td style="font-size:.83rem">{{ number_format($row->views_count) }}</td>
                    <td>
                        <span style="font-size:.8rem;font-weight:700;color:#10b981">70%</span>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center;padding:2rem;color:#64748b">Không có dữ liệu cho khoảng thời gian này.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div style="padding: 1rem 1.3rem;">
            {{ $dailyStats->links('vendor.pagination.custom') }}
        </div>
    </div>
</x-admin-layout>
