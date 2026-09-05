@php
    $logo = \App\Models\SiteSetting::get('site_logo');
    $logoUrl = $logo ? (Str::startsWith($logo, ['http://', 'https://']) ? $logo : asset($logo)) : asset('assets/images/logo.png');
    $color = '#052542';
    $statusText = [
        'pending' => 'Đang chờ xử lý',
        'processing' => 'Đang chuẩn bị hàng',
        'shipped' => 'Đang giao hàng',
        'completed' => 'Đã hoàn thành',
        'cancelled' => 'Đã hủy'
    ];
@endphp

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f9f9f9; }
        .header { text-align: center; padding: 30px 0; background-color: #fff; border-radius: 10px 10px 0 0; }
        .logo { max-height: 60px; }
        .content { background-color: #fff; padding: 40px; border-radius: 0 0 10px 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
        .title { font-size: 24px; font-weight: bold; color: {{ $color }}; margin-bottom: 20px; text-align: center; }
        .status-badge { display: inline-block; padding: 6px 15px; border-radius: 20px; font-size: 14px; font-weight: bold; text-transform: uppercase; margin-bottom: 20px; }
        .status-pending { background-color: #fef3c7; color: #92400e; }
        .status-shipped { background-color: #dbeafe; color: #1e40af; }
        .status-completed { background-color: #dcfce7; color: #166534; }
        .status-cancelled { background-color: #fee2e2; color: #991b1b; }
        .info-box { background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px; margin-bottom: 25px; }
        .info-row { display: flex; margin-bottom: 10px; border-bottom: 1px solid #edf2f7; padding-bottom: 8px; }
        .info-row:last-child { border-bottom: none; }
        .info-label { width: 150px; font-weight: bold; color: #64748b; font-size: 14px; }
        .info-value { flex: 1; color: #1e293b; font-size: 14px; }
        .footer { text-align: center; padding: 30px 0; color: #94a3b8; font-size: 12px; }
        .button { display: inline-block; padding: 12px 30px; background-color: {{ $color }}; color: #fff; text-decoration: none; border-radius: 30px; font-weight: bold; margin-top: 20px; }
        .cancel-reason { color: #dc2626; font-style: italic; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ $logoUrl }}" alt="Logo" class="logo">
        </div>
        <div class="content">
            <div class="title">
                {{ $type === 'confirmation' ? 'Xác nhận đơn hàng thành công' : 'Cập nhật trạng thái đơn hàng' }}
            </div>
            
            <div style="text-align: center;">
                <span class="status-badge status-{{ $order->status }}">
                    {{ $statusText[$order->status] ?? $order->status }}
                </span>
            </div>

            <p>Chào <strong>{{ $order->recipient_name }}</strong>,</p>
            <p>
                {{ $type === 'confirmation' 
                    ? 'Cảm ơn bạn đã tin tưởng và đặt mua danh thiếp điện tử tại ECard.vn. Đơn hàng của bạn đã được tiếp nhận và đang trong quá trình xử lý.' 
                    : 'Chúng tôi xin thông báo trạng thái đơn hàng #' . $order->id . ' của bạn đã được cập nhật.' }}
            </p>

            <div class="info-box">
                <div class="info-row">
                    <div class="info-label">Mã đơn hàng</div>
                    <div class="info-value">#{{ $order->id }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Ngày đặt</div>
                    <div class="info-value">{{ $order->created_at->format('d/m/Y H:i') }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Địa chỉ nhận hàng</div>
                    <div class="info-value">{{ $order->address }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Số điện thoại</div>
                    <div class="info-value">{{ $order->phone }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Thanh toán</div>
                    <div class="info-value">{{ strtoupper($order->payment_method) }}</div>
                </div>
                @if($order->status === 'cancelled' && $order->cancel_reason)
                <div class="info-row">
                    <div class="info-label">Lý do hủy</div>
                    <div class="info-value" style="color:#ef4444;">{{ $order->cancel_reason }}</div>
                </div>
                @endif
            </div>

            @if($order->note)
            <div style="margin-bottom: 25px;">
                <strong>Ghi chú:</strong>
                <p style="font-size: 14px; color: #475569;">{{ $order->note }}</p>
            </div>
            @endif

            <div style="text-align: center;">
                <a href="{{ config('app.url') }}" class="button">Truy cập Website</a>
            </div>

            <p style="margin-top: 30px; font-size: 14px;">Nếu có bất kỳ thắc mắc nào, vui lòng liên hệ hotline: <strong>{{ \App\Models\SiteSetting::get('hotline') ?: '19006868' }}</strong></p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} ECard.vn - Công nghệ kết nối một chạm.<br>
            Địa chỉ: {{ \App\Models\SiteSetting::get('address') ?: 'Hà Nội, Việt Nam' }}
        </div>
    </div>
</body>
</html>
