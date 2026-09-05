<x-app-layout>
    <x-slot name="title">Bảng điều khiển</x-slot>

    @push('styles')
    <style>
        .db-header { background: linear-gradient(135deg, var(--e-navy) 0%, #0a3d6b 100%); border-radius: 14px; padding: 2rem; color: white; display: flex; align-items: center; justify-content: space-between; margin-bottom: 2rem; box-shadow: 0 10px 30px rgba(5, 37, 66, 0.15); }
        .db-welcome h1 { margin: 0; font-size: 1.8rem; font-weight: 800; color: white; }
        .db-welcome p { margin: .5rem 0 0 0; color: rgba(255,255,255,0.8); font-size: .95rem; }
        
        .db-stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; margin-bottom: 2.5rem; }
        .db-stat-card { background: white; border-radius: 12px; padding: 1.5rem; border: 1px solid #e2e8f0; display: flex; align-items: center; gap: 1rem; box-shadow: 0 4px 15px rgba(0,0,0,0.02); }
        .db-stat-icon { width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; }
        .db-stat-info h3 { margin: 0; font-size: .75rem; text-transform: uppercase; color: #64748b; font-weight: 700; letter-spacing: .5px; }
        .db-stat-info p { margin: .2rem 0 0 0; font-size: 1.5rem; font-weight: 900; color: var(--e-navy); }
        
        .db-section { margin-bottom: 2.5rem; }
        .db-section-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.2rem; }
        .db-section-header h2 { margin: 0; font-size: 1.25rem; font-weight: 800; color: var(--e-navy); display: flex; align-items: center; gap: .5rem; }
        .db-section-header a { font-size: .85rem; color: #2563eb; font-weight: 600; text-decoration: none; display: flex; align-items: center; gap: .3rem; }
        .db-section-header a:hover { text-decoration: underline; }
        
        /* Guide Cards */
        .guide-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; }
        .guide-item { background: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 1.5rem; display: flex; gap: 1rem; align-items: flex-start; }
        .guide-num { width: 36px; height: 36px; border-radius: 10px; background: #eff6ff; color: #2563eb; font-weight: 800; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 1.1rem; }
        .guide-content h4 { margin: 0; font-size: .95rem; font-weight: 700; color: #1e293b; }
        .guide-content p { margin: .3rem 0 0 0; font-size: .8rem; color: #64748b; line-height: 1.5; }
        
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; font-weight: 700; border-radius: 8px; transition: 0.2s; text-decoration: none !important; cursor: pointer; border: none; padding: .6rem 1.2rem; }
        .btn-primary { background: var(--e-gold) !important; color: #000 !important; }
        .btn-primary:hover { background: #e6ae00 !important; color: #000 !important; }
        
        /* Card UI logic */
        .cards-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:1.3rem; }
        .ecard { background:white; border-radius:14px; overflow:hidden; border:1px solid #e2e8f0; transition:all .25s; display:flex; flex-direction:column; }
        .ecard:hover { box-shadow:0 10px 30px rgba(0,28,64,.12); transform:translateY(-3px); }
        .ecard-header { background: var(--e-navy); padding:1.4rem; display:flex; align-items:center; gap:.9rem; position:relative; }
        .ecard-avatar { width:54px; height:54px; border-radius:50%; border:3px solid rgba(255, 193, 7,.4); background:rgba(255,255,255,.1); display:flex; align-items:center; justify-content:center; color:var(--e-gold); font-weight:800; font-size:1.2rem; flex-shrink:0; overflow:hidden; }
        .ecard-avatar img { width:100%; height:100%; object-fit:cover; }
        .ecard-name { color:white; font-weight:800; font-size:1rem; letter-spacing:.3px; }
        .ecard-title { color:var(--e-gold); font-size:.78rem; margin-top:.1rem; font-weight: 600; }
        .ecard-body { padding:1rem; flex:1; }
        .ecard-info-item { display:flex; align-items:center; gap:.6rem; font-size:.8rem; color:#64748b; margin-bottom:.5rem; }
        .ecard-info-item i { color:var(--e-navy); width:14px; font-size:.8rem; }
        .ecard-footer { padding:.75rem 1rem; border-top:1px solid #f1f5f9; display:flex; align-items:center; justify-content: space-between; }
        .stat-chip { position:absolute; top:.6rem; right:.8rem; background:rgba(255, 193, 7, 0.2); color:var(--e-gold); font-size:.7rem; font-weight:700; padding:.2rem .6rem; border-radius:20px; display:flex; align-items:center; gap:.3rem; }
        
        .empty-cards { background: white; border: 2px dashed #cbd5e1; border-radius: 14px; padding: 3rem; text-align: center; }
        .empty-cards i { font-size: 3rem; color: #94a3b8; margin-bottom: 1rem; }
        .empty-cards h3 { margin: 0; font-size: 1.2rem; font-weight: 800; color: #1e293b; }
        .empty-cards p { margin: .5rem 0 1.5rem 0; color: #64748b; font-size: .9rem; }
        
        @media(max-width: 960px) {
            .db-header { flex-direction: column; text-align: center; gap: 1.5rem; }
            .db-stats { grid-template-columns: 1fr; }
            .guide-grid { grid-template-columns: 1fr; }
            .cards-grid { grid-template-columns: 1fr; }
        }
    </style>
    @endpush

    <div class="db-header">
        <div class="db-welcome">
            <h1>Xin chào, {{ Auth::user()->name }}! 👋</h1>
            <p>Quản lý danh thiếp điện tử và đơn hàng của bạn tại đây.</p>
        </div>
        <a href="{{ route('cards.create') }}" class="btn btn-primary" style="padding: .8rem 1.5rem; font-size: 1rem;">
            <i class="ti ti-plus"></i> Tạo danh thiếp mới
        </a>
    </div>

    <div class="db-stats">
        <div class="db-stat-card">
            <div class="db-stat-icon" style="background: #eff6ff; color: #2563eb;"><i class="ti ti-id-badge"></i></div>
            <div class="db-stat-info">
                <h3>Danh thiếp</h3>
                <p>{{ Auth::user()->cards()->count() }}</p>
            </div>
        </div>
        <div class="db-stat-card">
            <div class="db-stat-icon" style="background: #f0fdf4; color: #16a34a;"><i class="ti ti-eye"></i></div>
            <div class="db-stat-info">
                <h3>Lượt truy cập</h3>
                <p>{{ Auth::user()->cards()->sum('view_count') }}</p>
            </div>
        </div>
        <a href="{{ route('orders.index') }}" style="text-decoration: none;">
            <div class="db-stat-card" style="cursor: pointer;">
                <div class="db-stat-icon" style="background: #fffbeb; color: #d97706;"><i class="ti ti-shopping-cart"></i></div>
                <div class="db-stat-info">
                    <h3>Đơn đặt thẻ vật lý</h3>
                    <p>{{ \App\Models\Order::where('email', Auth::user()->email)->count() }}</p>
                </div>
            </div>
        </a>
    </div>

    <div class="db-section">
        <div class="db-section-header">
            <h2><i class="ti ti-cards"></i> Danh thiếp của bạn</h2>
            <a href="{{ route('cards.index') }}">Quản lý tất cả <i class="ti ti-arrow-right"></i></a>
        </div>
        
        @php $cards = Auth::user()->cards()->latest()->take(3)->get(); @endphp

        @if($cards->isEmpty())
        <div class="empty-cards">
            <i class="ti ti-id-badge-off"></i>
            <h3>Bạn chưa có danh thiếp nào</h3>
            <p>Tạo danh thiếp điện tử đầu tiên của bạn để kết nối không giới hạn.</p>
            <a href="{{ route('cards.create') }}" class="btn btn-primary">Tạo danh thiếp</a>
        </div>
        @else
        <div class="cards-grid">
            @foreach($cards as $card)
            <div class="ecard">
                <div class="ecard-header">
                    <div class="stat-chip"><i class="ti ti-eye"></i> {{ $card->view_count }}</div>
                    <div class="ecard-avatar">
                        @if($card->avatar)
                            <img src="{{ asset('storage/' . $card->avatar) }}" alt="">
                        @else
                            {{ strtoupper(substr($card->full_name, 0, 1)) }}
                        @endif
                    </div>
                    <div>
                        <div class="ecard-name">{{ $card->full_name }}</div>
                        <div class="ecard-title">{{ $card->job_title ?? 'Chưa cập nhật chức vụ' }}</div>
                    </div>
                </div>
                <div class="ecard-body">
                    <div class="ecard-info-item"><i class="ti ti-phone"></i> {{ $card->phone ?? '---' }}</div>
                    <div class="ecard-info-item"><i class="ti ti-mail"></i> {{ $card->email ?? '---' }}</div>
                </div>
                <div class="ecard-footer">
                    <a href="{{ route('cards.edit', $card) }}" class="btn" style="background: #f1f5f9; color: #475569; font-size: .8rem; padding: .4rem .8rem;"><i class="ti ti-edit"></i> Sửa</a>
                    <a href="{{ route('cards.public', $card->slug) }}" target="_blank" class="btn btn-primary" style="font-size: .8rem; padding: .4rem .8rem;">Xem thẻ</a>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    <div class="db-section">
        <div class="db-section-header">
            <h2><i class="ti ti-bulb"></i> Hướng dẫn bắt đầu</h2>
        </div>
        <div class="guide-grid">
            <div class="guide-item">
                <div class="guide-num">1</div>
                <div class="guide-content">
                    <h4>Tạo danh thiếp số</h4>
                    <p>Nhập thông tin cá nhân, liên hệ, ảnh đại diện và mạng xã hội.</p>
                </div>
            </div>
            <div class="guide-item">
                <div class="guide-num">2</div>
                <div class="guide-content">
                    <h4>Chia sẻ QR/Link</h4>
                    <p>Chia sẻ đường link công khai hoặc mã QR để đối tác dễ dàng lưu danh bạ.</p>
                </div>
            </div>
            <div class="guide-item">
                <div class="guide-num">3</div>
                <div class="guide-content">
                    <h4>Nâng cấp thẻ vật lý</h4>
                    <p>Đặt mua thẻ NFC có thiết kế in sẵn để quét/chạm nhanh thay thế thẻ giấy.</p>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>