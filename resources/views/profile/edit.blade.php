<x-app-layout>
    <x-slot name="title">Hồ sơ cá nhân</x-slot>

    @push('styles')
    <style>
        .pf-form-group { margin-bottom: 1.2rem; }
        .pf-form-label { display: block; font-weight: 700; color: var(--e-navy); margin-bottom: .5rem; font-size: .9rem; }
        .pf-form-input { width: 100%; border: 1px solid #d1d9e6; border-radius: 8px; padding: .6rem 1rem; font-size: .9rem; color: #1e293b; background: #fff; transition: .2s; box-sizing: border-box; }
        .pf-form-input:focus { border-color: var(--e-gold); outline: none; box-shadow: 0 0 0 3px rgba(255, 193, 7, 0.1); }
        .pf-error { color: #ef4444; font-size: .8rem; margin-top: .4rem; display: block; }
        .pf-btn { background: var(--e-navy); color: #fff; border: none; padding: .6rem 1.2rem; border-radius: 8px; font-weight: 700; cursor: pointer; transition: .2s; }
        .pf-btn:hover { background: #001026; }
        .pf-btn-danger { background: #fee2e2; color: #ef4444; border: none; padding: .6rem 1.2rem; border-radius: 8px; font-weight: 700; cursor: pointer; transition: .2s; }
        .pf-btn-danger:hover { background: #fecaca; }
        .pf-desc { font-size: .85rem; color: #64748b; margin-bottom: 1rem; line-height: 1.5; }
    </style>
    @endpush

    <div class="breadcrumb">
        <a href="{{ url('/') }}">Trang chủ</a>
        <span>/</span>
        <span>Hồ sơ cá nhân</span>
    </div>

    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 1.5rem; font-weight: 800; color: var(--e-navy); margin: 0;">Thiết lập tài khoản</h1>
        <p style="font-size: .85rem; color: #64748b; margin-top: .2rem;">Cập nhật thông tin cá nhân và bảo mật tài khoản của bạn</p>
    </div>

    <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
        <div class="uk-width-medium-1-1">
            <div class="card-custom" style="margin-bottom: 2rem;">
                <div style="max-width: 600px;">
                    <h3 style="font-weight: 700; color: var(--e-navy); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px;">
                        <i class="ti ti-user-circle" style="font-size: 1.4rem; color: var(--e-gold);"></i>
                        Thông tin cá nhân
                    </h3>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="card-custom" style="margin-bottom: 2rem;">
                <div style="max-width: 600px;">
                    <h3 style="font-weight: 700; color: var(--e-navy); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px;">
                        <i class="ti ti-lock" style="font-size: 1.4rem; color: var(--e-gold);"></i>
                        Đổi mật khẩu
                    </h3>
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="card-custom" style="border-color: #fee2e2; background: #fffcfc;">
                <div style="max-width: 600px;">
                    <h3 style="font-weight: 700; color: #b91c1c; margin-bottom: 1rem;">Xóa tài khoản</h3>
                    <p style="font-size: .85rem; color: #7f1d1d; margin-bottom: 1.5rem; opacity: 0.8;">
                        Cảnh báo: Một khi tài khoản bị xóa, tất cả dữ liệu (bao gồm các danh thiếp đã tạo) sẽ biến mất vĩnh viễn.
                    </p>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
