<x-enterprise-layout>
    <x-slot name="title">Danh thiếp nhân viên</x-slot>

    <div class="breadcrumb">
        <a href="{{ route('enterprise.dashboard') }}">Doanh nghiệp</a><span>/</span>
        <span>Danh thiếp</span>
    </div>

    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 1.5rem; font-weight: 800; color: var(--e-navy);">Danh thiếp nhân viên</h1>
        <p style="font-size: .85rem; color: #64748b; margin-top: .15rem;">Quản lý và theo dõi hiệu quả sử dụng danh thiếp của toàn bộ nhân viên.</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem;">
        @forelse($cards as $card)
        <div style="background: white; border-radius: 16px; border: 1px solid #e2e8f0; overflow: hidden; display: flex; flex-direction: column; transition: transform .2s, box-shadow .2s; cursor: pointer;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,.05)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
            <div style="height: 100px; background: linear-gradient(135deg, var(--e-navy), #0a3d6b); position: relative;">
                <div style="position: absolute; bottom: -30px; left: 20px; width: 70px; height: 70px; border-radius: 50%; border: 4px solid white; overflow: hidden; background: #f1f5f9;">
                    @if($card->avatar)
                        <img src="{{ asset('storage/' . $card->avatar) }}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; font-weight: 800; color: #cbd5e1;">
                            {{ strtoupper(substr($card->full_name, 0, 1)) }}
                        </div>
                    @endif
                </div>
                <div style="position: absolute; bottom: 10px; right: 15px; color: rgba(255,255,255,0.7); font-size: .7rem; font-weight: 700;">
                    ID: #{{ $card->id }}
                </div>
            </div>
            
            <div style="padding: 40px 20px 20px;">
                <div style="font-size: 1.1rem; font-weight: 800; color: var(--e-navy); margin-bottom: .2rem;">{{ $card->full_name }}</div>
                <div style="font-size: .8rem; color: #64748b; font-weight: 600; margin-bottom: .8rem;">{{ $card->job_title }} @ {{ $card->company }}</div>
                
                <div style="display: flex; flex-direction: column; gap: .5rem; border-top: 1px solid #f1f5f9; padding-top: 1rem;">
                    <div style="display: flex; align-items: center; gap: .6rem; font-size: .78rem; color: #475569;">
                        <i class="ti ti-mail" style="color: #94a3b8;"></i> {{ $card->email }}
                    </div>
                    <div style="display: flex; align-items: center; gap: .6rem; font-size: .78rem; color: #475569;">
                        <i class="ti ti-phone" style="color: #94a3b8;"></i> {{ $card->phone }}
                    </div>
                </div>

                <div style="margin-top: 1.2rem; display: flex; align-items: center; justify-content: space-between; background: #f8fafc; padding: .6rem .8rem; border-radius: 10px;">
                    <div style="font-size: .7rem; font-weight: 700; color: #94a3b8; text-transform: uppercase;">Lượt xem</div>
                    <div style="font-size: .95rem; font-weight: 800; color: var(--e-navy);">{{ number_format($card->view_count) }}</div>
                </div>

                <div style="margin-top: 1rem; display: flex; gap: .5rem;">
                    <a href="{{ route('cards.public', $card->slug) }}" target="_blank" class="btn btn-gray" style="flex: 1; font-size: .75rem; padding: .4rem;">
                        <i class="ti ti-external-link"></i> Xem mẫu
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div style="grid-column: 1 / -1; text-align: center; padding: 4rem; background: white; border-radius: 16px; border: 1px dashed #cbd5e1;">
            <i class="ti ti-id-badge" style="font-size: 4rem; color: #cbd5e1; display: block; margin-bottom: 1rem;"></i>
            <h3 style="color: var(--e-navy); font-weight: 800;">Chưa có danh thiếp nào</h3>
            <p style="color: #64748b; font-size: .9rem;">Hãy yêu cầu nhân viên tạo danh thiếp sau khi được cấp tài khoản.</p>
        </div>
        @endforelse
    </div>

    @if($cards->hasPages())
    <div style="margin-top: 2rem;">
        {{ $cards->links() }}
    </div>
    @endif
</x-enterprise-layout>
