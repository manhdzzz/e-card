<x-app-layout>
    <x-slot name="title">Lịch sử đặt hàng</x-slot>

    @push('styles')
    <style>
        .page-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:1.5rem; }
        .page-title { font-size:1.5rem; font-weight:800; color:var(--e-navy); }
        .page-subtitle { font-size:.85rem; color:#64748b; margin-top:.15rem; }
        
        .orders-table { width: 100%; border-collapse: collapse; background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.02); border: 1px solid #e2e8f0; }
        .orders-table th { background: #f8fafc; padding: 1rem; text-align: left; font-size: .85rem; color: #475569; text-transform: uppercase; font-weight: 700; border-bottom: 1px solid #e2e8f0; }
        .orders-table td { padding: 1rem; border-bottom: 1px solid #f1f5f9; font-size: .9rem; color: #1e293b; vertical-align: middle; }
        .orders-table tr:last-child td { border-bottom: none; }
        .orders-table tr:hover { background: #f8faff; }
        
        .status-badge { display: inline-flex; align-items: center; gap: .3rem; padding: .3rem .8rem; border-radius: 20px; font-size: .75rem; font-weight: 700; }
        .status-pending { background: #fff7ed; color: #c2410c; border: 1px solid #ffedd5; }
        .status-shipped { background: #eff6ff; color: #1d4ed8; border: 1px solid #dbeafe; }
        .status-completed { background: #f0fdf4; color: #15803d; border: 1px solid #dcfce7; }
        .status-cancelled { background: #fef2f2; color: #b91c1c; border: 1px solid #fee2e2; }
        
        .empty-orders { background: white; border: 2px dashed #cbd5e1; border-radius: 14px; padding: 4rem; text-align: center; }
        .empty-orders i { font-size: 3.5rem; color: #94a3b8; margin-bottom: 1rem; }
        .empty-orders h3 { margin: 0; font-size: 1.2rem; font-weight: 800; color: #1e293b; }
        .empty-orders p { margin: .5rem 0 1.5rem 0; color: #64748b; font-size: .9rem; }
        
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; font-weight: 700; border-radius: 8px; transition: 0.2s; text-decoration: none !important; cursor: pointer; border: none; padding: .6rem 1.2rem; }
        .btn-primary { background: var(--e-gold) !important; color: #000 !important; }
        .btn-primary:hover { background: #e6ae00 !important; color: #000 !important; }
    </style>
    @endpush

    <div class="page-header">
        <div>
            <h1 class="page-title">Lịch sử đặt hàng</h1>
            <p class="page-subtitle">Theo dõi trạng thái các đơn đặt làm thẻ danh thiếp vật lý của bạn.</p>
        </div>
        <a href="{{ route('checkout.index') }}" class="btn btn-primary">
            <i class="ti ti-shopping-cart-plus"></i> Đặt thẻ mới
        </a>
    </div>

    @if($orders->isEmpty())
    <div class="empty-orders">
        <i class="ti ti-receipt-off"></i>
        <h3>Bạn chưa có đơn hàng nào</h3>
        <p>Hãy nâng cấp trải nghiệm với thẻ vật lý NFC thông minh của ECard.</p>
        <a href="{{ route('checkout.index') }}" class="btn btn-primary">Khám phá sản phẩm</a>
    </div>
    @else
    <div style="overflow-x: auto;">
        <table class="orders-table">
            <thead>
                <tr>
                    <th>Mã đơn</th>
                    <th>Người nhận</th>
                    <th>Ngày đặt</th>
                    <th>Phương thức</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td style="font-weight: 700; color: var(--e-navy);">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                    <td>
                        <div style="font-weight: 600;">{{ $order->recipient_name }}</div>
                        <div style="font-size: .8rem; color: #64748b; margin-top: .2rem;"><i class="ti ti-phone"></i> {{ $order->phone }}</div>
                    </td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        @if($order->payment_method == 'cod')
                            <span style="font-weight: 600;">COD</span> (Thanh toán khi nhận)
                        @else
                            <span style="font-weight: 600;">Chuyển khoản</span>
                        @endif
                    </td>
                    <td>
                        @if($order->status == 'pending')
                            <span class="status-badge status-pending"><i class="ti ti-clock"></i> Đang chờ xử lý</span>
                        @elseif($order->status == 'shipped')
                            <span class="status-badge status-shipped"><i class="ti ti-truck"></i> Đang giao hàng</span>
                        @elseif($order->status == 'completed')
                            <span class="status-badge status-completed"><i class="ti ti-check"></i> Hoàn thành</span>
                        @else
                            <span class="status-badge status-cancelled"><i class="ti ti-x"></i> Đã hủy</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</x-app-layout>
