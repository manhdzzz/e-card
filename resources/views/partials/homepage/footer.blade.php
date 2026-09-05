{{-- FOOTER --}}
<div class="e-footer">
<div class="wrapper">
    <div class="uk-container uk-container-center">
        <div class="uk-grid uk-grid-medium">
            <div class="uk-width-1-1 uk-width-medium-2-5">
                <div class="panel"><div class="wrapper"><div class="description">
<p><strong>THÔNG TIN LIÊN HỆ</strong></p>
<p><strong>{{ \App\Models\SiteSetting::get('company_name') ?: 'CTY CỔ PHẦN NALA GROUP' }}</strong></p>
<ul>
<li><strong>Văn phòng:</strong> {{ \App\Models\SiteSetting::get('address') ?: '54 phố Triều Khúc, quận Thanh Xuân, Hà Nội' }}</li>
<li><strong>Hotline:</strong> {{ \App\Models\SiteSetting::get('hotline') ?: '19006868' }}</li>
<li><strong>Email:</strong> {{ \App\Models\SiteSetting::get('email') ?: 'ecardnala@gmail.com' }}</li>
</ul>
                </div></div></div>
            </div>
            <div class="uk-width-1-1 uk-width-medium-2-5">
                <div id="sitelink" class="sitelink">
                    <div class="grid uk-hidden-small">
                        <div class="uk-grid uk-grid-medium uk-grid-width-1-1 uk-grid-width-medium-1-2">
                            <div><div class="panel"><div class="wrapper"><div class="description">
<p><strong>GIỚI THIỆU</strong></p>
<ul>
<li><a href="#">Giới thiệu ECard điện tử</a></li>
<li><a href="#">Hợp tác ECard Affiliate</a></li>
<li><a href="#">Liên hệ</a></li>
</ul>
<p><strong>SẢN PHẨM</strong></p>
<ul>
<li><a href="{{ route('products.show', 'ecard-vip') }}">ECard Vip - Danh thiếp chuyên nghiệp</a></li>
<li><a href="{{ route('products.show', 'ecard-pro') }}">ECard Pro - Danh thiếp doanh nghiệp</a></li>
</ul>
                            </div></div></div></div>
                            <div><div class="panel"><div class="wrapper"><div class="description">
<p><strong>CHÍNH SÁCH &amp; QUY ĐỊNH</strong></p>
<ul>
<li><a href="#">Hướng dẫn mua hàng</a></li>
<li><a href="#">Chính sách thanh toán</a></li>
<li><a href="#">Chính sách bảo mật</a></li>
<li><a href="#">Chính sách vận chuyển</a></li>
<li><a href="#">Chính sách bảo hành &amp; đổi trả</a></li>
</ul>
                            </div></div></div></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-width-1-1 uk-width-medium-1-5 mt15-small">
                <div class="panel"><div class="wrapper"><div class="panel"><div class="wrapper">
                    <div class="description"><strong>MẠNG XÃ HỘI</strong></div>
                    <div class="social">
                        <ul class="uk-list">
                            <li><a href="#"><i class="ti ti-brand-facebook"></i></a></li>
                            <li><a href="#"><i class="ti ti-brand-youtube"></i></a></li>
                            <li><a href="#"><i class="ti ti-brand-tiktok"></i></a></li>
                            <li><a href="#"><i class="ti ti-brand-x"></i></a></li>
                            <li><a href="#"><i class="ti ti-brand-instagram"></i></a></li>
                            <li><a href="#"><i class="ti ti-brand-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div></div></div></div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="e-copyright">
<div class="wrapper">
    <div class="uk-container uk-container-center">
        <div class="panel"><div class="wrapper"><div class="description">
            <p>Copyright &copy; {{ date('Y') }} - ECard NALA. All Rights Reserved.</p>
        </div></div></div>
    </div>
</div>
</div>
