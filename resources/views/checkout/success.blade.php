<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Đặt hàng thành công - ECard.vn</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @php
        $logo = \App\Models\SiteSetting::get('site_logo');
        $faviconUrl = $logo ? (\Illuminate\Support\Str::startsWith($logo, ['http://', 'https://']) ? $logo : asset($logo)) : asset('assets/images/favicon.png');
    @endphp
    <link href="{{ $faviconUrl }}" rel="icon" type="image/png" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.5/css/uikit.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.47.0/tabler-icons.min.css" rel="stylesheet" />
    <link href="{{ asset('css/bootstrap-ecard.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/ecard-original.css') }}" rel="stylesheet" />
</head>
<body>
    @include('partials.header')

    <div class="e-page" style="padding: 100px 0; text-align: center;">
        <div class="uk-container uk-container-center">
            <div style="max-width: 600px; margin: 0 auto; background: #fff; padding: 50px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                <div style="font-size: 80px; color: #2ecc71; margin-bottom: 20px;">
                    <i class="ti ti-circle-check"></i>
                </div>
                <h1 style="font-weight: bold; color: #052542;">ĐẶT HÀNG THÀNH CÔNG!</h1>
                <p style="font-size: 1.2em; color: #666; margin-bottom: 30px;">
                    Cảm ơn <strong>{{ $order->recipient_name }}</strong>. Đơn hàng <strong>#{{ $order->id }}</strong> của bạn đã được tiếp nhận.<br>
                    Chúng tôi đã gửi email xác nhận về địa chỉ <strong>{{ $order->email }}</strong>.
                </p>
                <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 20px; text-align: left;">
                    <p style="margin-bottom: 10px; border-bottom: 1px solid #ddd; padding-bottom: 5px;"><strong>Thông tin đơn hàng:</strong></p>
                    <ul class="uk-list" style="margin-bottom: 0;">
                        <li>Họ tên: {{ $order->recipient_name }}</li>
                        <li>SĐT: {{ $order->phone }}</li>
                        <li>Địa chỉ: {{ $order->address }}</li>
                        <li>Thanh toán: <strong>{{ $order->payment_method == 'transfer' ? 'Chuyển khoản ngân hàng' : 'Thanh toán khi nhận hàng (COD)' }}</strong></li>
                        <li>Trạng thái: <span class="uk-badge uk-badge-warning">Đang chờ xử lý</span></li>
                    </ul>
                </div>

                @if($order->payment_method == 'transfer')
                <div style="background: #fffdf0; border: 1px solid #ffecb3; padding: 25px; border-radius: 12px; margin-bottom: 30px; text-align: center;">
                    <h3 style="color: #856404; font-weight: 800; margin-bottom: 15px; font-size: 1.1rem;">HƯỚNG DẪN THANH TOÁN CHUYỂN KHOẢN</h3>
                    
                    <div class="uk-grid uk-grid-small" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div style="background: white; padding: 15px; border-radius: 8px; border: 1px solid #eee; height: 100%; display: flex; align-items: center; justify-content: center;">
                                @php $qrCode = \App\Models\SiteSetting::get('payment_qr_code'); @endphp
                                @if($qrCode)
                                    <img src="{{ asset($qrCode) }}" alt="QR Code" style="max-width: 100%; border-radius: 5px;">
                                @else
                                    <div style="color: #999; font-size: .8rem; padding: 20px;">Quét mã QR để thanh toán</div>
                                @endif
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2" style="text-align: left;">
                            <ul class="uk-list" style="font-size: .95rem; line-height: 1.8;">
                                <li>Ngân hàng: <strong>{{ \App\Models\SiteSetting::get('payment_bank_name') }}</strong></li>
                                <li>Số tài khoản: <strong style="color: #d32f2f; font-size: 1.1rem;">{{ \App\Models\SiteSetting::get('payment_account_number') }}</strong></li>
                                <li>Chủ tài khoản: <strong>{{ \App\Models\SiteSetting::get('payment_account_name') }}</strong></li>
                                <li>Nội dung: <strong style="background: #fff3cd; padding: 2px 5px; border-radius: 3px;">{{ str_replace('[MADONHANG]', '#' . $order->id, \App\Models\SiteSetting::get('payment_transfer_content')) }}</strong></li>
                            </ul>
                            <p style="font-size: .75rem; color: #666; margin-top: 10px; font-style: italic;">* Vui lòng chuyển khoản đúng nội dung để chúng tôi xử lý đơn hàng nhanh nhất.</p>
                        </div>
                    </div>
                </div>
                @endif

                <a href="{{ url('/') }}" class="uk-button uk-button-primary" style="background:#052542; border-radius:30px; padding: 10px 30px;">
                    Quay lại trang chủ
                </a>
            </div>
        </div>
    </div>

    @include('partials.homepage.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.5/js/uikit.min.js"></script>
</body>
</html>
