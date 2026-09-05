<x-enterprise-layout>
    <x-slot name="title">Thống kê chi tiết</x-slot>

    <div class="breadcrumb">
        <a href="{{ route('enterprise.dashboard') }}">Doanh nghiệp</a><span>/</span>
        <span>Thống kê</span>
    </div>

    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 2rem;">
        <div>
            <h1 style="font-size: 1.5rem; font-weight: 800; color: var(--e-navy);">Thống kê chi tiết</h1>
            <p style="font-size: .85rem; color: #64748b; margin-top: .15rem;">Phân tích hiệu quả sử dụng danh thiếp theo khoảng thời gian.</p>
        </div>
        
        <form action="{{ route('enterprise.statistics') }}" method="GET" style="display: flex; gap: .5rem; align-items: center; background: white; padding: .5rem; border-radius: 10px; border: 1px solid #e2e8f0;">
            <input type="date" name="start_date" value="{{ $stats['start_date'] }}" style="border: 1px solid #cbd5e1; border-radius: 6px; padding: .4rem; font-size: .85rem;">
            <span style="color: #64748b;">đến</span>
            <input type="date" name="end_date" value="{{ $stats['end_date'] }}" style="border: 1px solid #cbd5e1; border-radius: 6px; padding: .4rem; font-size: .85rem;">
            <button type="submit" class="btn btn-primary" style="padding: .45rem 1rem;">Lọc</button>
        </form>
    </div>

    {{-- Highlight Stats for the range --}}
    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem; margin-bottom: 2rem;">
        <div style="background: white; border-radius: 12px; padding: 2rem; border: 1px solid #e2e8f0; display: flex; align-items: center; gap: 1.5rem;">
            <div style="width: 60px; height: 60px; border-radius: 15px; background: #f0fdf4; color: #16a34a; display: flex; align-items: center; justify-content: center; font-size: 2rem;">
                <i class="ti ti-eye"></i>
            </div>
            <div>
                <div style="font-size: .85rem; color: #64748b; font-weight: 700; text-transform: uppercase; letter-spacing: .5px;">Lượt truy cập mới</div>
                <div style="font-size: 2.2rem; font-weight: 900; color: var(--e-navy);">{{ number_format($stats['view_count_range']) }}</div>
                <div style="font-size: .8rem; color: #64748b;">Trong khoảng thời gian đã chọn</div>
            </div>
        </div>
        <div style="background: white; border-radius: 12px; padding: 2rem; border: 1px solid #e2e8f0; display: flex; align-items: center; gap: 1.5rem;">
            <div style="width: 60px; height: 60px; border-radius: 15px; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center; font-size: 2rem;">
                <i class="ti ti-id-badge"></i>
            </div>
            <div>
                <div style="font-size: .85rem; color: #64748b; font-weight: 700; text-transform: uppercase; letter-spacing: .5px;">Danh thiếp mới</div>
                <div style="font-size: 2.2rem; font-weight: 900; color: var(--e-navy);">{{ number_format($stats['new_cards_range']) }}</div>
                <div style="font-size: .8rem; color: #64748b;">Trong khoảng thời gian đã chọn</div>
            </div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem;">
        <div style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 2rem;">
            <h2 style="font-size: 1.2rem; font-weight: 800; color: var(--e-navy); margin-bottom: 1.5rem;">Hiệu quả theo phòng ban</h2>
            <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                @forelse($stats['departments'] as $dept)
                @php
                    $maxEmployees = $stats['departments']->max('employees_count') ?: 1;
                    $percent = ($dept->employees_count / $maxEmployees) * 100;
                @endphp
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: .6rem;">
                        <span style="font-weight: 700; font-size: .95rem; color: #1e293b;">{{ $dept->name }}</span>
                        <span style="font-size: .85rem; color: #64748b; font-weight: 700;">{{ $dept->employees_count }} nhân viên</span>
                    </div>
                    <div style="height: 14px; background: #f1f5f9; border-radius: 10px; overflow: hidden;">
                        <div style="height: 100%; width: {{ $percent }}%; background: var(--e-navy); border-radius: 10px; transition: width 1s ease;"></div>
                    </div>
                </div>
                @empty
                <p style="color: #94a3b8; font-style: italic;">Chưa có dữ liệu phòng ban.</p>
                @endforelse
            </div>
        </div>

        <div style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 2rem;">
            <h2 style="font-size: 1.2rem; font-weight: 800; color: var(--e-navy); margin-bottom: 1.5rem;">Tổng quan hệ thống</h2>
            <div style="display: flex; flex-direction: column; gap: 1.2rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: .8rem; border-bottom: 1px solid #f1f5f9;">
                    <span style="color: #64748b; font-size: .9rem;">Tổng danh thiếp:</span>
                    <span style="font-weight: 800; color: var(--e-navy);">{{ number_format($stats['total_cards']) }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: .8rem; border-bottom: 1px solid #f1f5f9;">
                    <span style="color: #64748b; font-size: .9rem;">Đang hoạt động:</span>
                    <span style="font-weight: 800; color: #16a34a;">{{ number_format($stats['active_cards']) }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: .8rem; border-bottom: 1px solid #f1f5f9;">
                    <span style="color: #64748b; font-size: .9rem;">Tổng lượt xem (all time):</span>
                    <span style="font-weight: 800; color: #2563eb;">{{ number_format($stats['total_views']) }}</span>
                </div>
            </div>
            
            <div style="margin-top: 2rem; background: #f8fafc; border-radius: 10px; padding: 1rem; border: 1px dashed #cbd5e1;">
                <p style="font-size: .75rem; color: #64748b; line-height: 1.5; margin: 0;">
                    <i class="ti ti-info-circle"></i> Thống kê khoảng thời gian dựa trên các lượt truy cập và danh thiếp mới được tạo từ <strong>{{ date('d/m/Y', strtotime($stats['start_date'])) }}</strong> đến <strong>{{ date('d/m/Y', strtotime($stats['end_date'])) }}</strong>.
                </p>
            </div>
        </div>
    </div>
</x-enterprise-layout>
