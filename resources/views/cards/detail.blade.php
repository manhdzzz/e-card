<x-app-layout>
    <x-slot name="title">Chi tiết danh thiếp</x-slot>

    @push('styles')
    <style>
        .detail-layout { display:grid; grid-template-columns:1fr 360px; gap:1.5rem; align-items:start; }
        .detail-card { background:white; border-radius:16px; border:1px solid #e2e8f0; overflow:hidden; }
        .dc-header {
            background:linear-gradient(135deg,#2563eb 0%,#3b82f6 60%,#60a5fa 100%);
            padding:2rem 2rem 2.5rem; position:relative;
        }
        .dc-header-dots {
            position:absolute; right:1.5rem; top:1rem;
            display:grid; grid-template-columns:repeat(5,6px); gap:5px;
        }
        .dc-header-dots span { width:6px; height:6px; border-radius:50%; background:rgba(255,255,255,.2); display:block; }
        .dc-header-inner { display:flex; align-items:center; gap:1.2rem; }
        .dc-avatar {
            width:88px; height:88px; border-radius:50%;
            border:4px solid rgba(255,255,255,.4);
            background:rgba(255,255,255,.2);
            display:flex; align-items:center; justify-content:center;
            color:white; font-weight:800; font-size:2.2rem;
            flex-shrink:0; overflow:hidden;
        }
        .dc-avatar img { width:100%; height:100%; object-fit:cover; }
        .dc-name { color:white; font-weight:800; font-size:1.3rem; letter-spacing:.5px; margin-bottom:.4rem; }
        .dc-badge {
            display:inline-block; background:rgba(255,255,255,.2);
            color:white; padding:.25rem .8rem; border-radius:20px;
            font-size:.8rem; font-weight:600; margin-bottom:.3rem;
        }
        .dc-company { color:rgba(255,255,255,.85); font-size:.88rem; margin-top:.2rem; }
        /* Wave bottom */
        .dc-wave {
            position:absolute; bottom:0; left:0; right:0; height:28px;
            background:white; clip-path:ellipse(60% 100% at 50% 100%);
        }
        .dc-body { padding:1.5rem; }
        .section-head { display:flex; align-items:center; gap:.5rem; font-size:.9rem; font-weight:700; color:#2563eb; margin-bottom:1rem; }
        .contact-row {
            display:flex; align-items:center; justify-content:space-between;
            padding:.9rem 1rem; border:1px solid #f1f5f9; border-radius:10px;
            margin-bottom:.6rem; transition:background .15s;
        }
        .contact-row:hover { background:#fafbff; }
        .cr-left { display:flex; align-items:center; gap:.8rem; }
        .cr-icon {
            width:40px; height:40px; border-radius:10px;
            background:#eff6ff; display:flex; align-items:center; justify-content:center;
            color:#2563eb; font-size:.9rem; flex-shrink:0;
        }
        .cr-label { font-size:.75rem; color:#94a3b8; }
        .cr-value { font-size:.88rem; font-weight:600; color:#1e293b; }
        .cr-right { display:flex; align-items:center; gap:.5rem; }
        .cr-action-btn {
            width:36px; height:36px; border-radius:50%;
            background:#2563eb; border:none; color:white;
            display:flex; align-items:center; justify-content:center;
            cursor:pointer; font-size:.8rem; text-decoration:none; transition:background .2s;
        }
        .cr-action-btn:hover { background:#1d4ed8; }
        .cr-copy-btn {
            width:30px; height:30px; border-radius:7px;
            background:#f1f5f9; border:none; color:#64748b;
            display:flex; align-items:center; justify-content:center;
            cursor:pointer; font-size:.8rem; transition:all .2s;
        }
        .cr-copy-btn:hover { background:#e2e8f0; color:#1e293b; }
        .social-section { margin-top:1.2rem; }
        .social-btns { display:flex; gap:.8rem; flex-wrap:wrap; }
        .social-btn {
            flex:1; min-width:120px; display:flex; align-items:center; justify-content:center;
            gap:.5rem; padding:.7rem 1rem; border-radius:10px;
            text-decoration:none; color:white; font-weight:700; font-size:.85rem;
            transition:opacity .2s;
        }
        .social-btn:hover { opacity:.88; }
        /* RIGHT PANEL */
        .side-panel { display:flex; flex-direction:column; gap:1rem; }
        .side-card { background:white; border-radius:14px; border:1px solid #e2e8f0; padding:1.3rem; }
        .side-card-title { display:flex; align-items:center; gap:.5rem; font-size:.88rem; font-weight:700; color:#1e293b; margin-bottom:1rem; }
        .qr-wrap { text-align:center; }
        .qr-wrap img { width:160px; height:160px; border-radius:10px; }
        .link-box { display:flex; gap:.5rem; margin-top:.8rem; }
        .link-input {
            flex:1; padding:.55rem .8rem; border:1.5px solid #e2e8f0;
            border-radius:8px; font-size:.8rem; color:#64748b;
            background:#f8faff; outline:none; font-family:inherit;
        }
        .copy-link-btn {
            padding:.55rem .9rem; background:#eff6ff; border:1.5px solid #bfdbfe;
            border-radius:8px; color:#2563eb; font-size:.8rem; font-weight:700;
            cursor:pointer; white-space:nowrap; display:flex; align-items:center; gap:.35rem;
            transition:background .2s;
        }
        .copy-link-btn:hover { background:#dbeafe; }
        .share-quick { display:flex; flex-direction:column; gap:.5rem; margin-top:.6rem; }
        .share-method {
            display:flex; align-items:center; gap:.7rem;
            padding:.65rem .8rem; border-radius:9px; border:1px solid #e2e8f0;
            font-size:.83rem; font-weight:600; color:#1e293b; cursor:pointer;
            text-decoration:none; transition:background .15s;
        }
        .share-method:hover { background:#f8faff; }
    </style>
    @endpush

    <!-- Breadcrumb & Actions -->
    <div class="breadcrumb">
        <a href="{{ url('/') }}">Trang chủ</a><span>/</span>
        <a href="{{ route('cards.index') }}">Danh thiếp</a><span>/</span>
        <span>Chi tiết danh thiếp</span>
    </div>

    <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:1.2rem;flex-wrap:wrap;gap:.8rem">
        <div>
            <h1 style="display:flex;align-items:center;gap:.6rem;font-size:1.5rem;font-weight:800;color:#1e293b">
                <i class="fa-regular fa-eye" style="color:#2563eb"></i> Chi tiết danh thiếp
            </h1>
            <p style="font-size:.85rem;color:#64748b;margin-top:.15rem">Xem và chia sẻ thông tin danh thiếp của bạn</p>
        </div>
        <div style="display:flex;gap:.7rem">
            <a href="{{ route('cards.share', $card) }}" class="btn btn-outline">
                <i class="fa-solid fa-share-nodes"></i> Chia sẻ
            </a>
            <a href="{{ route('cards.edit', $card) }}" class="btn btn-primary">
                <i class="fa-solid fa-pen-to-square"></i> Chỉnh sửa danh thiếp
            </a>
        </div>
    </div>

    <div class="detail-layout">
        <!-- MAIN CARD -->
        <div>
            <div class="detail-card">
                <!-- Header -->
                <div class="dc-header">
                    <div class="dc-header-dots">
                        @for($i=0;$i<15;$i++)<span></span>@endfor
                    </div>
                    <div class="dc-header-inner">
                        <div class="dc-avatar">
                            @if($card->avatar)
                                <img src="{{ Storage::url($card->avatar) }}" alt="{{ $card->full_name }}">
                            @else
                                {{ strtoupper(substr($card->full_name,0,1)) }}
                            @endif
                        </div>
                        <div>
                            <div class="dc-name">{{ strtoupper($card->full_name) }}</div>
                            @if($card->job_title)<span class="dc-badge">{{ $card->job_title }}</span>@endif
                            @if($card->company)<div class="dc-company">{{ $card->company }}</div>@endif
                        </div>
                    </div>
                    <div class="dc-wave"></div>
                </div>

                <div class="dc-body">
                    <!-- Contact Info -->
                    <div class="section-head">
                        <i class="fa-solid fa-phone"></i> Thông tin liên hệ
                    </div>

                    @if($card->phone)
                    <div class="contact-row">
                        <div class="cr-left">
                            <div class="cr-icon"><i class="fa-solid fa-phone"></i></div>
                            <div>
                                <div class="cr-label">Số điện thoại</div>
                                <div class="cr-value">{{ $card->phone }}</div>
                            </div>
                        </div>
                        <div class="cr-right">
                            <a href="tel:{{ $card->phone }}" class="cr-action-btn"><i class="fa-solid fa-phone"></i></a>
                            <button class="cr-copy-btn" onclick="copyText('{{ $card->phone }}')"><i class="fa-regular fa-copy"></i></button>
                        </div>
                    </div>
                    @endif

                    @if($card->email)
                    <div class="contact-row">
                        <div class="cr-left">
                            <div class="cr-icon"><i class="fa-regular fa-envelope"></i></div>
                            <div>
                                <div class="cr-label">Email</div>
                                <div class="cr-value">{{ $card->email }}</div>
                            </div>
                        </div>
                        <div class="cr-right">
                            <a href="mailto:{{ $card->email }}" class="cr-action-btn"><i class="fa-regular fa-envelope"></i></a>
                            <button class="cr-copy-btn" onclick="copyText('{{ $card->email }}')"><i class="fa-regular fa-copy"></i></button>
                        </div>
                    </div>
                    @endif

                    @if($card->address)
                    <div class="contact-row">
                        <div class="cr-left">
                            <div class="cr-icon"><i class="fa-solid fa-location-dot"></i></div>
                            <div>
                                <div class="cr-label">Địa chỉ</div>
                                <div class="cr-value">{{ $card->address }}</div>
                            </div>
                        </div>
                        <div class="cr-right">
                            <button class="cr-copy-btn" onclick="copyText('{{ $card->address }}')"><i class="fa-regular fa-copy"></i></button>
                        </div>
                    </div>
                    @endif

                    @if($card->website)
                    <div class="contact-row">
                        <div class="cr-left">
                            <div class="cr-icon"><i class="fa-solid fa-globe"></i></div>
                            <div>
                                <div class="cr-label">Website</div>
                                <div class="cr-value">{{ $card->website }}</div>
                            </div>
                        </div>
                        <div class="cr-right">
                            <a href="{{ $card->website }}" target="_blank" class="cr-action-btn"><i class="fa-solid fa-globe"></i></a>
                            <button class="cr-copy-btn" onclick="copyText('{{ $card->website }}')"><i class="fa-regular fa-copy"></i></button>
                        </div>
                    </div>
                    @endif

                    <!-- Social Links -->
                    @if($card->facebook_url || $card->zalo_url || $card->linkedin_url)
                    <div class="social-section">
                        <div class="section-head"><i class="fa-solid fa-share-nodes"></i> Liên kết mạng xã hội</div>
                        <div class="social-btns">
                            @if($card->facebook_url)
                            <a href="{{ $card->facebook_url }}" target="_blank" class="social-btn" style="background:#1877f2">
                                <i class="fa-brands fa-facebook-f"></i> Facebook
                            </a>
                            @endif
                            @if($card->zalo_url)
                            <a href="{{ $card->zalo_url }}" target="_blank" class="social-btn" style="background:#0d9488">
                                <span style="font-weight:900;font-size:.9rem">Zalo</span> Zalo
                            </a>
                            @endif
                            @if($card->linkedin_url)
                            <a href="{{ $card->linkedin_url }}" target="_blank" class="social-btn" style="background:#0077b5">
                                <i class="fa-brands fa-linkedin-in"></i> LinkedIn
                            </a>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- SIDE PANEL -->
        <div class="side-panel">
            <!-- QR Code -->
            <div class="side-card">
                <div class="side-card-title">
                    <i class="fa-solid fa-qrcode" style="color:#2563eb"></i> Mã QR danh thiếp
                </div>
                <p style="font-size:.8rem;color:#64748b;margin-bottom:.9rem">Quét mã để lưu danh thiếp</p>
                <div class="qr-wrap">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=160x160&data={{ urlencode(route('cards.public', $card->slug)) }}" alt="QR Code">
                </div>
                <div style="margin-top:.8rem">
                    <div style="font-size:.78rem;color:#64748b;margin-bottom:.4rem">Link danh thiếp</div>
                    <div class="link-box">
                        <input type="text" class="link-input" value="{{ route('cards.public', $card->slug) }}" readonly id="cardLink">
                        <button class="copy-link-btn" onclick="copyText(document.getElementById('cardLink').value)">
                            <i class="fa-regular fa-copy"></i> Sao chép
                        </button>
                    </div>
                </div>
            </div>

            <!-- Quick Share -->
            <div class="side-card">
                <div class="side-card-title">
                    <i class="fa-solid fa-bolt" style="color:#f59e0b"></i> Chia sẻ nhanh chóng
                </div>
                <p style="font-size:.8rem;color:#64748b;margin-bottom:.8rem">Quét QR hoặc chia sẻ link để người khác lưu thông tin của bạn ngay lập tức.</p>
                <div class="share-quick">
                    <a href="{{ route('cards.share', $card) }}" class="share-method">
                        <i class="fa-solid fa-share-nodes" style="color:#2563eb;width:18px;text-align:center"></i>
                        Trang chia sẻ đầy đủ
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('cards.public', $card->slug)) }}" target="_blank" class="share-method">
                        <i class="fa-brands fa-facebook-f" style="color:#1877f2;width:18px;text-align:center"></i>
                        Chia sẻ Facebook
                    </a>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    function copyText(text) {
        navigator.clipboard.writeText(text).then(() => {
            const toast = document.createElement('div');
            toast.textContent = '✓ Đã sao chép!';
            toast.style.cssText = 'position:fixed;bottom:24px;right:24px;background:#1e293b;color:white;padding:.6rem 1.2rem;border-radius:8px;font-size:.85rem;font-weight:600;z-index:9999;animation:fadeIn .2s';
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 2000);
        });
    }
    </script>
    @endpush
</x-app-layout>
