<div class="e-top">
    <div class="wrapper">
        <div class="uk-container uk-container-center">
            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                <div><div class="tool left"><ul class="uk-list"><li><a href="tel:{{ \App\Models\SiteSetting::get('hotline') ?: '19006868' }}">Hotline: {{ \App\Models\SiteSetting::get('hotline') ?: '19006868' }}</a></li></ul></div></div>
                <div></div>
            </div>
        </div>
    </div>
</div>

<div class="e-header" data-uk-sticky="{top:-50, media:640}">
    <div class="wrapper">
        <div class="uk-container uk-container-center">
            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                <div>
                    <div class="uk-flex uk-flex-middle">
                        <div><div class="toggle uk-hidden-medium uk-hidden-large"><a href="#offcanvas" data-uk-offcanvas="{mode:'slide'}"><i class="ti ti-menu-2"></i></a></div></div>
                        <div>
                            <div class="brand" style="margin-right: 25px;">
                                <a href="{{ url('/') }}">
                                    @php
                                        $logo = \App\Models\SiteSetting::get('site_logo');
                                        $logoUrl = $logo ? (Str::startsWith($logo, ['http://', 'https://']) ? $logo : asset($logo)) : asset('assets/images/logo.png');
                                    @endphp
                                    <img src="{{ $logoUrl }}" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="uk-flex uk-flex-middle">
                        <div class="uk-hidden-small">
                            <div class="navbar">
                                <nav class="uk-navbar">
                                    <ul class="uk-navbar-nav">
                                        <li><a href="{{ url('/') }}">Trang chủ</a></li>
                                        <li><a href="{{ route('products.show', 'ecard-vip') }}">ECard VIP</a></li>
                                        <li><a href="{{ route('products.show', 'ecard-pro') }}">ECard Doanh Nghiệp</a></li>
                                        <li class="uk-parent" data-uk-dropdown><a href="#">Hướng dẫn <i class="ti ti-chevron-down"></i></a>
                                            <div class="uk-dropdown uk-dropdown-navbar">
                                                <ul class="uk-nav uk-nav-navbar">
                                                    <li><a href="{{ route('knowledge.show', 'huong-dan-cap-nhat-thong-tin') }}">Hướng dẫn cập nhật Danh thiếp Online Profile</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div>
                            <div class="tool right">
                                <ul class="uk-list">
                                    <li class="cart"><a href="{{ route('checkout.index') }}"><i class="ti ti-shopping-bag"></i><span>Giỏ hàng</span></a></li>
                                    @auth
                                    <li class="user" style="position: relative;" data-uk-dropdown="{mode:'click', pos:'bottom-right'}">
                                        <a href="javascript:void(0)"><i class="ti ti-user"></i><span>{{ Auth::user()->name }} <i class="ti ti-chevron-down" style="font-size: 10px;"></i></span></a>
                                        <div class="uk-dropdown uk-dropdown-small" style="padding: 10px; border-radius: 8px;">
                                            <ul class="uk-nav uk-nav-dropdown">
                                                <li><a href="{{ url('/dashboard') }}"><i class="ti ti-dashboard" style="margin-right: 5px;"></i> Bảng điều khiển</a></li>
                                                <li><a href="{{ route('orders.index') }}"><i class="ti ti-shopping-cart" style="margin-right: 5px;"></i> Lịch sử đơn hàng</a></li>
                                                <li><a href="{{ route('profile.edit') }}"><i class="ti ti-user" style="margin-right: 5px;"></i> Hồ sơ cá nhân</a></li>
                                                @if(Auth::user()->role === 'enterprise_admin')
                                                <li class="uk-nav-divider"></li>
                                                <li><a href="{{ route('enterprise.dashboard') }}" style="color: #052542; font-weight: 700;"><i class="ti ti-building" style="margin-right: 5px;"></i> Quản lý Doanh nghiệp</a></li>
                                                @endif
                                                @if(Auth::user()->role === 'admin')
                                                <li class="uk-nav-divider"></li>
                                                <li><a href="{{ route('admin.dashboard') }}" style="color: #052542; font-weight: 700;"><i class="ti ti-shield-lock" style="margin-right: 5px;"></i> Quản trị hệ thống</a></li>
                                                @endif
                                                <li class="uk-nav-divider"></li>
                                                <li>
                                                    <form action="{{ route('logout') }}" method="POST">
                                                        @csrf
                                                        <button type="submit" style="background: none; border: none; padding: 5px 15px; color: #e53935; cursor: pointer; width: 100%; text-align: left; font-weight: 600;">
                                                            <i class="ti ti-logout" style="margin-right: 5px;"></i> Đăng xuất
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    @else
                                    <li class="user"><a href="{{ route('login') }}"><i class="ti ti-user"></i><span>Đăng nhập</span></a></li>
                                    @endauth
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
