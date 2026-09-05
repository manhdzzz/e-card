<x-admin-layout>
    <x-slot name="title">Cấu hình Trang chủ</x-slot>

    <div class="breadcrumb">
        <a href="{{ route('admin.dashboard') }}">Trang chủ</a><span>/</span><span>Cấu hình Website</span>
    </div>
    <h1 style="font-size:1.4rem;font-weight:800;color:#1e293b;margin-bottom:1.5rem">Cấu hình Trang chủ & Nội dung</h1>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- LOGO & FAVICON --}}
        <div class="card" style="padding:1.5rem;margin-bottom:1.5rem;">
            <h2 style="font-size:1rem;font-weight:800;color:#001529;margin-bottom:1rem;display:flex;align-items:center;gap:.5rem;">
                <i class="fa-solid fa-image" style="color:#4CAF50"></i> Logo & Bộ nhận diện
            </h2>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;align-items:start;">
                <div>
                    <label style="font-size:.8rem;font-weight:700;color:#64748b;display:block;margin-bottom:.4rem;">Tải lên Logo</label>
                    <input type="file" name="site_logo_file" style="width:100%;padding:.6rem;border:1px solid #e2e8f0;border-radius:8px;font-size:.85rem;margin-bottom:.5rem;">
                    
                    <label style="font-size:.8rem;font-weight:700;color:#64748b;display:block;margin-top:1rem;margin-bottom:.4rem;">Hoặc nhập URL Logo</label>
                    <input type="text" name="site_logo_url" value="{{ $settings['site_logo'] ?? '' }}" placeholder="https://example.com/logo.png" style="width:100%;padding:.6rem;border:1px solid #e2e8f0;border-radius:8px;font-size:.85rem;">
                    <p style="font-size:.7rem;color:#94a3b8;margin-top:.5rem;">Hỗ trợ: PNG, JPG, SVG, ICO. Sẽ tự động dùng làm favicon trang.</p>
                </div>
                <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%;">
                    @if($settings['site_logo'])
                        <div style="width: 100%; background: #f8fafc; padding: 2rem; border-radius: 12px; border: 1px solid #e2e8f0; display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 150px;">
                            <img src="{{ asset($settings['site_logo']) }}" style="max-height: 100px; max-width: 100%; object-fit: contain; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.05));">
                            <div style="font-size: .75rem; font-weight: 600; color: #64748b; margin-top: 1rem; background: #fff; padding: .2rem .8rem; border-radius: 20px; border: 1px solid #e2e8f0;">Logo hiện tại</div>
                        </div>
                    @else
                        <div style="width: 100%; background: #f1f5f9; padding: 2rem; border-radius: 12px; text-align: center; color: #94a3b8; font-size: .85rem; border: 2px dashed #cbd5e1; min-height: 150px; display: flex; align-items: center; justify-content: center;">
                            <div>
                                <i class="fa-solid fa-image-slash" style="font-size: 2rem; display: block; margin-bottom: .5rem; opacity: .5;"></i>
                                Chưa có logo
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- HERO IMAGES --}}
        <div class="card" style="padding:1.5rem;margin-bottom:1.5rem;">
            <h2 style="font-size:1rem;font-weight:800;color:#001529;margin-bottom:1rem;display:flex;align-items:center;gap:.5rem;">
                <i class="fa-solid fa-image" style="color:#FFC107"></i> Hình ảnh Hero (Trang chủ)
            </h2>
            <div style="display:grid;grid-template-columns:repeat(3, 1fr);gap:1.5rem;align-items:start;">
                {{-- Hero Profile --}}
                <div style="background:#f8f9fa;padding:1rem;border-radius:10px;">
                    <label style="font-size:.8rem;font-weight:700;color:#64748b;display:block;margin-bottom:.5rem;">Hero Profile (Ảnh nền Profile)</label>
                    <div style="height:120px;overflow:hidden;border-radius:8px;border:1px solid #ddd;margin-bottom:1rem;cursor:pointer;" onclick="window.open('{{ $settings['hero_profile'] ?? asset('assets/images/hero-profile.jpg') }}')">
                        <img src="{{ $settings['hero_profile'] ?? asset('assets/images/hero-profile.jpg') }}" style="width:100%;height:100%;object-fit:cover;">
                    </div>
                    <input type="file" name="hero_profile_file" accept="image/*" style="font-size:.75rem;width:100%;">
                    <input type="text" name="hero_profile_url" placeholder="Hoặc URL ảnh" style="width:100%;margin-top:.5rem;padding:.4rem;border:1px solid #e2e8f0;border-radius:6px;font-size:.75rem;">
                </div>

                {{-- Hero Screen --}}
                <div style="background:#f8f9fa;padding:1rem;border-radius:10px;">
                    <label style="font-size:.8rem;font-weight:700;color:#64748b;display:block;margin-bottom:.5rem;">Hero Screen (Ảnh màn hình đè lên)</label>
                    <div style="height:120px;overflow:hidden;border-radius:8px;border:1px solid #ddd;margin-bottom:1rem;cursor:pointer;" onclick="window.open('{{ $settings['hero_screen'] ?? asset('assets/images/hero-screen.png') }}')">
                        <img src="{{ $settings['hero_screen'] ?? asset('assets/images/hero-screen.png') }}" style="width:100%;height:100%;object-fit:contain;background:#fff;">
                    </div>
                    <input type="file" name="hero_screen_file" accept="image/*" style="font-size:.75rem;width:100%;">
                    <input type="text" name="hero_screen_url" placeholder="Hoặc URL ảnh" style="width:100%;margin-top:.5rem;padding:.4rem;border:1px solid #e2e8f0;border-radius:6px;font-size:.75rem;">
                </div>

                {{-- Hero Image (Original field, kept for backward compatibility if needed) --}}
                <div style="background:#f8f9fa;padding:1rem;border-radius:10px;">
                    <label style="font-size:.8rem;font-weight:700;color:#64748b;display:block;margin-bottom:.5rem;">Ảnh Hero khác</label>
                    <div style="height:120px;overflow:hidden;border-radius:8px;border:1px solid #ddd;margin-bottom:1rem;">
                        <img src="{{ $settings['hero_image'] ?? asset('assets/images/hero-profile.jpg') }}" style="width:100%;height:100%;object-fit:cover;">
                    </div>
                    <input type="file" name="hero_image_file" accept="image/*" style="font-size:.75rem;width:100%;">
                </div>
            </div>
        </div>

        {{-- COMPANY INFO --}}
        <div class="card" style="padding:1.5rem;margin-bottom:1.5rem;">
            <h2 style="font-size:1rem;font-weight:800;color:#001529;margin-bottom:1rem;display:flex;align-items:center;gap:.5rem;">
                <i class="fa-solid fa-building" style="color:#FFC107"></i> Thông tin công ty & Liên hệ
            </h2>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                <div>
                    <label style="font-size:.8rem;font-weight:700;color:#64748b;display:block;margin-bottom:.4rem;">Tên công ty</label>
                    <input type="text" name="company_name" value="{{ $settings['company_name'] ?? 'CTY CỔ PHẦN NALA GROUP' }}" style="width:100%;padding:.6rem;border:1px solid #e2e8f0;border-radius:8px;font-size:.85rem;">
                </div>
                <div>
                    <label style="font-size:.8rem;font-weight:700;color:#64748b;display:block;margin-bottom:.4rem;">Hotline</label>
                    <input type="text" name="hotline" value="{{ $settings['hotline'] ?? '19006868' }}" style="width:100%;padding:.6rem;border:1px solid #e2e8f0;border-radius:8px;font-size:.85rem;">
                </div>
                <div>
                    <label style="font-size:.8rem;font-weight:700;color:#64748b;display:block;margin-bottom:.4rem;">Email</label>
                    <input type="text" name="email" value="{{ $settings['email'] ?? 'ecardnala@gmail.com' }}" style="width:100%;padding:.6rem;border:1px solid #e2e8f0;border-radius:8px;font-size:.85rem;">
                </div>
                <div>
                    <label style="font-size:.8rem;font-weight:700;color:#64748b;display:block;margin-bottom:.4rem;">Địa chỉ</label>
                    <input type="text" name="address" value="{{ $settings['address'] ?? '54 phố Triều Khúc, quận Thanh Xuân, Hà Nội' }}" style="width:100%;padding:.6rem;border:1px solid #e2e8f0;border-radius:8px;font-size:.85rem;">
                </div>
            </div>
        </div>

        {{-- SUPPORT SECTION --}}
        <div class="card" style="padding:1.5rem;margin-bottom:1.5rem;">
            <h2 style="font-size:1rem;font-weight:800;color:#001529;margin-bottom:1rem;display:flex;align-items:center;gap:.5rem;">
                <i class="fa-solid fa-headset" style="color:#FFC107"></i> Hỗ trợ khách hàng
            </h2>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                <div>
                    <label style="font-size:.8rem;font-weight:700;color:#64748b;display:block;margin-bottom:.4rem;">Tên nhân viên hỗ trợ</label>
                    <input type="text" name="support_name" value="{{ $settings['support_name'] ?? 'Hỗ trợ NALA' }}" style="width:100%;padding:.6rem;border:1px solid #e2e8f0;border-radius:8px;font-size:.85rem;">
                </div>
                <div>
                    <label style="font-size:.8rem;font-weight:700;color:#64748b;display:block;margin-bottom:.4rem;">SĐT hỗ trợ</label>
                    <input type="text" name="support_phone" value="{{ $settings['support_phone'] ?? '19006868' }}" style="width:100%;padding:.6rem;border:1px solid #e2e8f0;border-radius:8px;font-size:.85rem;">
                </div>
                <div>
                    <label style="font-size:.8rem;font-weight:700;color:#64748b;display:block;margin-bottom:.4rem;">Link Zalo hỗ trợ</label>
                    <input type="text" name="support_zalo" value="{{ $settings['support_zalo'] ?? 'https://zalo.me/19006868' }}" style="width:100%;padding:.6rem;border:1px solid #e2e8f0;border-radius:8px;font-size:.85rem;">
                </div>
                <div>
                    <label style="font-size:.8rem;font-weight:700;color:#64748b;display:block;margin-bottom:.4rem;">Ảnh đại diện hỗ trợ</label>
                    <input type="file" name="support_avatar_file" accept="image/*" style="font-size:.85rem;">
                </div>
            </div>
        </div>

        {{-- INTRO TEXT --}}
        <div class="card" style="padding:1.5rem;margin-bottom:1.5rem;">
            <h2 style="font-size:1rem;font-weight:800;color:#001529;margin-bottom:1rem;display:flex;align-items:center;gap:.5rem;">
                <i class="fa-solid fa-pen-to-square" style="color:#FFC107"></i> Nội dung giới thiệu
            </h2>
            <div style="margin-bottom:1rem;">
                <label style="font-size:.8rem;font-weight:700;color:#64748b;display:block;margin-bottom:.4rem;">Tiêu đề Hero</label>
                <input type="text" name="hero_title" value="{{ $settings['hero_title'] ?? 'Danh Thiếp Điện Tử Thông Minh ECard - Cùng Bạn Xây Dựng Thương Hiệu Và Nuôi Dưỡng Mọi Kết Nối!' }}" style="width:100%;padding:.6rem;border:1px solid #e2e8f0;border-radius:8px;font-size:.85rem;">
            </div>
            <div>
                <label style="font-size:.8rem;font-weight:700;color:#64748b;display:block;margin-bottom:.4rem;">Mô tả Hero</label>
                <textarea name="hero_desc" rows="4" style="width:100%;padding:.6rem;border:1px solid #e2e8f0;border-radius:8px;font-size:.85rem;">{{ $settings['hero_desc'] ?? 'Trong một thế giới ngày càng số hóa, việc sử dụng danh thiếp giấy truyền thống có thể khiến bạn bỏ lỡ cơ hội truyền tải thông tin liên hệ đầy đủ.' }}</textarea>
            </div>
        </div>

        {{-- SMTP SETTINGS --}}
        <div class="card" style="padding:1.5rem;margin-bottom:1.5rem;">
            <h2 style="font-size:1rem;font-weight:800;color:#001529;margin-bottom:1rem;display:flex;align-items:center;gap:.5rem;">
                <i class="fa-solid fa-envelope" style="color:#FFC107"></i> Cấu hình Gửi Email (SMTP)
            </h2>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                <div>
                    <label style="font-size:.8rem;font-weight:700;color:#64748b;display:block;margin-bottom:.4rem;">Mail Host</label>
                    <input type="text" name="mail_host" value="{{ $settings['mail_host'] ?? 'smtp.gmail.com' }}" style="width:100%;padding:.6rem;border:1px solid #e2e8f0;border-radius:8px;font-size:.85rem;">
                </div>
                <div>
                    <label style="font-size:.8rem;font-weight:700;color:#64748b;display:block;margin-bottom:.4rem;">Mail Port</label>
                    <input type="text" name="mail_port" value="{{ $settings['mail_port'] ?? '587' }}" style="width:100%;padding:.6rem;border:1px solid #e2e8f0;border-radius:8px;font-size:.85rem;">
                </div>
                <div>
                    <label style="font-size:.8rem;font-weight:700;color:#64748b;display:block;margin-bottom:.4rem;">Username (Email)</label>
                    <input type="text" name="mail_username" value="{{ $settings['mail_username'] ?? '' }}" style="width:100%;padding:.6rem;border:1px solid #e2e8f0;border-radius:8px;font-size:.85rem;">
                </div>
                <div>
                    <label style="font-size:.8rem;font-weight:700;color:#64748b;display:block;margin-bottom:.4rem;">Password (App Password)</label>
                    <input type="password" name="mail_password" value="{{ $settings['mail_password'] ?? '' }}" style="width:100%;padding:.6rem;border:1px solid #e2e8f0;border-radius:8px;font-size:.85rem;">
                </div>
                <div>
                    <label style="font-size:.8rem;font-weight:700;color:#64748b;display:block;margin-bottom:.4rem;">Encryption (tls/ssl)</label>
                    <input type="text" name="mail_encryption" value="{{ $settings['mail_encryption'] ?? 'tls' }}" style="width:100%;padding:.6rem;border:1px solid #e2e8f0;border-radius:8px;font-size:.85rem;">
                </div>
                <div>
                    <label style="font-size:.8rem;font-weight:700;color:#64748b;display:block;margin-bottom:.4rem;">Tên người gửi (From Name)</label>
                    <input type="text" name="mail_from_name" value="{{ $settings['mail_from_name'] ?? 'ECard.vn' }}" style="width:100%;padding:.6rem;border:1px solid #e2e8f0;border-radius:8px;font-size:.85rem;">
                </div>
                <div style="grid-column: span 2;">
                    <label style="font-size:.8rem;font-weight:700;color:#64748b;display:block;margin-bottom:.4rem;">Email người gửi (From Address)</label>
                    <input type="text" name="mail_from_address" value="{{ $settings['mail_from_address'] ?? '' }}" style="width:100%;padding:.6rem;border:1px solid #e2e8f0;border-radius:8px;font-size:.85rem;">
                </div>
            </div>
            <p style="font-size:.75rem;color:#64748b;margin-top:1rem;"><i class="fa-solid fa-circle-info"></i> Lưu ý: Nếu dùng Gmail, bạn cần tạo "Mật khẩu ứng dụng" (App Password) để gửi mail thành công.</p>
        </div>

        {{-- PAYMENT SETTINGS --}}
        <div class="card" style="padding:1.5rem;margin-bottom:1.5rem;">
            <h2 style="font-size:1rem;font-weight:800;color:#001529;margin-bottom:1rem;display:flex;align-items:center;gap:.5rem;">
                <i class="fa-solid fa-credit-card" style="color:#FFC107"></i> Cấu hình thanh toán (Chuyển khoản)
            </h2>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;align-items:start;">
                <div style="display:flex; flex-direction:column; gap:1rem;">
                    <div>
                        <label style="font-size:.8rem;font-weight:700;color:#64748b;display:block;margin-bottom:.4rem;">Tên ngân hàng</label>
                        <input type="text" name="payment_bank_name" value="{{ $settings['payment_bank_name'] ?? '' }}" placeholder="Ví dụ: Vietcombank, MB Bank..." style="width:100%;padding:.6rem;border:1px solid #e2e8f0;border-radius:8px;font-size:.85rem;">
                    </div>
                    <div>
                        <label style="font-size:.8rem;font-weight:700;color:#64748b;display:block;margin-bottom:.4rem;">Số tài khoản</label>
                        <input type="text" name="payment_account_number" value="{{ $settings['payment_account_number'] ?? '' }}" placeholder="Nhập số tài khoản ngân hàng" style="width:100%;padding:.6rem;border:1px solid #e2e8f0;border-radius:8px;font-size:.85rem;">
                    </div>
                    <div>
                        <label style="font-size:.8rem;font-weight:700;color:#64748b;display:block;margin-bottom:.4rem;">Tên chủ tài khoản</label>
                        <input type="text" name="payment_account_name" value="{{ $settings['payment_account_name'] ?? '' }}" placeholder="Nhập tên chủ tài khoản (VIET HOA KHONG DAU)" style="width:100%;padding:.6rem;border:1px solid #e2e8f0;border-radius:8px;font-size:.85rem;">
                    </div>
                    <div>
                        <label style="font-size:.8rem;font-weight:700;color:#64748b;display:block;margin-bottom:.4rem;">Nội dung chuyển khoản mặc định</label>
                        <input type="text" name="payment_transfer_content" value="{{ $settings['payment_transfer_content'] ?? 'THANHTOAN [MADONHANG]' }}" placeholder="Ví dụ: THANHTOAN [ID]" style="width:100%;padding:.6rem;border:1px solid #e2e8f0;border-radius:8px;font-size:.85rem;">
                        <p style="font-size:.7rem;color:#94a3b8;margin-top:.4rem;">Gợi ý: Sử dụng [MADONHANG] để khách hàng điền mã đơn tự động.</p>
                    </div>
                </div>
                <div>
                    <label style="font-size:.8rem;font-weight:700;color:#64748b;display:block;margin-bottom:.4rem;">Ảnh mã QR thanh toán</label>
                    <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:12px; padding:1.5rem; text-align:center;">
                        @if($settings['payment_qr_code'])
                            <img src="{{ asset($settings['payment_qr_code']) }}" style="max-height:180px; margin-bottom:1rem; border-radius:8px; border:1px solid #eee;">
                        @else
                            <div style="height:120px; display:flex; align-items:center; justify-content:center; color:#94a3b8; border:2px dashed #cbd5e1; border-radius:8px; margin-bottom:1rem; font-size:.85rem;">Chưa có ảnh QR</div>
                        @endif
                        <input type="file" name="payment_qr_code_file" accept="image/*" style="font-size:.8rem; width:100%;">
                        <p style="font-size:.7rem;color:#94a3b8;margin-top:.8rem;">Tải lên ảnh QR ngân hàng của bạn để khách hàng quét nhanh.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- SOCIAL MEDIA --}}
        <div class="card" style="padding:1.5rem;margin-bottom:1.5rem;">
            <h2 style="font-size:1rem;font-weight:800;color:#001529;margin-bottom:1rem;display:flex;align-items:center;gap:.5rem;">
                <i class="fa-brands fa-facebook" style="color:#1877F2"></i> Mạng xã hội & Fanpage
            </h2>
            <div>
                <label style="font-size:.8rem;font-weight:700;color:#64748b;display:block;margin-bottom:.4rem;">Facebook Page URL (Dùng cho widget Fanpage ở bài viết)</label>
                <input type="text" name="facebook_page_url" value="{{ $settings['facebook_page_url'] ?? 'https://www.facebook.com/ecard.vn' }}" placeholder="https://www.facebook.com/yourpage" style="width:100%;padding:.6rem;border:1px solid #e2e8f0;border-radius:8px;font-size:.85rem;">
            </div>
        </div>

        <div style="padding-top:1rem;">
            <button type="submit" class="btn btn-primary" style="padding:.8rem 2rem;font-size:.9rem;background:#001529;">
                <i class="fa-solid fa-check"></i> Lưu tất cả cấu hình
            </button>
        </div>
    </form>
</x-admin-layout>
