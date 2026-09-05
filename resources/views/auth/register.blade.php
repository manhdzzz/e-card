<x-guest-layout>
<div style="width:100%;max-width:900px">
    <div style="text-align:center;margin-bottom:2rem">
        <h1 style="color: var(--e-gold); font-size: 2rem; font-weight: 900; text-transform: uppercase;">Đăng ký tài khoản</h1>
        <p style="font-size: 1rem; color: rgba(255,255,255,0.7); margin-top: .5rem;">Điền thông tin để bắt đầu trải nghiệm danh thiếp điện tử chuyên nghiệp</p>
    </div>

    <div style="background: #fff; padding: 2.5rem; border-radius: 12px; color: #000; box-shadow: 0 15px 50px rgba(0,0,0,0.3);">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul style="margin:0; padding-left: 1.2rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Account Type Selection --}}
            <div style="display: flex; gap: 1rem; margin-bottom: 2rem; background: #f1f5f9; padding: .5rem; border-radius: 10px;">
                <label style="flex: 1; text-align: center; padding: .8rem; border-radius: 8px; cursor: pointer; transition: .2s; font-weight: 700; font-size: .9rem;" id="label_personal">
                    <input type="radio" name="account_type" value="personal" checked style="display: none;" onchange="toggleAccountType('personal')">
                    <i class="ti ti-user" style="margin-right: 5px;"></i> Cá nhân
                </label>
                <label style="flex: 1; text-align: center; padding: .8rem; border-radius: 8px; cursor: pointer; transition: .2s; font-weight: 700; font-size: .9rem;" id="label_enterprise">
                    <input type="radio" name="account_type" value="enterprise" style="display: none;" onchange="toggleAccountType('enterprise')">
                    <i class="ti ti-building" style="margin-right: 5px;"></i> Doanh nghiệp
                </label>
            </div>

            {{-- Section: Enterprise Info (Hidden by default) --}}
            <div id="enterprise_section" style="display: none; margin-bottom: 2rem;">
                <div style="border-left: 4px solid var(--e-gold); padding-left: 15px; font-size: 1.1rem; font-weight: 700; margin-bottom: 1.5rem; color: var(--e-navy);">
                    Thông tin Doanh nghiệp
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label class="form-label">Tên doanh nghiệp <span style="color:var(--e-gold)">(*)</span></label>
                        <input type="text" name="company_name" value="{{ old('company_name') }}" placeholder="Công ty TNHH ABC" class="form-control no-icon">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Mã số thuế</label>
                        <input type="text" name="tax_code" value="{{ old('tax_code') }}" placeholder="Mã số thuế" class="form-control no-icon">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Địa chỉ trụ sở</label>
                        <input type="text" name="company_address" value="{{ old('company_address') }}" placeholder="Địa chỉ công ty" class="form-control no-icon">
                    </div>
                    <div class="form-group">
                        <label class="form-label">SĐT Doanh nghiệp</label>
                        <input type="text" name="company_phone" value="{{ old('company_phone') }}" placeholder="Số điện thoại công ty" class="form-control no-icon">
                    </div>
                </div>
            </div>

            {{-- Section: Account Info --}}
            <div style="border-left: 4px solid var(--e-navy); padding-left: 15px; font-size: 1.1rem; font-weight: 700; margin-bottom: 1.5rem; color: var(--e-navy);">
                Thông tin quản lý tài khoản
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">Số điện thoại <span style="color:var(--e-gold)">(*)</span></label>
                    <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Số điện thoại" required class="form-control no-icon">
                </div>
                <div class="form-group">
                    <label class="form-label">Địa chỉ Email <span style="color:var(--e-gold)">(*)</span></label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="email@example.com" required class="form-control no-icon">
                </div>
                <div class="form-group">
                    <label class="form-label">Mật khẩu <span style="color:var(--e-gold)">(*)</span></label>
                    <div class="input-wrap">
                        <input type="password" name="password" id="reg_pw" required class="form-control no-icon" placeholder="Nhập mật khẩu">
                        <button type="button" class="toggle-pw" onclick="toggleRegPw('reg_pw','reg_pw_icon')">
                            <i class="fa-regular fa-eye-slash" id="reg_pw_icon"></i>
                        </button>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Xác nhận mật khẩu <span style="color:var(--e-gold)">(*)</span></label>
                    <div class="input-wrap">
                        <input type="password" name="password_confirmation" id="reg_pw2" required class="form-control no-icon" placeholder="Nhập lại mật khẩu">
                        <button type="button" class="toggle-pw" onclick="toggleRegPw('reg_pw2','reg_pw2_icon')">
                            <i class="fa-regular fa-eye-slash" id="reg_pw2_icon"></i>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Section: Card Info --}}
            <div style="border-left: 4px solid var(--e-navy); padding-left: 15px; font-size: 1.1rem; font-weight: 700; margin: 2rem 0 1.5rem; color: var(--e-navy);">
                Thông tin hiển thị trên danh thiếp
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">Tên đầy đủ <span style="color:var(--e-gold)">(*)</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Nguyễn Văn An" required class="form-control no-icon">
                </div>
                <div class="form-group">
                    <label class="form-label">Thương hiệu cá nhân</label>
                    <input type="text" name="brandname" value="{{ old('brandname') }}" placeholder="Tùy chọn" class="form-control no-icon">
                </div>
                <div class="form-group">
                    <label class="form-label">Chức danh <span style="color:var(--e-gold)">(*)</span></label>
                    <input type="text" name="job" value="{{ old('job') }}" placeholder="Giám đốc kinh doanh" required class="form-control no-icon">
                </div>
                <div class="form-group">
                    <label class="form-label">Doanh nghiệp <span style="color:var(--e-gold)">(*)</span></label>
                    <input type="text" name="company" value="{{ old('company') }}" placeholder="Công ty TNHH ABC" required class="form-control no-icon">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Giới thiệu bản thân <span style="color:var(--e-gold)">(*)</span></label>
                <textarea name="introduce" rows="3" placeholder="Mô tả ngắn về bạn..." required class="form-control no-icon" style="padding:.7rem 1rem;resize:vertical;">{{ old('introduce') }}</textarea>
            </div>

            <div style="margin-top: 2rem;">
                <button type="submit" class="guest-btn-primary">
                    <i class="ti ti-plus"></i> <strong>ĐĂNG KÝ TÀI KHOẢN</strong>
                </button>
            </div>
        </form>

        <div style="text-align: center; margin-top: 1.5rem;">
            <p style="font-size: .9rem; color: #64748b;">Đã có tài khoản? <a href="{{ route('login') }}" style="color: var(--e-navy); font-weight: 700; text-decoration: none;">Đăng nhập ngay</a></p>
        </div>
    </div>
</div>

<script>
function toggleAccountType(type) {
    const enterpriseSection = document.getElementById('enterprise_section');
    const labelPersonal = document.getElementById('label_personal');
    const labelEnterprise = document.getElementById('label_enterprise');

    if (type === 'enterprise') {
        enterpriseSection.style.display = 'block';
        labelEnterprise.style.background = 'var(--e-navy)';
        labelEnterprise.style.color = 'white';
        labelPersonal.style.background = 'transparent';
        labelPersonal.style.color = '#475569';
        
        // Make company name required if enterprise
        document.getElementsByName('company_name')[0].required = true;
    } else {
        enterpriseSection.style.display = 'none';
        labelPersonal.style.background = 'var(--e-navy)';
        labelPersonal.style.color = 'white';
        labelEnterprise.style.background = 'transparent';
        labelEnterprise.style.color = '#475569';
        
        document.getElementsByName('company_name')[0].required = false;
    }
}

// Initialize on load
document.addEventListener('DOMContentLoaded', () => {
    toggleAccountType('personal');
});

function toggleRegPw(inputId, iconId) {
    const pw = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
    if (pw.type === 'password') {
        pw.type = 'text';
        icon.className = 'fa-regular fa-eye';
    } else {
        pw.type = 'password';
        icon.className = 'fa-regular fa-eye-slash';
    }
}
</script>
</x-guest-layout>
