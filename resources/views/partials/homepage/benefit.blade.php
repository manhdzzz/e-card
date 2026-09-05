{{-- BENEFIT SECTION --}}
<div class="e-benefit">
<div class="wrapper">
    <div class="uk-container uk-container-center">
        <div class="panel"><div class="wrapper">
            <div class="name"><h3><strong>Tính năng &amp; Lợi ích khi sử dụng ECard</strong></h3></div>
            <div class="description"></div>
        </div></div>
        <div class="grid">
            <div class="uk-grid uk-grid-medium uk-grid-width-1-1 uk-grid-width-medium-1-3 uk-grid-match" data-uk-grid-match="{target:'.item'}">
                @php $benefits = [
                    ['img'=>'https://cdn-icons-png.flaticon.com/128/1732/1732605.png','title'=>'Chia sẻ và kết nối không giới hạn','desc'=>'Chỉ bằng một cú chạm hoặc quét QR, bạn đã có thể trao đổi tất cả thông tin liên hệ, hồ sơ, video, hình ảnh, MXH. Nhanh, gọn, không giới hạn.'],
                    ['img'=>'https://cdn-icons-png.flaticon.com/128/2742/2742409.png','title'=>'Cập nhật dễ dàng','desc'=>'Bạn có thể chủ động tùy chỉnh giao diện, hình ảnh, liên kết, bố cục trên profile nhanh chóng, chính xác trong tích tắc không tốn chi phí in ấn lại.'],
                    ['img'=>'https://cdn-icons-png.flaticon.com/128/12773/12773678.png','title'=>'Ấn tượng chuyên nghiệp','desc'=>'Khách hàng sẽ ấn tượng khi bạn chia sẻ thông tin với giao diện Profile hiện đại tạo phong cách chuyên nghiệp tức thì.'],
                    ['img'=>'https://cdn-icons-png.flaticon.com/128/4412/4412281.png','title'=>'Thông tin luôn sẵn sàng','desc'=>'Không lo mất, quên danh thiếp hay thất lạc liên lạc, mọi dữ liệu luôn trong tầm tay.'],
                    ['img'=>asset('assets/images/benefit-nosignal.png'),'title'=>'Không tải ứng dụng','desc'=>'Hồ sơ Profile được xây dựng trên nền tảng web, cho phép đối tác truy cập và lưu danh bạ nhanh chóng mà không cần cài đặt ứng dụng.'],
                    ['img'=>'https://cdn-icons-png.flaticon.com/512/900/900784.png','title'=>'Thống kê truy cập','desc'=>'Bạn có thể thu thập số liệu thống kê về cách mọi người tương tác với danh thiếp kỹ thuật số của bạn.'],
                    ['img'=>'https://cdn-icons-png.flaticon.com/512/2355/2355760.png','title'=>'Tiếp thị liên kết','desc'=>'Dễ dàng Xây dựng mạng lưới bán hàng của riêng mình một cách nhanh chóng và hiệu quả với các sản phẩm của Ecard.'],
                    ['img'=>'https://cdn-icons-png.flaticon.com/128/3749/3749976.png','title'=>'Tiết kiệm chi phí & thân thiện môi trường','desc'=>'Loại bỏ chi phí in ấn, giảm lãng phí giấy với một danh thiếp NFC duy nhất.'],
                    ['img'=>'https://cdn-icons-png.flaticon.com/128/2818/2818153.png','title'=>'Tương tác nhanh chóng','desc'=>'Khách hàng dễ dàng gọi điện thoại, gửi email, xem website hoặc xem các thông tin sản phẩm của bạn ngay lập tức.'],
                ]; @endphp
                @foreach($benefits as $b)
                <div>
                    <div class="item">
                        <div class="uk-flex uk-flex-top">
                            <div><div class="image"><img src="{{ $b['img'] }}" alt="{{ $b['title'] }}" /></div></div>
                            <div><div class="body">
                                <div class="name"><strong>{{ $b['title'] }}</strong></div>
                                <div class="description"><p>{{ $b['desc'] }}</p></div>
                            </div></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="tool cta">
            <div class="uk-grid uk-grid-small">
                <div class="uk-width-1-1"><a href="#lead" class="register nowrap"><span>Đăng ký trải nghiệm</span><i class="ti ti-arrow-right"></i></a></div>
            </div>
        </div>
    </div>
</div>
</div>
