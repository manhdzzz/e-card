<x-app-layout>
    <x-slot name="title">Quản lý danh thiếp</x-slot>

    @push('styles')
    <style>
        .page-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:1.5rem; }
        .page-title { font-size:1.5rem; font-weight:800; color:var(--e-navy); }
        .page-subtitle { font-size:.85rem; color:#64748b; margin-top:.15rem; }
        .cards-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(300px,1fr)); gap:1.3rem; }
        .ecard {
            background:white; border-radius:14px; overflow:hidden;
            border:1px solid #e2e8f0; transition:all .25s;
            display:flex; flex-direction:column;
        }
        .ecard:hover { box-shadow:0 10px 30px rgba(0,28,64,.12); transform:translateY(-3px); }
        .ecard-header {
            background: var(--e-navy);
            padding:1.4rem; display:flex; align-items:center; gap:.9rem;
            position:relative;
        }
        .ecard-avatar {
            width:54px; height:54px; border-radius:50%;
            border:3px solid rgba(255, 193, 7,.4);
            background:rgba(255,255,255,.1);
            display:flex; align-items:center; justify-content:center;
            color:var(--e-gold); font-weight:800; font-size:1.2rem; flex-shrink:0; overflow:hidden;
        }
        .ecard-avatar img { width:100%; height:100%; object-fit:cover; }
        .ecard-name { color:white; font-weight:800; font-size:1rem; letter-spacing:.3px; }
        .ecard-title { color:var(--e-gold); font-size:.78rem; margin-top:.1rem; font-weight: 600; }
        .ecard-company { color:rgba(255,255,255,.7); font-size:.75rem; margin-top:.2rem; }
        .ecard-body { padding:1rem; flex:1; }
        .ecard-info { display:flex; flex-direction:column; gap:.4rem; margin-bottom:.8rem; }
        .ecard-info-item { display:flex; align-items:center; gap:.6rem; font-size:.8rem; color:#64748b; }
        .ecard-info-item i { color:var(--e-navy); width:14px; font-size:.8rem; }
        .ecard-footer {
            padding:.75rem 1rem; border-top:1px solid #f1f5f9;
            display:flex; align-items:center; gap:.5rem;
        }
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; font-weight: 700; border-radius: 8px; transition: 0.2s; text-decoration: none !important; cursor: pointer; border: none; padding: .5rem 1rem; }
        .btn-primary { background: var(--e-gold) !important; color: #000 !important; }
        .btn-primary:hover { background: #e6ae00 !important; color: #000 !important; }
        .btn-outline { background: transparent !important; border: 1px solid #d1d9e6 !important; color: #64748b !important; }
        .btn-outline:hover { background: #f8fafc !important; color: var(--e-navy) !important; }
        .btn-gray { background: #f1f5f9 !important; color: #475569 !important; }
        .btn-gray:hover { background: #e2e8f0 !important; color: #1e293b !important; }
        .btn-danger { background: #fee2e2 !important; color: #ef4444 !important; }
        .btn-danger:hover { background: #fecaca !important; color: #b91c1c !important; }
        
        .stat-chip {
            position:absolute; top:.6rem; right:.8rem;
            background:rgba(255, 193, 7, 0.2); backdrop-filter:blur(4px);
            color:var(--e-gold); font-size:.7rem; font-weight:700;
            padding:.2rem .6rem; border-radius:20px;
            display:flex; align-items:center; gap:.3rem;
        }
        .visibility-badge {
            position:absolute; bottom:.6rem; right:.8rem;
            font-size:.62rem; font-weight:700; padding:.15rem .5rem;
            border-radius:6px; display:flex; align-items:center; gap:.25rem;
            text-transform: uppercase; letter-spacing: .3px;
        }
        .visibility-badge.public { background: rgba(255,255,255,.1); color: white; border: 1px solid rgba(255,255,255,.2); }
        .visibility-badge.private { background: rgba(0,0,0,.3); color: rgba(255,255,255,.8); border: 1px solid rgba(255,255,255,.1); }
        .empty-state {
            grid-column:1/-1; text-align:center; padding:4rem 2rem;
            background:white; border-radius:14px; border:2px dashed #e2e8f0;
        }
        .empty-state-icon { width:72px; height:72px; background:#f8faff; border-radius:50%; margin:0 auto 1rem; display:flex; align-items:center; justify-content:center; color:var(--ecard-navy); font-size:1.8rem; }
        .empty-state h3 { font-size:1.1rem; font-weight:700; color:var(--ecard-navy); margin-bottom:.4rem; }
        .empty-state p { color:#64748b; font-size:.85rem; margin-bottom:1.3rem; }
        .btn-primary { background: var(--ecard-navy); color: #fff; }
        .btn-primary:hover { background: #001026; }
    </style>
    @endpush

    <!-- Page Header -->
    <div class="breadcrumb">
        <a href="{{ url('/') }}">Trang chủ</a>
        <span>/</span>
        <span>Quản lý danh thiếp</span>
    </div>

    <div class="page-header">
        <div>
            <h1 class="page-title">Danh thiếp của tôi</h1>
            <p class="page-subtitle">Quản lý tất cả danh thiếp điện tử của bạn</p>
        </div>
        <a href="{{ route('cards.create') }}" class="btn btn-primary btn-lg">
            <i class="fa-solid fa-plus"></i> Tạo danh thiếp
        </a>
    </div>

    <!-- Cards Grid -->
    <div class="cards-grid">
        @forelse($cards as $card)
        <div class="ecard">
            <div class="ecard-header">
                <div class="ecard-avatar">
                    @if($card->avatar)
                        <img src="{{ Storage::url($card->avatar) }}" alt="{{ $card->full_name }}">
                    @else
                        {{ strtoupper(substr($card->full_name, 0, 1)) }}
                    @endif
                </div>
                <div>
                    <div class="ecard-name">{{ strtoupper($card->full_name) }}</div>
                    @if($card->job_title)<div class="ecard-title">{{ $card->job_title }}</div>@endif
                    @if($card->company)<div class="ecard-company">{{ $card->company }}</div>@endif
                </div>
                <div class="stat-chip"><i class="fa-solid fa-eye"></i> {{ number_format($card->view_count ?? 0) }}</div>
                <div class="visibility-badge {{ $card->is_active ? 'public' : 'private' }}">
                    <i class="fa-solid fa-eye{{ $card->is_active ? '' : '-slash' }}"></i>
                    {{ $card->is_active ? 'Công khai' : 'Riêng tư' }}
                </div>
            </div>
            <div class="ecard-body">
                <div class="ecard-info">
                    @if($card->phone)<div class="ecard-info-item"><i class="fa-solid fa-phone"></i> {{ $card->phone }}</div>@endif
                    @if($card->email)<div class="ecard-info-item"><i class="fa-regular fa-envelope"></i> {{ $card->email }}</div>@endif
                    @if($card->address)<div class="ecard-info-item"><i class="fa-solid fa-location-dot"></i> {{ $card->address }}</div>@endif
                    @if($card->website)<div class="ecard-info-item"><i class="fa-solid fa-globe"></i> {{ $card->website }}</div>@endif
                </div>
            </div>
            <div class="ecard-footer">
                <a href="{{ route('cards.public', $card->slug) }}" class="btn btn-outline" style="font-size:.78rem;padding:.45rem .6rem">
                    <i class="fa-regular fa-eye"></i> Xem
                </a>
                <a href="{{ route('cards.share', $card) }}" class="btn btn-gray">
                    <i class="fa-solid fa-share-nodes"></i> Chia sẻ
                </a>
                <a href="{{ route('cards.edit', $card) }}" class="btn btn-primary">
                    <i class="fa-regular fa-pen-to-square"></i> Sửa
                </a>
                <form action="{{ route('cards.destroy', $card) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa danh thiếp này?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger" style="padding:.45rem .6rem">
                        <i class="fa-regular fa-trash-can"></i>
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="empty-state">
            <div class="empty-state-icon"><i class="fa-solid fa-address-card"></i></div>
            <h3>Chưa có danh thiếp nào</h3>
            <p>Hãy tạo danh thiếp điện tử đầu tiên của bạn để bắt đầu chia sẻ thông tin một cách chuyên nghiệp.</p>
            <a href="{{ route('cards.create') }}" class="btn btn-primary btn-lg">
                <i class="fa-solid fa-plus"></i> Tạo danh thiếp ngay
            </a>
        </div>
        @endforelse
    </div>
</x-app-layout>
