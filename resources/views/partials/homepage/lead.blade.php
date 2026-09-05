{{-- LEAD / REGISTRATION FORM SECTION --}}
<div id="lead" class="e-lead">
<div class="wrapper">
    <div class="image cover wave"><img src="{{ asset('assets/images/wave.png') }}" alt="Wave" /></div>
    <div class="uk-container uk-container-center">
        <div class="uk-grid uk-grid-medium">
            <div class="uk-width-medium-1-3">
                <div class="panel">
                    <div class="wrapper">
                        <div class="name"><h2>Đăng ký tạo tài khoản ECard</h2></div>
                        <div class="description"><p>Trải nghiệm ngay ECard – Danh thiếp điện tử thông minh giúp bạn kết nối nhanh chóng chỉ trong 1 chạm, bảo mật và cập nhật dễ dàng!</p>
                        <p><strong>Hướng dẫn đăng ký:</strong></p>
                        <ul>
                            <li><strong>Bước 1:</strong> Điền đầy đủ thông tin vào biểu mẫu.</li>
                            <li><strong>Bước 2:</strong> Thanh toán để kích hoạt dịch vụ.</li>
                            <li><strong>Bước 3:</strong> Cập nhật và hoàn thiện hồ sơ.</li>
                        </ul>
                        <p><strong>Hành động ngay bây giờ!</strong></p>
                        <p>Đăng ký ngay hôm nay để kết nối chuyên nghiệp!</p></div>
                    </div>
                </div>
                <div class="accordion uk-hidden-small">
                    <div class="uk-accordion" data-uk-accordion="{showfirst:false}">
                        <h3 class="uk-accordion-title" style="font-size:0.85rem;padding:8px"><strong>Thông tin quản lý tài khoản là gì?</strong></h3>
                        <div class="uk-accordion-content"><p style="font-size:0.8rem">Đây là thông tin dùng để đăng nhập và quản lý danh thiếp của bạn. Tài khoản là Số điện thoại hoặc Email.</p></div>
                        <h3 class="uk-accordion-title" style="font-size:0.85rem;padding:8px"><strong>Thông tin danh thiếp là gì?</strong></h3>
                        <div class="uk-accordion-content"><p style="font-size:0.8rem">Là thông tin cá nhân hiển thị trực tiếp trên danh thiếp điện tử của bạn khi đối tác quét mã.</p></div>
                    </div>
                </div>
            </div>
            <div class="uk-width-medium-2-3" style="position: relative; z-index: 10;">
                <div style="background: #fff; padding: 1.2rem 1.5rem; border-radius: 12px; color: #000; box-shadow: 0 15px 50px rgba(0,0,0,0.3); width: 100%; position: relative; z-index: 10;">
                    {{-- Error & Success Messages --}}
                    @if ($errors->any())
                        <div style="background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; padding: 0.8rem; border-radius: 8px; margin-bottom: 1rem; font-size: 0.8rem;">
                            <ul style="margin:0; padding-left: 1.2rem;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div style="background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; padding: 0.8rem; border-radius: 8px; margin-bottom: 1rem; font-size: 0.8rem;">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}" id="regForm">
                        @csrf
                        
                        {{-- Account Type Selection --}}
                        <div style="display: flex; gap: 0.8rem; margin-bottom: 1rem; background: #f1f5f9; padding: .3rem; border-radius: 10px;">
                            <label style="flex: 1; text-align: center; padding: 0.5rem; border-radius: 8px; cursor: pointer; transition: 0.2s; font-weight: 700; font-size: 0.8rem; background: var(--e-navy); color: white;" id="label_personal">
                                <input type="radio" name="account_type" value="personal" checked style="display: none;" onchange="toggleAccountType('personal')">
                                <i class="ti ti-user" style="margin-right: 5px;"></i> Cá nhân
                            </label>
                            <label style="flex: 1; text-align: center; padding: 0.5rem; border-radius: 8px; cursor: pointer; transition: 0.2s; font-weight: 700; font-size: 0.8rem; background: transparent; color: rgb(71, 85, 105);" id="label_enterprise">
                                <input type="radio" name="account_type" value="enterprise" style="display: none;" onchange="toggleAccountType('enterprise')">
                                <i class="ti ti-building" style="margin-right: 5px;"></i> Doanh nghiệp
                            </label>
                        </div>

                        {{-- Section: Enterprise Info --}}
                        <div id="enterprise_section" style="display: none; margin-bottom: 1rem;">
                            <div style="border-left: 4px solid var(--e-gold); padding-left: 10px; font-size: 0.9rem; font-weight: 700; margin-bottom: 0.8rem; color: var(--e-navy);">
                                Thông tin Doanh nghiệp
                            </div>
                            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 0.6rem;">
                                <div class="form-group">
                                    <label class="form-label">Tên doanh nghiệp <span style="color:var(--e-gold)">(*)</span></label>
                                    <input type="text" name="company_name" value="{{ old('company_name') }}" placeholder="Công ty ABC" class="form-control no-icon">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Mã số thuế</label>
                                    <input type="text" name="tax_code" value="{{ old('tax_code') }}" placeholder="MST" class="form-control no-icon">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Địa chỉ trụ sở</label>
                                    <input type="text" name="company_address" value="{{ old('company_address') }}" placeholder="Địa chỉ" class="form-control no-icon">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">SĐT Doanh nghiệp</label>
                                    <input type="text" name="company_phone" value="{{ old('company_phone') }}" placeholder="SĐT công ty" class="form-control no-icon">
                                </div>
                            </div>
                        </div>

                        {{-- Combined Info Grid --}}
                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.6rem;">
                            <div class="form-group">
                                <label class="form-label">Số điện thoại <span style="color:var(--e-gold)">(*)</span></label>
                                <input type="text" name="phone" value="{{ old('phone') }}" placeholder="SĐT" required class="form-control no-icon">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email <span style="color:var(--e-gold)">(*)</span></label>
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" required class="form-control no-icon">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Họ tên <span style="color:var(--e-gold)">(*)</span></label>
                                <input type="text" name="name" value="{{ old('name') }}" placeholder="Họ tên" required class="form-control no-icon">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Mật khẩu <span style="color:var(--e-gold)">(*)</span></label>
                                <div class="input-wrap">
                                    <input type="password" name="password" id="reg_pw" required class="form-control no-icon" placeholder="Mật khẩu">
                                    <button type="button" class="toggle-pw" onclick="toggleRegPw('reg_pw','reg_pw_icon')">
                                        <i class="fa-regular fa-eye-slash" id="reg_pw_icon"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Xác nhận <span style="color:var(--e-gold)">(*)</span></label>
                                <div class="input-wrap">
                                    <input type="password" name="password_confirmation" id="reg_pw2" required class="form-control no-icon" placeholder="Nhập lại">
                                    <button type="button" class="toggle-pw" onclick="toggleRegPw('reg_pw2','reg_pw2_icon')">
                                        <i class="fa-regular fa-eye-slash" id="reg_pw2_icon"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Chức danh <span style="color:var(--e-gold)">(*)</span></label>
                                <input type="text" name="job" value="{{ old('job') }}" placeholder="Chức danh" required class="form-control no-icon">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Thương hiệu</label>
                                <input type="text" name="brandname" value="{{ old('brandname') }}" placeholder="Tùy chọn" class="form-control no-icon">
                            </div>
                            <div class="form-group" style="grid-column: span 2;">
                                <label class="form-label">Doanh nghiệp <span style="color:var(--e-gold)">(*)</span></label>
                                <input type="text" name="company" value="{{ old('company') }}" placeholder="Tên công ty hiển thị" required class="form-control no-icon">
                            </div>
                        </div>

                        <div class="form-group" style="margin-top: 0.2rem;">
                            <label class="form-label">Giới thiệu ngắn <span style="color:var(--e-gold)">(*)</span></label>
                            <textarea name="introduce" rows="1" placeholder="Mô tả về bạn..." required class="form-control no-icon" style="padding:.4rem .7rem;resize:none;height:38px">{{ old('introduce') }}</textarea>
                        </div>

                        <div style="margin-top: 0.8rem;">
                            <button type="submit" class="guest-btn-primary">
                                <i class="ti ti-plus"></i> <strong>ĐĂNG KÝ TÀI KHOẢN NGAY</strong>
                            </button>
                        </div>
                    </form>

                    <div style="text-align: center; margin-top: 0.8rem;">
                        <p style="font-size: .8rem; color: #64748b;">Đã có tài khoản? <a href="{{ route('login') }}" style="color: var(--e-navy); font-weight: 700; text-decoration: none;">Đăng nhập ngay</a></p>
                    </div>
                </div>

                <style>
                    .form-group { margin-bottom: 0.5rem; text-align: left; }
                    .form-label { display: block; font-size: .75rem; font-weight: 700; color: #1e293b; margin-bottom: .2rem; }
                    .input-wrap { position: relative; }
                    .form-control {
                        width: 100%;
                        padding: .45rem .7rem;
                        border: 1.5px solid #e2e8f0;
                        border-radius: 6px;
                        font-size: .8rem;
                        font-family: inherit;
                        color: #1e293b;
                        background: white;
                        transition: all .2s;
                        outline: none;
                        box-sizing: border-box;
                    }
                    .form-control:focus { border-color: var(--e-gold); box-shadow: 0 0 0 3px rgba(255,193,7,.12); background: #fff; }
                    .guest-btn-primary {
                        width: 100%;
                        padding: .6rem;
                        background: var(--e-gold);
                        color: #000;
                        border: none;
                        border-radius: 6px;
                        font-size: .85rem;
                        font-weight: 800;
                        cursor: pointer;
                        transition: all .2s;
                        font-family: inherit;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        gap: 8px;
                        box-shadow: 0 3px 10px rgba(255, 193, 7, 0.2);
                    }
                    .guest-btn-primary:hover { background: #e6ae00; transform: translateY(-1px); box-shadow: 0 5px 12px rgba(255, 193, 7, 0.3); }
                    .guest-btn-primary:active { transform: translateY(0); }
                    .toggle-pw {
                        position: absolute; right: 8px; top: 50%; transform: translateY(-50%);
                        background: none; border: none; cursor: pointer; color: #64748b;
                        font-size: .75rem; z-index: 2;
                    }
                    @media (max-width: 767px) {
                        #enterprise_section > div:last-child, 
                        form > div:nth-child(5) {
                            grid-template-columns: 1fr !important;
                        }
                    }
                </style>

                <script>
                if (typeof toggleAccountType !== 'function') {
                    function toggleAccountType(type) {
                        const enterpriseSection = document.getElementById('enterprise_section');
                        const labelPersonal = document.getElementById('label_personal');
                        const labelEnterprise = document.getElementById('label_enterprise');
                        const companyInput = document.querySelector('input[name="company_name"]');

                        if (type === 'enterprise') {
                            if(enterpriseSection) enterpriseSection.style.display = 'block';
                            if(labelEnterprise) {
                                labelEnterprise.style.background = '#052542';
                                labelEnterprise.style.color = 'white';
                            }
                            if(labelPersonal) {
                                labelPersonal.style.background = 'transparent';
                                labelPersonal.style.color = '#475569';
                            }
                            if(companyInput) companyInput.required = true;
                        } else {
                            if(enterpriseSection) enterpriseSection.style.display = 'none';
                            if(labelPersonal) {
                                labelPersonal.style.background = '#052542';
                                labelPersonal.style.color = 'white';
                            }
                            if(labelEnterprise) {
                                labelEnterprise.style.background = 'transparent';
                                labelEnterprise.style.color = '#475569';
                            }
                            if(companyInput) companyInput.required = false;
                        }
                    }
                }

                if (typeof toggleRegPw !== 'function') {
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
                }

                document.addEventListener('DOMContentLoaded', function() {
                    const checkedType = document.querySelector('input[name="account_type"]:checked');
                    if(checkedType) toggleAccountType(checkedType.value);
                });
                </script>
            </div>
        </div>
    </div>
</div>
</div>
