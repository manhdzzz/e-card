<x-app-layout>
    <x-slot name="title">Chia sẻ danh thiếp</x-slot>

    @push('styles')
    <style>
        .share-layout { display:grid; grid-template-columns:340px 1fr; gap:1.5rem; align-items:start; }
        /* Mini card preview */
        .mini-card { background:white; border-radius:16px; border:1px solid #e2e8f0; overflow:hidden; box-shadow:0 6px 20px rgba(37,99,235,.1); }
        .mc-header { background:linear-gradient(135deg,#2563eb,#60a5fa); padding:1.5rem; text-align:center; }
        .mc-avatar { width:72px; height:72px; border-radius:50%; border:3px solid rgba(255,255,255,.4); background:rgba(255,255,255,.2); margin:0 auto .7rem; display:flex; align-items:center; justify-content:center; color:white; font-weight:800; font-size:1.8rem; overflow:hidden; }
        .mc-avatar img { width:100%; height:100%; object-fit:cover; }
        .mc-name { color:white; font-weight:800; font-size:1rem; letter-spacing:.4px; }
        .mc-job { color:rgba(255,255,255,.8); font-size:.78rem; margin-top:.2rem; }
        .mc-company { color:rgba(255,255,255,.7); font-size:.75rem; margin-top:.15rem; }
        .mc-body { padding:1rem 1.2rem; }
        .mc-info-row { display:flex; align-items:center; gap:.55rem; padding:.35rem 0; font-size:.8rem; color:#64748b; border-bottom:1px solid #f8faff; }
        .mc-info-row:last-child { border-bottom:none; }
        .mc-info-row i { color:#2563eb; width:13px; font-size:.78rem; }
        .mc-socials { display:flex; justify-content:center; gap:.5rem; padding:.7rem 0 .3rem; }
        .mc-soc { width:30px; height:30px; border-radius:50%; display:flex; align-items:center; justify-content:center; color:white; font-size:.8rem; }
        /* Share panel */
        .share-panel { display:flex; flex-direction:column; gap:1rem; }
        .share-card { background:white; border-radius:14px; border:1px solid #e2e8f0; padding:1.3rem; }
        .share-section-title { display:flex; align-items:center; gap:.5rem; font-size:.9rem; font-weight:700; color:#1e293b; margin-bottom:.5rem; }
        .share-section-sub { font-size:.8rem; color:#64748b; margin-bottom:1rem; }
        /* Link box */
        .link-box { display:flex; gap:.5rem; }
        .link-input { flex:1; padding:.65rem .9rem; border:1.5px solid #e2e8f0; border-radius:9px; font-size:.85rem; color:#64748b; background:#f8faff; outline:none; font-family:inherit; }
        .copy-btn { padding:.65rem 1rem; background:#eff6ff; border:1.5px solid #bfdbfe; border-radius:9px; color:#2563eb; font-size:.85rem; font-weight:700; cursor:pointer; display:flex; align-items:center; gap:.4rem; white-space:nowrap; transition:background .2s; }
        .copy-btn:hover { background:#dbeafe; }
        /* QR section */
        .qr-section { display:flex; gap:1.5rem; align-items:center; }
        .qr-img-wrap img { width:160px; height:160px; border-radius:10px; border:1px solid #e2e8f0; }
        .qr-actions { display:flex; flex-direction:column; gap:.7rem; flex:1; }
        /* Social share */
        .social-share-grid { display:grid; grid-template-columns:1fr 1fr; gap:.6rem; margin-top:1rem; }
        .ss-btn { display:flex; align-items:center; justify-content:center; gap:.5rem; padding:.7rem; border-radius:9px; text-decoration:none; color:white; font-weight:700; font-size:.85rem; transition:opacity .2s; }
        .ss-btn:hover { opacity:.88; }
        .ss-other { background:#f1f5f9; color:#1e293b; border:1.5px solid #e2e8f0; }
        .ss-other:hover { background:#e2e8f0; opacity:1; }
        .divider-text { text-align:center; font-size:.78rem; color:#94a3b8; margin:.6rem 0; }
    </style>
    @endpush

    <div class="breadcrumb">
        <a href="{{ url('/') }}">Trang chủ</a><span>/</span>
        <a href="{{ route('cards.index') }}">Danh thiếp</a><span>/</span>
        <span>Chia sẻ danh thiếp</span>
    </div>

    <div style="margin-bottom:1.2rem">
        <h1 style="display:flex;align-items:center;gap:.6rem;font-size:1.5rem;font-weight:800;color:#1e293b">
            <i class="fa-solid fa-share-nodes" style="color:#2563eb"></i> Chia sẻ danh thiếp
        </h1>
        <p style="font-size:.85rem;color:#64748b;margin-top:.15rem">Chia sẻ thông tin của bạn với mọi người một cách nhanh chóng và chuyên nghiệp.</p>
    </div>

    <div class="share-layout">
        <!-- Mini Card Preview -->
        <div class="mini-card">
            <div class="mc-header">
                <div class="mc-avatar">
                    @if($card->avatar)
                        <img src="{{ Storage::url($card->avatar) }}" alt="">
                    @else
                        {{ strtoupper(substr($card->full_name,0,1)) }}
                    @endif
                </div>
                <div class="mc-name">{{ strtoupper($card->full_name) }}</div>
                @if($card->job_title)<div class="mc-job">{{ $card->job_title }}</div>@endif
                @if($card->company)<div class="mc-company">{{ $card->company }}</div>@endif
            </div>
            <div class="mc-body">
                @if($card->phone)<div class="mc-info-row"><i class="fa-solid fa-phone"></i> {{ $card->phone }}</div>@endif
                @if($card->email)<div class="mc-info-row"><i class="fa-regular fa-envelope"></i> {{ $card->email }}</div>@endif
                @if($card->address)<div class="mc-info-row"><i class="fa-solid fa-location-dot"></i> {{ $card->address }}</div>@endif
                @if($card->facebook_url || $card->zalo_url || $card->linkedin_url)
                <div class="mc-socials">
                    @if($card->facebook_url)<div class="mc-soc" style="background:#1877f2"><i class="fa-brands fa-facebook-f"></i></div>@endif
                    @if($card->zalo_url)<div class="mc-soc" style="background:#0d9488"><span style="font-size:.6rem;font-weight:900">Zalo</span></div>@endif
                    @if($card->linkedin_url)<div class="mc-soc" style="background:#0077b5"><i class="fa-brands fa-linkedin-in"></i></div>@endif
                </div>
                @endif
            </div>
        </div>

        <!-- Share Options -->
        <div class="share-panel">
            <!-- Link share -->
            <div class="share-card">
                <div class="share-section-title">
                    <i class="fa-solid fa-link" style="color:#2563eb"></i> Link danh thiếp
                </div>
                <p class="share-section-sub">Bất kỳ ai có đường link này đều có thể xem danh thiếp của bạn.</p>
                <div class="link-box">
                    <input type="text" class="link-input" value="{{ route('cards.public', $card->slug) }}" readonly id="shareLink">
                    <button class="copy-btn" onclick="copyLink()">
                        <i class="fa-regular fa-copy"></i> Sao chép
                    </button>
                </div>
            </div>

            <!-- QR Code -->
            <div class="share-card">
                <div class="share-section-title">
                    <i class="fa-solid fa-qrcode" style="color:#2563eb"></i> Mã QR danh thiếp
                </div>
                <p class="share-section-sub">Quét mã để xem danh thiếp trên điện thoại.</p>
                <div class="qr-section">
                    <div class="qr-img-wrap">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=160x160&data={{ urlencode(route('cards.public', $card->slug)) }}" alt="QR Code">
                    </div>
                    <div class="qr-actions">
                        <a href="https://api.qrserver.com/v1/create-qr-code/?size=400x400&data={{ urlencode(route('cards.public', $card->slug)) }}" download="qr-{{ $card->slug }}.png" class="btn btn-primary btn-lg" style="justify-content:center">
                            <i class="fa-solid fa-download"></i> Tải QR về máy
                        </a>
                        <button class="btn btn-outline btn-lg" style="justify-content:center">
                            <i class="fa-solid fa-share-nodes"></i> Chia sẻ qua mạng xã hội
                        </button>
                    </div>
                </div>

                <div class="divider-text">Hoặc chia sẻ nhanh</div>
                <div class="social-share-grid">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('cards.public', $card->slug)) }}" target="_blank" class="ss-btn" style="background:#1877f2">
                        <i class="fa-brands fa-facebook-f"></i> Facebook
                    </a>
                    <a href="https://zalo.me/share?url={{ urlencode(route('cards.public', $card->slug)) }}" target="_blank" class="ss-btn" style="background:#0d9488">
                        <span style="font-weight:900">Zalo</span> Zalo
                    </a>
                    <a href="https://wa.me/?text={{ urlencode(route('cards.public', $card->slug)) }}" target="_blank" class="ss-btn" style="background:#25d366">
                        <i class="fa-brands fa-whatsapp"></i> WhatsApp
                    </a>
                    <button class="ss-btn ss-other" onclick="nativeShare()">
                        <i class="fa-solid fa-share-nodes"></i> Khác
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    function copyLink() {
        const link = document.getElementById('shareLink').value;
        navigator.clipboard.writeText(link).then(() => {
            const toast = document.createElement('div');
            toast.textContent = '✓ Đã sao chép link!';
            toast.style.cssText = 'position:fixed;bottom:24px;right:24px;background:#1e293b;color:white;padding:.6rem 1.2rem;border-radius:8px;font-size:.85rem;font-weight:600;z-index:9999';
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 2000);
        });
    }
    function nativeShare() {
        if (navigator.share) {
            navigator.share({ title: '{{ $card->full_name }} - Danh thiếp điện tử', url: '{{ route("cards.public", $card->slug) }}' });
        } else {
            copyLink();
        }
    }
    </script>
    @endpush
</x-app-layout>
