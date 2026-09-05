<!DOCTYPE html>
<html id="home-index" lang="vi">
<head>
<title>ECard - Danh Thiếp Điện Tử Thông Minh</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="Danh thiếp điện tử thông minh, giải pháp namecard điện tử giúp bạn chia sẻ thông tin liên hệ nhanh chóng, chuyên nghiệp chỉ với một lần chạm NFC hoặc quét QR Code." />
@php
    $logo = \App\Models\SiteSetting::get('site_logo');
    $faviconUrl = $logo ? (Str::startsWith($logo, ['http://', 'https://']) ? $logo : asset($logo)) : asset('assets/images/favicon.png');
@endphp
<link href="{{ $faviconUrl }}" rel="icon" type="image/png" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.5/css/uikit.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.47.0/tabler-icons.min.css" rel="stylesheet" />
<link href="{{ asset('css/bootstrap-ecard.css') }}" rel="stylesheet" />
<link href="{{ asset('css/ecard-original.css') }}" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.5/js/uikit.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.5/js/components/slider.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.5/js/components/sticky.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.5/js/components/accordion.min.js"></script>
</head>
<body>
<div>
@include('partials.header')

{{-- HERO --}}
<div class="e-hero">
<div class="wrapper">
    <div class="uk-container uk-container-center">
        <div class="uk-grid uk-grid-medium">
            <div class="uk-width-medium-3-5">
                <div class="panel">
                    <div class="wrapper">
                        <div class="name"><h1>{{ \App\Models\SiteSetting::get('hero_title') ?: 'Danh Thiếp Điện Tử Thông Minh ECard - Cùng Bạn Xây Dựng Thương Hiệu Và Nuôi Dưỡng Mọi Kết Nối!' }}</h1></div>
                        <div class="description"><blockquote>
<p style="text-align: justify;">{{ \App\Models\SiteSetting::get('hero_desc') ?: 'Trong một thế giới ngày càng số hóa, việc sử dụng danh thiếp giấy truyền thống có thể khiến bạn bỏ lỡ cơ hội truyền tải thông tin liên hệ đầy đủ và chi tiết.' }}</p>
</blockquote></div>
                        <div class="tool cta">
                            <div class="uk-grid uk-grid-small">
                                <div class="uk-width-1-1 uk-width-medium-3-5"><a href="{{ route('checkout.index') }}" class="register nowrap"><span>Đăng ký làm thẻ</span><i class="ti ti-arrow-right"></i></a></div>
                                <div class="uk-width-1-1 uk-width-medium-2-5 mt10-small"><a href="#introduce" class="nowrap"><span>ECard là gì?</span><i class="ti ti-arrow-right"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-width-medium-2-5">
                <div class="media">
                    <div class="wrapper">
                        <div class="group">
                            <div class="phone">
                                <div class="overflow">
                                    <div class="scroll">
                                        <div class="image screen cover centertop"><img src="{{ \App\Models\SiteSetting::get('hero_screen') ?: asset('assets/images/hero-screen.png') }}" alt="screen" /></div>
                                        <div class="image profile cover centertop"><img src="{{ \App\Models\SiteSetting::get('hero_profile') ?: asset('assets/images/hero-profile.jpg') }}" alt="profile" /></div>
                                    </div>
                                </div>
                            </div>
                            <div class="image wave cover"><img src="{{ asset('assets/images/wave.png') }}" alt="Wave" /></div>
                            <div class="image card cover"><img src="{{ asset('assets/images/hero-card.png') }}" alt="card" /></div>
                            <div class="image qrcode cover"><img src="{{ asset('assets/images/hero-qrcode.png') }}" alt="qrcode" /></div>
                            <div class="image social p1"><img src="{{ asset('assets/images/social/facebook.png') }}" alt="facebook" /></div>
                            <div class="image social p2"><img src="{{ asset('assets/images/social/zalo.png') }}" alt="zalo" /></div>
                            <div class="image social p3"><img src="{{ asset('assets/images/social/youtube.png') }}" alt="youtube" /></div>
                            <div class="image social p4"><img src="{{ asset('assets/images/social/tiktok.png') }}" alt="tiktok" /></div>
                            <div class="image social p5"><img src="{{ asset('assets/images/social/instagram.png') }}" alt="instagram" /></div>
                            <div class="image social p6"><img src="{{ asset('assets/images/social/pinterest.png') }}" alt="pinterest" /></div>
                            <div class="image social p7"><img src="{{ asset('assets/images/social/linkedin.png') }}" alt="linkedin" /></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

{{-- INTRODUCE + PRODUCTS + SUPPORT + KNOWLEDGE --}}
<div id="introduce" class="e-introduce">
<div class="wrapper">
    <div class="uk-container uk-container-center">
        <div class="uk-grid uk-grid-medium">
            <div class="uk-width-medium-2-3">
                <div class="panel introduce">
                    <div class="wrapper">
                        <div class="name"><h2>Giới thiệu Danh thiếp điện tử ECard</h2></div>
                        <div class="description"><p><strong>ECard là thương hiệu hàng đầu về Card visit điện tử</strong>, giải pháp <strong>Namecard thông minh</strong> giúp bạn chia sẻ thông tin liên hệ một cách nhanh chóng, chuyên nghiệp chỉ với một lần chạm NFC hoặc quét QR Code.</p>
<blockquote><p>Với công nghệ QR-Code và NFC, ECard đã nâng tầm danh thiếp truyền thống, mọi thông tin liên hệ của bạn được truyền đi nhanh chóng và lưu lại dễ dàng trong điện thoại của đối tác.</p>
<p><strong>Hãy để ECard đồng hành cùng bạn trên hành trình tạo dựng dấu ấn riêng!</strong></p></blockquote></div>
                    </div>
                </div>

                {{-- PRODUCTS --}}
                @include('partials.homepage.products')

                <div class="tool cta">
                    <div class="uk-grid uk-grid-small">
                        <div class="uk-width-1-1 uk-width-medium-1-1"><a href="{{ route('checkout.index') }}" class="register nowrap"><span>Đăng ký làm thẻ</span><i class="ti ti-arrow-right"></i></a></div>
                    </div>
                </div>
            </div>

            {{-- SUPPORT + KNOWLEDGE SIDEBAR --}}
            <div class="uk-width-medium-1-3">
                <div class="panel support uk-hidden-small">
                    <div class="wrapper">
                        <div class="body">
                            <div class="name"><h3>Hỗ trợ khách hàng</h3></div>
                            <div class="description"><p>Nếu bạn chưa tìm thấy thông tin phù hợp, hãy liên hệ để chúng tôi hỗ trợ bạn nhé</p></div>
                            <div class="contact">
                                <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                    <div>
                                        <div class="uk-flex uk-flex-middle">
                                            <div><div class="image cover round avatar"><img src="{{ \App\Models\SiteSetting::get('support_avatar') ?: asset('assets/images/support-avatar.png') }}" /></div></div>
                                            <div><div class="description"><p><strong>{{ \App\Models\SiteSetting::get('support_name') ?: 'Hỗ trợ NALA' }}</strong><br />{{ \App\Models\SiteSetting::get('support_phone') ?: '19006868' }}</p></div></div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="tool right small">
                                            <ul class="uk-list">
                                                <li class="phone"><a href="tel:{{ \App\Models\SiteSetting::get('support_phone') ?: '19006868' }}"><img src="{{ asset('assets/images/hotline.svg') }}" alt="Hotline" /></a></li>
                                                <li class="zalo"><a href="{{ \App\Models\SiteSetting::get('support_zalo') ?: 'https://zalo.me/19006868' }}"><img src="{{ asset('assets/images/zalo.svg') }}" alt="Zalo" /></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel knowledge">
                    <div class="wrapper">
                        <div class="quote"><i class="ti ti-bulb"></i></div>
                        <div class="name"><h3>Bạn có biết</h3></div>
                        <div class="description"><blockquote><p style="text-align: justify;">Danh thiếp giấy đã tồn tại trong nhiều thế kỷ, nhưng với sự phát triển của internet và công nghệ thông tin, cách chúng ta kết nối và chia sẻ thông tin liên lạc đã hoàn toàn thay đổi.</p></blockquote>
<blockquote><p style="text-align: justify;">Dù từng là biểu tượng của sự chuyên nghiệp, danh thiếp giấy giờ đây đang gặp rất nhiều hạn chế trong việc truyền tải đa dạng thông tin liên hệ.</p></blockquote>
<p style="text-align: justify;">Chính vì vậy, ngày nay nhiều cá nhân và doanh nghiệp đang chuyển sang các giải pháp chia sẻ thông tin hiện đại hơn như danh thiếp NFC để nâng cao hiệu quả kết nối.</p></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@include('partials.homepage.work')
@include('partials.homepage.benefit')
@include('partials.homepage.lead')
@include('partials.homepage.feedback')
@include('partials.homepage.academy')
@include('partials.homepage.cooperate')
@include('partials.homepage.footer')

</div>
<script src="{{ asset('js/ecard-script.js') }}"></script>
</body>
</html>