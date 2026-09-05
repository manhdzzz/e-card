<x-app-layout>
    <x-slot name="title">Tạo danh thiếp</x-slot>

    @push('styles')
    <style>
        .create-layout { display:grid; grid-template-columns:1fr 440px; gap:1.5rem; align-items:start; }
        .form-section { background:white; border-radius:14px; border:1px solid #e2e8f0; padding:1.5rem; margin-bottom:1rem; }
        .form-section-title { display:flex; align-items:center; gap:.6rem; font-size:.92rem; font-weight:700; color:var(--e-navy); margin-bottom:1.2rem; padding-bottom:.7rem; border-bottom:1px solid #f1f5f9; }
        .form-grid-2 { display:grid; grid-template-columns:1fr 1fr; gap:1rem; }
        /* AVATAR UPLOAD */
        .avatar-upload-area { display:flex; flex-direction:column; align-items:center; }
        .avatar-preview {
            width:110px; height:110px; border-radius:50%;
            border:3px dashed var(--e-gold); background:#fffef0;
            display:flex; align-items:center; justify-content:center;
            overflow:hidden; margin-bottom:.7rem; cursor:pointer;
            position:relative; transition:border-color .2s;
        }
        .avatar-preview:hover { border-color:var(--e-navy); }
        .avatar-preview img { width:100%; height:100%; object-fit:cover; }
        .avatar-preview i { color:var(--e-gold); font-size:2.5rem; }
        .avatar-upload-hint { font-size:.75rem; color:#64748b; text-align:center; }
        /* CARD PREVIEW */
        .preview-panel { position:sticky; top:80px; }
        .preview-label { display:flex; align-items:center; gap:.5rem; font-size:.88rem; font-weight:700; color:var(--e-navy); margin-bottom:.8rem; }
        .preview-label i { color:var(--e-navy); }
        .card-preview {
            background:white; border-radius:16px; border:1px solid #e2e8f0;
            overflow:hidden; box-shadow:0 8px 24px rgba(5,37,66,.1);
        }
        .cp-header {
            background:linear-gradient(135deg, var(--e-navy) 0%, #0a3d6b 100%);
            padding:1.8rem 1.5rem; text-align:center; position:relative;
        }
        .cp-header::after {
            content:''; position:absolute; bottom:-1px; left:0; right:0;
            height:30px; background:white;
            clip-path: ellipse(60% 100% at 50% 100%);
        }
        .cp-avatar {
            width:84px; height:84px; border-radius:50%;
            border:4px solid rgba(255,193,7,.5);
            background:rgba(255,255,255,.3);
            margin:0 auto .8rem;
            display:flex; align-items:center; justify-content:center;
            color:white; font-weight:800; font-size:2rem;
            overflow:hidden; position:relative; z-index:1;
        }
        .cp-avatar img { width:100%; height:100%; object-fit:cover; }
        .cp-name { color:white; font-weight:800; font-size:1.1rem; letter-spacing:.5px; position:relative; z-index:1; }
        .cp-body { padding:1.2rem 1.5rem; padding-top:1.4rem; }
        .cp-job { color:var(--e-navy); font-size:.82rem; font-weight:600; text-align:center; margin-bottom:.2rem; }
        .cp-divider { width:40px; height:2px; background:var(--e-gold); margin:.5rem auto; }
        .cp-company { color:#1e293b; font-size:.85rem; font-weight:600; text-align:center; margin-bottom:1rem; }
        .cp-info { display:flex; flex-direction:column; gap:.5rem; margin-bottom:1rem; }
        .cp-info-row { display:flex; align-items:center; gap:.6rem; font-size:.8rem; color:#64748b; }
        .cp-info-row i { color:var(--e-navy); width:14px; }
        .cp-socials { display:flex; justify-content:center; gap:.6rem; }
        .cp-soc { width:34px; height:34px; border-radius:50%; display:flex; align-items:center; justify-content:center; color:white; font-size:.85rem; }
        /* QR PREVIEW */
        .qr-preview-box { background:white; border:1px solid #e2e8f0; border-radius:12px; padding:1rem; margin-top:1rem; display:flex; align-items:center; gap:.9rem; }
        .qr-box { width:60px; height:60px; background:#f8fafc; border-radius:8px; display:flex; align-items:center; justify-content:center; color:#94a3b8; font-size:1.5rem; flex-shrink:0; }
        .qr-box img { width:100%; height:100%; }
        .qr-text h4 { font-size:.82rem; font-weight:700; color:#1e293b; margin-bottom:.2rem; }
        .qr-text p { font-size:.75rem; color:#64748b; }

        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; font-weight: 700; border-radius: 8px; transition: 0.2s; text-decoration: none !important; cursor: pointer; border: none; padding: 10px 20px; }
        .btn-primary { background: var(--e-gold) !important; color: #000 !important; }
        .btn-primary:hover { background: #e6ae00 !important; color: #000 !important; }
        .btn-gray { background: #f1f5f9 !important; color: #475569 !important; }
        .btn-gray:hover { background: #e2e8f0 !important; color: #1e293b !important; }
        
        /* FORM ACTIONS */
        .form-actions { display:flex; gap:.8rem; margin-top:1rem; }
        .form-actions .btn { flex:1; justify-content:center; }

        .form-group { margin-bottom: 1.2rem; }
        .form-label { display: block; font-weight: 700; color: var(--e-navy); margin-bottom: .5rem; font-size: .85rem; }
        .form-label .req { color: red; }
        .input-wrap { position: relative; display: flex; align-items: center; }
        .input-wrap i { position: absolute; left: 14px; color: #64748b; font-size: .9rem; }
        .form-control { width: 100%; border: 1px solid #e2e8f0; border-radius: 8px; padding: .6rem 1rem .6rem 2.5rem; font-size: .9rem; color: #1e293b; background: #fff; transition: .2s; box-sizing: border-box; }
        .form-control:focus { border-color: var(--e-gold); outline: none; box-shadow: 0 0 0 3px rgba(255, 193, 7, 0.1); }
        .error-msg { color: #ef4444; font-size: .75rem; margin-top: .3rem; }

        /* Custom Switch */
        .switch-wrap { display: flex; align-items: center; justify-content: space-between; padding: 1rem; background: #f8faff; border-radius: 10px; cursor: pointer; border: 1px solid #eef2fb; margin-top: 1rem; }
        .switch-label { font-size: .85rem; font-weight: 700; color: #1e293b; display: flex; align-items: center; gap: .6rem; }
        .switch-label i { color: var(--e-navy); }
        .switch { position: relative; display: inline-block; width: 42px; height: 22px; }
        .switch input { opacity: 0; width: 0; height: 0; }
        .slider { position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #cbd5e1; transition: .3s; border-radius: 34px; }
        .slider:before { position: absolute; content: ""; height: 16px; width: 16px; left: 3px; bottom: 3px; background-color: white; transition: .3s; border-radius: 50%; }
        input:checked + .slider { background-color: var(--e-navy); }
        input:checked + .slider:before { transform: translateX(20px); }
    </style>
    @endpush

    <div class="breadcrumb">
        <a href="{{ url('/') }}">Trang chủ</a><span>/</span>
        <a href="{{ route('cards.index') }}">Quản lý danh thiếp</a><span>/</span>
        <span>Tạo danh thiếp</span>
    </div>

    <div style="margin-bottom:1.2rem">
        <h1 style="font-size:1.5rem;font-weight:800;color:#1e293b">Tạo danh thiếp</h1>
        <p style="font-size:.85rem;color:#64748b">Nhập thông tin của bạn để tạo danh thiếp điện tử chuyên nghiệp</p>
    </div>

    <form method="POST" action="{{ route('cards.store') }}" enctype="multipart/form-data" id="cardForm">
        @csrf
        <div class="create-layout">
            <!-- LEFT FORM -->
            <div>
                <!-- Personal Info -->
                <div class="form-section">
                    <div class="form-section-title">
                        <i class="fa-solid fa-address-card"></i> Thông tin cá nhân
                    </div>
                    <div class="form-grid-2">
                        <div style="grid-column:1">
                            @if($isEnterpriseEmployee)
                                <div class="form-group">
                                    <label class="form-label">Họ và tên <span class="req">*</span></label>
                                    <div class="input-wrap">
                                        <i class="fa-regular fa-user"></i>
                                        <input type="text" name="full_name" id="inp_name" class="form-control" value="{{ auth()->user()->employee->full_name }}" readonly style="background:#f1f5f9; cursor:not-allowed;" title="Thông tin này được quản lý bởi doanh nghiệp">
                                    </div>
                                    <div style="font-size: .7rem; color: #64748b; margin-top: 4px;"><i class="fa-solid fa-lock"></i> Thông tin do doanh nghiệp quản lý</div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Chức vụ</label>
                                    <div class="input-wrap">
                                        <i class="fa-solid fa-briefcase"></i>
                                        <input type="text" name="job_title" id="inp_job" class="form-control" value="{{ auth()->user()->employee->position }}" readonly style="background:#f1f5f9; cursor:not-allowed;">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tên công ty</label>
                                    <div class="input-wrap">
                                        <i class="fa-solid fa-building"></i>
                                        <input type="text" name="company" id="inp_company" class="form-control" value="{{ auth()->user()->employee->company->name }}" readonly style="background:#f1f5f9; cursor:not-allowed;">
                                    </div>
                                </div>
                            @else
                                <div class="form-group">
                                    <label class="form-label">Họ và tên <span class="req">*</span></label>
                                    <div class="input-wrap">
                                        <i class="fa-regular fa-user"></i>
                                        <input type="text" name="full_name" id="inp_name" class="form-control" placeholder="Nguyễn Văn An" value="{{ old('full_name') }}" required>
                                    </div>
                                    @error('full_name')<div class="error-msg">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Chức vụ</label>
                                    <div class="input-wrap">
                                        <i class="fa-solid fa-briefcase"></i>
                                        <input type="text" name="job_title" id="inp_job" class="form-control" placeholder="Nhà phát triển phần mềm" value="{{ old('job_title') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tên công ty</label>
                                    <div class="input-wrap">
                                        <i class="fa-solid fa-building"></i>
                                        <input type="text" name="company" id="inp_company" class="form-control" placeholder="Công ty TNHH ABC" value="{{ old('company') }}">
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div style="display:flex;flex-direction:column;align-items:center">
                            <label class="form-label" style="align-self:flex-start">Ảnh đại diện</label>
                            <div class="avatar-upload-area">
                                <label for="avatar_input" class="avatar-preview" id="avatarPreview">
                                    <i class="fa-regular fa-user" id="avatarIcon"></i>
                                    <img id="avatarImg" src="" alt="" style="display:none">
                                </label>
                                <input type="file" name="avatar" id="avatar_input" accept="image/*" style="display:none">
                                <label for="avatar_input" class="btn btn-gray" style="font-size:.78rem;padding:.4rem .9rem;cursor:pointer">
                                    <i class="fa-solid fa-upload"></i> Chọn ảnh
                                </label>
                                <div class="avatar-upload-hint">JPG, PNG. Tối đa 2MB</div>
                            </div>
                        </div>
                    </div>
                    
                    <label class="switch-wrap" for="statusToggle" style="margin-top: 1.5rem;">
                        <div class="switch-label">
                            <i class="fa-solid fa-eye" id="statusIcon"></i>
                            <div>
                                <div style="font-size: .85rem; font-weight: 700; color: #1e293b;">Hiển thị danh thiếp công khai</div>
                                <div style="font-size:.72rem; color:#64748b; font-weight:400; margin-top:2px">Khi tắt, người khác sẽ không thể xem thông tin danh thiếp này.</div>
                            </div>
                        </div>
                        <div class="switch">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" id="statusToggle" checked>
                            <span class="slider"></span>
                        </div>
                    </label>
                </div>

                <!-- Contact Info -->
                <div class="form-section">
                    <div class="form-section-title">
                        <i class="fa-solid fa-phone"></i> Thông tin liên hệ
                    </div>
                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label">Số điện thoại</label>
                            <div class="input-wrap">
                                <i class="fa-solid fa-phone"></i>
                                <input type="text" name="phone" id="inp_phone" class="form-control" placeholder="0123 456 789" value="{{ old('phone') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <div class="input-wrap">
                                <i class="fa-regular fa-envelope"></i>
                                <input type="email" name="email" id="inp_email" class="form-control" placeholder="email@example.com" value="{{ old('email') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Địa chỉ</label>
                            <div class="input-wrap">
                                <i class="fa-solid fa-location-dot"></i>
                                <input type="text" name="address" id="inp_address" class="form-control" placeholder="Hà Nội, Việt Nam" value="{{ old('address') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Website</label>
                            <div class="input-wrap">
                                <i class="fa-solid fa-globe"></i>
                                <input type="url" name="website" id="inp_website" class="form-control" placeholder="https://example.com" value="{{ old('website') }}">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social Links -->
                <div class="form-section">
                    <div class="form-section-title">
                        <i class="fa-solid fa-share-nodes"></i> Liên kết mạng xã hội
                    </div>
                    <div class="form-group">
                        <div class="input-wrap">
                            <i class="fa-brands fa-facebook-f" style="color:#1877f2"></i>
                            <input type="url" name="facebook_url" class="form-control" placeholder="https://facebook.com/username" value="{{ old('facebook_url') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-wrap">
                            <span style="position:absolute;left:13px;top:50%;transform:translateY(-50%);font-weight:900;font-size:.8rem;color:#0d9488;font-family:sans-serif">Zalo</span>
                            <input type="url" name="zalo_url" class="form-control" placeholder="https://zalo.me/username" value="{{ old('zalo_url') }}" style="padding-left:3.5rem">
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom:0">
                        <div class="input-wrap">
                            <i class="fa-brands fa-linkedin-in" style="color:#0077b5"></i>
                            <input type="url" name="linkedin_url" class="form-control" placeholder="https://linkedin.com/in/username" value="{{ old('linkedin_url') }}">
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="form-actions">
                    <button type="button" class="btn btn-gray btn-lg" onclick="resetForm()">
                        <i class="fa-solid fa-rotate-left"></i> Làm mới
                    </button>
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fa-solid fa-floppy-disk"></i> Lưu danh thiếp
                    </button>
                </div>
            </div>

            <!-- RIGHT PREVIEW -->
            <div class="preview-panel">
                <div class="preview-label"><i class="fa-regular fa-eye"></i> Xem trước danh thiếp</div>
                <div class="card-preview">
                    <div class="cp-header">
                        <div class="cp-avatar" id="prev_avatar">
                            <span id="prev_avatar_letter">?</span>
                            <img id="prev_avatar_img" src="" style="display:none;width:100%;height:100%;object-fit:cover;position:absolute;top:0;left:0">
                        </div>
                        <div class="cp-name" id="prev_name">TÊN CỦA BẠN</div>
                    </div>
                    <div class="cp-body">
                        <div class="cp-job" id="prev_job"></div>
                        <div class="cp-divider"></div>
                        <div class="cp-company" id="prev_company"></div>
                        <div class="cp-info">
                            <div class="cp-info-row" id="prev_phone_row" style="display:none"><i class="fa-solid fa-phone"></i><span id="prev_phone"></span></div>
                            <div class="cp-info-row" id="prev_email_row" style="display:none"><i class="fa-regular fa-envelope"></i><span id="prev_email"></span></div>
                            <div class="cp-info-row" id="prev_address_row" style="display:none"><i class="fa-solid fa-location-dot"></i><span id="prev_address"></span></div>
                            <div class="cp-info-row" id="prev_website_row" style="display:none"><i class="fa-solid fa-globe"></i><span id="prev_website"></span></div>
                        </div>
                        <div class="cp-socials" id="prev_socials" style="display:none">
                            <div class="cp-soc" id="prev_fb" style="background:#1877f2;display:none"><i class="fa-brands fa-facebook-f"></i></div>
                            <div class="cp-soc" id="prev_zalo" style="background:#0d9488;display:none"><span style="font-size:.65rem;font-weight:900">Zalo</span></div>
                            <div class="cp-soc" id="prev_li" style="background:#0077b5;display:none"><i class="fa-brands fa-linkedin-in"></i></div>
                        </div>
                    </div>
                </div>
                <div class="qr-preview-box">
                    <div class="qr-box"><i class="fa-solid fa-qrcode"></i></div>
                    <div class="qr-text">
                        <h4>Quét mã để lưu danh thiếp</h4>
                        <p>Chia sẻ danh thiếp của bạn một cách nhanh chóng</p>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @push('scripts')
    <script>
    // Live preview
    function updatePreview(inputId, previewId, rowId = null) {
        const val = document.getElementById(inputId)?.value?.trim() || '';
        const el = document.getElementById(previewId);
        if (el) el.textContent = val;
        if (rowId) document.getElementById(rowId).style.display = val ? 'flex' : 'none';
    }

    document.getElementById('inp_name').addEventListener('input', function() {
        const v = this.value.trim().toUpperCase() || 'TÊN CỦA BẠN';
        document.getElementById('prev_name').textContent = v;
        document.getElementById('prev_avatar_letter').textContent = v.charAt(0) || '?';
    });
    ['inp_job|prev_job', 'inp_company|prev_company',
     'inp_phone|prev_phone|prev_phone_row', 'inp_email|prev_email|prev_email_row',
     'inp_address|prev_address|prev_address_row', 'inp_website|prev_website|prev_website_row'
    ].forEach(s => {
        const [inp, prev, row] = s.split('|');
        const el = document.getElementById(inp);
        if (el) el.addEventListener('input', () => updatePreview(inp, prev, row || null));
    });

    // Social toggles
    ['facebook_url|prev_fb', 'zalo_url|prev_zalo', 'linkedin_url|prev_li'].forEach(s => {
        const [name, prevId] = s.split('|');
        const input = document.querySelector(`input[name="${name}"]`);
        if (input) input.addEventListener('input', function() {
            document.getElementById(prevId).style.display = this.value.trim() ? 'flex' : 'none';
            const hasSocial = ['facebook_url','zalo_url','linkedin_url'].some(n => document.querySelector(`input[name="${n}"]`)?.value.trim());
            document.getElementById('prev_socials').style.display = hasSocial ? 'flex' : 'none';
        });
    });

    // Avatar preview
    document.getElementById('avatar_input').addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = (e) => {
                document.getElementById('avatarImg').src = e.target.result;
                document.getElementById('avatarImg').style.display = 'block';
                document.getElementById('avatarIcon').style.display = 'none';
                document.getElementById('prev_avatar_img').src = e.target.result;
                document.getElementById('prev_avatar_img').style.display = 'block';
                document.getElementById('prev_avatar_letter').style.display = 'none';
            };
            reader.readAsDataURL(this.files[0]);
        }
    });

    document.getElementById('statusToggle').addEventListener('change', function() {
        const icon = document.getElementById('statusIcon');
        if (this.checked) {
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        } else {
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    });

    function resetForm() {
        document.getElementById('cardForm').reset();
        document.getElementById('prev_name').textContent = 'TÊN CỦA BẠN';
        document.getElementById('prev_avatar_letter').textContent = '?';
        document.getElementById('prev_avatar_letter').style.display = 'block';
        document.getElementById('prev_avatar_img').style.display = 'none';
        document.getElementById('avatarImg').style.display = 'none';
        document.getElementById('avatarIcon').style.display = 'block';
        ['prev_job','prev_company'].forEach(id => { const el = document.getElementById(id); if(el) el.textContent = ''; });
        ['prev_phone_row','prev_email_row','prev_address_row','prev_website_row','prev_fb','prev_zalo','prev_li','prev_socials'].forEach(id => {
            const el = document.getElementById(id); if(el) el.style.display = 'none';
        });
    }
    </script>
    @endpush
</x-app-layout>
