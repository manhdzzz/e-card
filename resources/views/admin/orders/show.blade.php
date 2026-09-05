<x-admin-layout>
<div class="admin-container" style="padding: 1rem 0;">
    <div style="margin-bottom:2rem;">
        <a href="{{ route('admin.orders.index') }}" style="color:#64748b; text-decoration:none; font-size:.9rem;"><i class="fa-solid fa-arrow-left"></i> Quay lại danh sách</a>
        <h1 style="font-size:1.5rem; font-weight:800; color:#001529; margin-top:1rem;">
            Chi tiết đơn hàng #{{ $order->id }}
        </h1>
    </div>

    <div class="uk-grid uk-grid-medium">
        <div class="uk-width-medium-2-3">
            <div class="card" style="background:#fff; border-radius:12px; padding:2rem; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);">
                <h3 style="font-weight:700; margin-bottom:1.5rem; color:#1e293b;">Thông tin người mua</h3>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.5rem;">
                    <div>
                        <label style="font-size:.75rem; color:#64748b; font-weight:700; text-transform:uppercase;">Họ tên</label>
                        <div style="font-size:.9rem; color:#1e293b; margin-top:.25rem;">{{ $order->recipient_name }}</div>
                    </div>
                    <div>
                        <label style="font-size:.75rem; color:#64748b; font-weight:700; text-transform:uppercase;">Số điện thoại</label>
                        <div style="font-size:.9rem; color:#1e293b; margin-top:.25rem;">{{ $order->phone }}</div>
                    </div>
                    <div>
                        <label style="font-size:.75rem; color:#64748b; font-weight:700; text-transform:uppercase;">Email</label>
                        <div style="font-size:.9rem; color:#1e293b; margin-top:.25rem;">{{ $order->email }}</div>
                    </div>
                    <div>
                        <label style="font-size:.75rem; color:#64748b; font-weight:700; text-transform:uppercase;">Phương thức thanh toán</label>
                        <div style="font-size:.9rem; color:#1e293b; margin-top:.25rem;">{{ strtoupper($order->payment_method) }}</div>
                    </div>
                    <div style="grid-column: span 2;">
                        <label style="font-size:.75rem; color:#64748b; font-weight:700; text-transform:uppercase;">Địa chỉ giao hàng</label>
                        <div style="font-size:.9rem; color:#1e293b; margin-top:.25rem;">{{ $order->address }}</div>
                    </div>
                    <div style="grid-column: span 2;">
                        <label style="font-size:.75rem; color:#64748b; font-weight:700; text-transform:uppercase;">Ghi chú</label>
                        <div style="font-size:.9rem; color:#1e293b; margin-top:.25rem;">{{ $order->note ?: 'Không có' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-width-medium-1-3">
            <div class="card" style="background:#fff; border-radius:12px; padding:2rem; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);">
                <h3 style="font-weight:700; margin-bottom:1.5rem; color:#1e293b;">Trạng thái đơn hàng</h3>
                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                    @csrf
                    <div style="margin-bottom:1.5rem;">
                        <select name="status" id="order_status" style="width:100%; padding:.6rem; border:1px solid #e2e8f0; border-radius:8px; font-size:.85rem;" onchange="toggleCancelReason()">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Đang giao hàng</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                        </select>
                    </div>

                    <div id="cancel_reason_box" style="display: {{ $order->status == 'cancelled' ? 'block' : 'none' }}; margin-bottom:1.5rem;">
                        <label style="font-size:.75rem; color:#64748b; font-weight:700; text-transform:uppercase; display:block; margin-bottom:.4rem;">Lý do hủy đơn</label>
                        <textarea name="cancel_reason" style="width:100%; padding:.6rem; border:1px solid #e2e8f0; border-radius:8px; font-size:.85rem;" rows="3">{{ $order->cancel_reason }}</textarea>
                    </div>

                    <button type="submit" style="width:100%; padding:.8rem; background:#001529; color:#fff; border:none; border-radius:8px; font-weight:700; cursor:pointer;">
                        CẬP NHẬT TRẠNG THÁI
                    </button>
                </form>
                <p style="font-size:.75rem; color:#64748b; margin-top:1rem; line-height:1.4;">
                    <i class="fa-solid fa-circle-info"></i> Khi bạn cập nhật trạng thái, hệ thống sẽ tự động gửi email thông báo cho khách hàng.
                </p>
            </div>
        </div>
    </div>
</div>

<script>
function toggleCancelReason() {
    const status = document.getElementById('order_status').value;
    const box = document.getElementById('cancel_reason_box');
    box.style.display = status === 'cancelled' ? 'block' : 'none';
}
</script>
</x-admin-layout>
