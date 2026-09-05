<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Đặt hàng - ECard.vn</title>
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
    <style>
        .uk-form-label { 
            display: block !important; 
            margin-bottom: 8px !important; 
            font-weight: 700 !important; 
            color: #052542 !important;
            text-align: left !important;
        }
        .uk-form-row { margin-bottom: 20px; }
        input, select, textarea { 
            border-radius: 8px !important; 
            border: 1px solid #e2e8f0 !important; 
            padding: 10px 15px !important;
            height: auto !important;
        }
        input:focus { border-color: #ffc107 !important; outline: none; }
    </style>
</head>
<body>
    @include('partials.header')

    <div class="e-article-header" style="background: #f5f5f5; padding: 20px 0;">
        <div class="uk-container uk-container-center">
            <ul class="uk-breadcrumb">
                <li><a href="{{ url('/') }}">Trang chủ</a></li>
                <li class="uk-active"><span>Thanh toán / Đặt hàng</span></li>
            </ul>
        </div>
    </div>

    <div class="e-page" style="padding: 40px 0;">
        <div class="uk-container uk-container-center">
            <div class="uk-grid uk-grid-medium">
                <div class="uk-width-medium-2-3">
                    <div class="card" style="background:#fff; padding:30px; border-radius:10px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                        <h2 style="margin-bottom:25px; font-weight:bold; color:#052542; border-bottom:2px solid #eee; padding-bottom:10px;">Thông tin đặt hàng</h2>
                        
                        @if(session('error'))
                            <div class="uk-alert uk-alert-danger">{{ session('error') }}</div>
                        @endif

                        <form action="{{ route('checkout.store') }}" method="POST" class="uk-form uk-form-stacked">
                            @csrf
                            <div class="uk-grid uk-grid-small" data-uk-grid-margin>
                                <div class="uk-width-medium-1-2">
                                    <label class="uk-form-label">Người nhận hàng (*)</label>
                                    <input type="text" name="recipient_name" class="uk-width-1-1" placeholder="Họ và tên" required value="{{ old('recipient_name', auth()->check() ? auth()->user()->name : '') }}">
                                </div>
                                <div class="uk-width-medium-1-2">
                                    <label class="uk-form-label">Số điện thoại (*)</label>
                                    <input type="text" name="phone" class="uk-width-1-1" placeholder="Ví dụ: 0912345678" required value="{{ old('phone') }}">
                                </div>
                                <div class="uk-width-1-1" style="margin-top:15px;">
                                    <label class="uk-form-label">Địa chỉ email liên hệ (*)</label>
                                    <input type="email" name="email" class="uk-width-1-1" placeholder="Để nhận thông báo đơn hàng" required value="{{ old('email', auth()->check() ? auth()->user()->email : '') }}" {{ auth()->check() ? 'readonly style=background:#f5f5f5;' : '' }}>
                                    @if(auth()->check())
                                        <div style="font-size: .75rem; color: #64748b; margin-top: 5px;">* Đơn hàng sẽ được lưu vào lịch sử tài khoản của bạn.</div>
                                    @endif
                                </div>
                                <div class="uk-width-1-1 uk-form-row" style="margin-top:15px;">
                                    <label class="uk-form-label">Địa chỉ nhận hàng (*)</label>
                                    <textarea name="address" class="uk-width-1-1" rows="3" placeholder="Số nhà, tên đường, phường/xã, quận/huyện, tỉnh/thành phố" required>{{ old('address') }}</textarea>
                                </div>
                                <div class="uk-width-1-1 uk-form-row" style="margin-top:15px;">
                                    <label class="uk-form-label">Phương thức thanh toán (*)</label>
                                    <select name="payment_method" class="uk-width-1-1" required>
                                        <option value="cod" {{ old('payment_method') == 'cod' ? 'selected' : '' }}>Thanh toán khi nhận hàng (COD)</option>
                                        <option value="transfer" {{ old('payment_method') == 'transfer' ? 'selected' : '' }}>Chuyển khoản ngân hàng</option>
                                    </select>
                                </div>
                                <div class="uk-width-1-1 uk-form-row" style="margin-top:15px;">
                                    <label class="uk-form-label">Ghi chú cho người bán</label>
                                    <textarea name="note" class="uk-width-1-1" rows="2" placeholder="Ví dụ: Giao vào giờ hành chính...">{{ old('note') }}</textarea>
                                </div>
                            </div>

                            <div style="margin-top:30px;">
                                <button type="submit" class="uk-button uk-button-primary uk-button-large uk-width-1-1" style="background:#052542; border-radius:30px; font-weight:bold;">
                                    XÁC NHẬN ĐẶT MUA
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="uk-width-medium-1-3">
                    <div class="card" style="background:#f9f9f9; padding:20px; border-radius:10px; border:1px dashed #ccc;">
                        <h3 style="font-weight:bold;">Tóm tắt đơn hàng</h3>
                        <p style="color:#666; font-size:0.9em;">Bạn đang đăng ký làm thẻ danh thiếp điện tử thông minh ECard.</p>
                        <hr>
                        <div class="uk-flex uk-flex-space-between">
                            <span>Sản phẩm:</span>
                            <strong>Danh thiếp ECard</strong>
                        </div>
                        <div class="uk-flex uk-flex-space-between" style="margin-top:10px;">
                            <span>Phí dịch vụ:</span>
                            <strong>Theo gói đã chọn</strong>
                        </div>
                        <hr>
                        <p style="font-size:0.8em; color:#999;">(*) Sau khi đặt hàng, nhân viên sẽ liên hệ lại để xác nhận gói cước và thiết kế.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.homepage.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.5/js/uikit.min.js"></script>
</body>
</html>
