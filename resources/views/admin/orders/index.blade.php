<x-admin-layout>
<div class="admin-container" style="padding: 1rem 0;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem;">
        <h1 style="font-size:1.5rem; font-weight:800; color:#001529; margin:0;">
            <i class="fa-solid fa-cart-shopping" style="margin-right:.5rem;"></i> Quản lý đơn hàng
        </h1>
    </div>

    <!-- Filter Bar -->
    <form action="{{ route('admin.orders.index') }}" method="GET" style="background:#fff; border-radius:12px; border:1px solid #e2e8f0; padding:1.2rem; margin-bottom:1.5rem; display:flex; flex-wrap:wrap; gap:1rem; align-items:flex-end;">
        <div style="flex:1; min-width:200px;">
            <label style="display:block; font-size:.75rem; font-weight:700; color:#64748b; margin-bottom:.4rem; text-transform:uppercase;">Tìm kiếm</label>
            <div style="position:relative;">
                <i class="fa-solid fa-magnifying-glass" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#94a3b8; font-size:.85rem;"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Mã đơn, tên khách..." style="width:100%; padding:.55rem .8rem .55rem 2.3rem; border:1.5px solid #e2e8f0; border-radius:8px; font-size:.85rem; outline:none;">
            </div>
        </div>
        <div>
            <label style="display:block; font-size:.75rem; font-weight:700; color:#64748b; margin-bottom:.4rem; text-transform:uppercase;">Trạng thái</label>
            <select name="status" style="padding:.55rem .8rem; border:1.5px solid #e2e8f0; border-radius:8px; font-size:.85rem; outline:none; background:white; min-width:140px;">
                <option value="all">Tất cả</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Đang giao</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
            </select>
        </div>
        <div>
            <label style="display:block; font-size:.75rem; font-weight:700; color:#64748b; margin-bottom:.4rem; text-transform:uppercase;">Từ ngày</label>
            <input type="date" name="start_date" value="{{ request('start_date') }}" style="padding:.5rem .8rem; border:1.5px solid #e2e8f0; border-radius:8px; font-size:.85rem; outline:none;">
        </div>
        <div>
            <label style="display:block; font-size:.75rem; font-weight:700; color:#64748b; margin-bottom:.4rem; text-transform:uppercase;">Đến ngày</label>
            <input type="date" name="end_date" value="{{ request('end_date') }}" style="padding:.5rem .8rem; border:1.5px solid #e2e8f0; border-radius:8px; font-size:.85rem; outline:none;">
        </div>
        <div style="display:flex; gap:.5rem;">
            <button type="submit" class="btn btn-primary" style="padding:.6rem 1.2rem;"><i class="fa-solid fa-magnifying-glass"></i> Lọc</button>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-gray" style="padding:.6rem 1.2rem;"><i class="fa-solid fa-rotate"></i></a>
        </div>
    </form>

    <div class="card" style="background:#fff; border-radius:12px; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1); overflow:hidden;">
        <table style="width:100%; border-collapse:collapse; text-align:left;">
            <thead>
                <tr style="background:#f8fafc; border-bottom:1px solid #e2e8f0;">
                    <th style="padding:1rem; font-size:.7rem; font-weight:700; color:#64748b; text-transform:uppercase;">ID</th>
                    <th style="padding:1rem; font-size:.7rem; font-weight:700; color:#64748b; text-transform:uppercase;">Khách hàng</th>
                    <th style="padding:1rem; font-size:.7rem; font-weight:700; color:#64748b; text-transform:uppercase;">Ngày đặt</th>
                    <th style="padding:1rem; font-size:.7rem; font-weight:700; color:#64748b; text-transform:uppercase;">Trạng thái</th>
                    <th style="padding:1rem; font-size:.7rem; font-weight:700; color:#64748b; text-transform:uppercase;">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr style="border-bottom:1px solid #f1f5f9;">
                    <td style="padding:1rem; font-size:.85rem; color:#1e293b;">#{{ $order->id }}</td>
                    <td style="padding:1rem;">
                        <div style="font-weight:600; color:#1e293b;">{{ $order->recipient_name }}</div>
                        <div style="font-size:.75rem; color:#64748b;">{{ $order->phone }}</div>
                    </td>
                    <td style="padding:1rem; font-size:.85rem; color:#64748b;">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td style="padding:1rem;">
                        @php
                            $statusColors = [
                                'pending' => ['bg' => '#fef3c7', 'text' => '#92400e'],
                                'processing' => ['bg' => '#dbeafe', 'text' => '#1e40af'],
                                'shipped' => ['bg' => '#e0e7ff', 'text' => '#3730a3'],
                                'completed' => ['bg' => '#dcfce7', 'text' => '#166534'],
                                'cancelled' => ['bg' => '#fee2e2', 'text' => '#991b1b'],
                            ];
                            $color = $statusColors[$order->status] ?? ['bg' => '#f1f5f9', 'text' => '#475569'];
                        @endphp
                        <span style="padding:.25rem .75rem; border-radius:9999px; font-size:.7rem; font-weight:600; background:{{ $color['bg'] }}; color:{{ $color['text'] }}; text-transform:uppercase;">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td style="padding:1rem;">
                        <div style="display:flex; gap:.5rem;">
                            <a href="{{ route('admin.orders.show', $order->id) }}" style="padding:.4rem; border-radius:6px; background:#f1f5f9; color:#475569;" title="Xem chi tiết"><i class="fa-solid fa-eye"></i></a>
                            
                            @if($order->status === 'pending')
                                <button type="button" onclick="openCancelModal({{ $order->id }})" style="padding:.4rem; border-radius:6px; background:#fee2e2; color:#ef4444; border:none; cursor:pointer;" title="Hủy đơn"><i class="fa-solid fa-xmark"></i></button>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div style="padding: 1rem 1.3rem;">
        {{ $orders->links('vendor.pagination.custom') }}
    </div>
    </div>
</div>

<!-- Cancel Reason Modal -->
<div id="modal-cancel-reason" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:9999; align-items:center; justify-content:center;">
    <div style="background:white; width:100%; max-width:500px; border-radius:12px; overflow:hidden; box-shadow:0 20px 25px -5px rgba(0,0,0,0.1);">
        <div style="padding:1.5rem; border-bottom:1px solid #e2e8f0; display:flex; justify-content:space-between; align-items:center;">
            <h3 style="font-weight: 800; color: #b91c1c; margin:0; font-size:1.1rem;">Hủy đơn hàng</h3>
            <button type="button" onclick="closeCancelModal()" style="background:none; border:none; cursor:pointer; color:#64748b; font-size:1.2rem;"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <form id="cancel-form" action="" method="POST" style="padding:1.5rem;">
            @csrf
            <input type="hidden" name="status" value="cancelled">
            <div style="margin-bottom:1.5rem;">
                <label style="font-weight: 700; margin-bottom: .5rem; display: block; font-size:.85rem; color:#1e293b;">Lý do hủy đơn (*)</label>
                <textarea name="cancel_reason" style="width:100%; border:1px solid #e2e8f0; border-radius:8px; padding:.75rem; font-size:.9rem;" rows="4" placeholder="Nhập lý do hủy đơn hàng này..." required></textarea>
            </div>
            <div style="display:flex; justify-content:flex-end; gap:.75rem;">
                <button type="button" onclick="closeCancelModal()" class="btn btn-gray">Hủy bỏ</button>
                <button type="submit" class="btn btn-danger">XÁC NHẬN HỦY</button>
            </div>
        </form>
    </div>
</div>

<script>
function openCancelModal(orderId) {
    const modal = document.getElementById('modal-cancel-reason');
    const form = document.getElementById('cancel-form');
    form.action = `/admin/orders/${orderId}/status`;
    modal.style.display = 'flex';
}

function closeCancelModal() {
    document.getElementById('modal-cancel-reason').style.display = 'none';
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('modal-cancel-reason');
    if (event.target == modal) {
        closeCancelModal();
    }
}
</script>
</x-admin-layout>
