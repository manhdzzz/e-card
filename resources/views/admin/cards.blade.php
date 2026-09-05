<x-admin-layout>
    <x-slot name="title">Quản lý danh thiếp</x-slot>

    @push('styles')
    <style>
        .page-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:1.2rem; }
        .filter-bar { background:white; border-radius:12px; border:1px solid #e2e8f0; padding:1rem 1.2rem; margin-bottom:1rem; display:flex; align-items:center; gap:.7rem; flex-wrap:wrap; }
        .filter-search { flex:1; min-width:240px; position:relative; }
        .filter-search i { position:absolute; left:11px; top:50%; transform:translateY(-50%); color:#94a3b8; font-size:.85rem; }
        .filter-search input { width:100%; padding:.55rem .9rem .55rem 2.3rem; border:1.5px solid #e2e8f0; border-radius:8px; font-size:.85rem; font-family:inherit; outline:none; transition:border-color .2s; }
        .filter-search input:focus { border-color:#2563eb; }
        .filter-select { padding:.55rem .9rem; border:1.5px solid #e2e8f0; border-radius:8px; font-size:.85rem; font-family:inherit; outline:none; color:#64748b; background:white; min-width:150px; }
        .table-wrap { background:white; border-radius:12px; border:1px solid #e2e8f0; overflow:hidden; }
        /* Card thumbnail */
        .card-thumb {
            width: 100px;
            height: 63px;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
            flex-shrink: 0;
        }
        .ct-bg { width:100%; height:100%; display:flex; align-items:center; justify-content:center; position:relative; }
        .ct-name { position:absolute; bottom:3px; left:3px; right:3px; color:white; font-size:.55rem; font-weight:800; letter-spacing:.3px; line-height:1.1; }
        .ct-job { color:rgba(255,255,255,.7); font-size:.5rem; }
        .ct-avatar { width:22px; height:22px; border-radius:50%; border:2px solid rgba(255,255,255,.4); background:rgba(255,255,255,.2); position:absolute; top:4px; left:6px; display:flex; align-items:center; justify-content:center; color:white; font-size:.6rem; font-weight:700; overflow:hidden; }
        .ct-avatar img { width:100%; height:100%; object-fit:cover; }
        /* Owner info */
        .owner-name { font-size:.83rem; font-weight:600; color:#1e293b; }
        .owner-email { font-size:.73rem; color:#94a3b8; margin-top:.1rem; }
        /* Status badge */
        .status-badge { padding:.2rem .65rem; border-radius:20px; font-size:.72rem; font-weight:700; white-space:nowrap; }
        .sb-published { background:#dcfce7; color:#16a34a; }
        .sb-draft { background:#fef9c3; color:#ca8a04; }
        .sb-private { background:#f1f5f9; color:#64748b; }
        /* Action buttons */
        .action-btns { display:flex; align-items:center; gap:.4rem; }
        .action-btn { width:32px; height:32px; border-radius:8px; display:flex; align-items:center; justify-content:center; border:none; cursor:pointer; font-size:.85rem; text-decoration:none; transition:all .15s; }
        .ab-view { background:#eff6ff; color:#2563eb; }
        .ab-view:hover { background:#dbeafe; }
        .ab-edit { background:#fff7ed; color:#f97316; }
        .ab-edit:hover { background:#ffedd5; }
        .ab-delete { background:#fef2f2; color:#ef4444; }
        .ab-delete:hover { background:#fee2e2; }
        .pag-select { border:1.5px solid #e2e8f0; border-radius:8px; padding:.3rem .6rem; font-size:.78rem; font-family:inherit; outline:none; color:#64748b; }
        /* Delete modal */
        .modal-overlay { position:fixed; inset:0; background:rgba(0,0,0,.45); z-index:1000; display:flex; align-items:center; justify-content:center; padding:1rem; }
        .modal { background:white; border-radius:16px; padding:1.5rem; max-width:400px; width:100%; box-shadow:0 20px 60px rgba(0,0,0,.2); }
        .modal-icon { width:56px; height:56px; border-radius:50%; background:#fef2f2; display:flex; align-items:center; justify-content:center; margin:0 auto .9rem; color:#ef4444; font-size:1.4rem; }
        .modal-title { font-size:1rem; font-weight:700; color:#1e293b; text-align:center; margin-bottom:.4rem; }
        .modal-sub { font-size:.83rem; color:#64748b; text-align:center; margin-bottom:1.2rem; line-height:1.6; }
        .modal-actions { display:flex; gap:.7rem; }
        .modal-actions .btn { flex:1; justify-content:center; }
    </style>
    @endpush

    <div class="breadcrumb">
        <a href="{{ route('admin.dashboard') }}">Trang chủ</a><span>/</span>
        <span>Quản lý danh thiếp</span>
    </div>

    <div class="page-header">
        <div>
            <h1 style="font-size:1.4rem;font-weight:800;color:#1e293b">Quản lý danh thiếp</h1>
            <p style="font-size:.82rem;color:#64748b;margin-top:.15rem">Theo dõi, quản lý và kiểm soát tất cả danh thiếp trong hệ thống.</p>
        </div>
        <a href="{{ route('admin.cards.export') }}" class="btn btn-primary"><i class="fa-solid fa-download"></i> Xuất danh sách</a>
    </div>

    <!-- Filters -->
    <form action="{{ route('admin.cards') }}" method="GET" class="filter-bar">
        <div class="filter-search">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" name="search" placeholder="Tìm kiếm theo tên, email hoặc công ty..." value="{{ request('search') }}">
        </div>
        <select name="status" class="filter-select">
            <option value="all" {{ request('status') === 'all' ? 'selected' : '' }}>Tất cả trạng thái</option>
            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Đã xuất bản</option>
            <option value="hidden" {{ request('status') === 'hidden' ? 'selected' : '' }}>Đang ẩn</option>
        </select>
        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i> Tìm kiếm</button>
        <a href="{{ route('admin.cards') }}" class="btn btn-gray"><i class="fa-solid fa-rotate"></i> Xóa bộ lọc</a>
    </form>

    <!-- Table -->
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th style="width:40px"><input type="checkbox" style="accent-color:#2563eb"></th>
                    <th>STT</th>
                    <th>Danh thiếp</th>
                    <th>Chủ sở hữu</th>
                    <th>Công ty</th>
                    <th>Ngày cập nhật</th>
                    <th>Lượt xem</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cards ?? [] as $i => $card)
                <tr>
                    <td><input type="checkbox" style="accent-color:#2563eb"></td>
                    <td style="color:#94a3b8;font-size:.8rem">{{ $i+1 }}</td>
                    <td>
                        <div class="card-thumb">
                            <div class="ct-bg" style="background:linear-gradient(135deg,#2563eb,#60a5fa)">
                                <div class="ct-avatar">
                                    @if($card->avatar)
                                        <img src="{{ Storage::url($card->avatar) }}" alt="">
                                    @else
                                        {{ strtoupper(substr($card->full_name, 0, 1)) }}
                                    @endif
                                </div>
                                <div class="ct-name">{{ strtoupper($card->full_name) }}<div class="ct-job">{{ $card->job_title }}</div></div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="owner-name">{{ $card->user->name }}</div>
                        <div class="owner-email">{{ $card->user->email }}</div>
                    </td>
                    <td style="font-size:.83rem;color:#64748b;max-width:140px">{{ $card->company ?: '—' }}</td>
                    <td style="font-size:.8rem;color:#64748b;white-space:nowrap">
                        {{ $card->updated_at->format('d/m/Y') }}<br>
                        <span style="color:#94a3b8">{{ $card->updated_at->format('H:i:s') }}</span>
                    </td>
                    <td style="font-weight:700;color:#2563eb">
                        {{ number_format($card->view_count ?? 0) }}
                    </td>
                    <td>
                        @if(!$card->user->is_active)
                            <span class="status-badge" style="background:#fee2e2;color:#dc2626;font-size:.7rem">
                                <i class="fa-solid fa-user-slash"></i> User Banned
                            </span>
                        @elseif(!$card->is_active)
                            <span class="status-badge" style="background:#f1f5f9;color:#64748b;font-size:.7rem">
                                <i class="fa-solid fa-eye-slash"></i> Đang ẩn
                            </span>
                        @else
                            <span class="status-badge sb-published" style="font-size:.7rem">
                                <i class="fa-solid fa-check"></i> Đã xuất bản
                            </span>
                        @endif
                    </td>
                    <td>
                        <div class="action-btns">
                            <a href="{{ route('cards.public', $card->slug) }}" class="action-btn ab-view"><i class="fa-regular fa-eye"></i></a>
                            <a href="{{ route('cards.edit', $card) }}" class="action-btn ab-edit"><i class="fa-regular fa-pen-to-square"></i></a>
                            <button class="action-btn ab-delete" onclick="confirmDelete({{ $card->id }}, '{{ $card->full_name }}')"><i class="fa-regular fa-trash-can"></i></button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" style="text-align:center; padding:3rem; color:#94a3b8; font-size:.9rem;">
                        <i class="fa-solid fa-magnifying-glass" style="font-size:2.5rem; display:block; margin-bottom:1rem; opacity:.3;"></i>
                        Không tìm thấy danh thiếp nào phù hợp với yêu cầu của bạn.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div style="padding: 1rem 1.3rem;">
            {{ $cards->links('vendor.pagination.custom') }}
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="modal-overlay" style="display:none" onclick="if(event.target===this)closeModal()">
        <div class="modal">
            <div class="modal-icon"><i class="fa-solid fa-trash-can"></i></div>
            <div class="modal-title">Xác nhận xóa danh thiếp</div>
            <div class="modal-sub">Bạn có chắc chắn muốn xóa danh thiếp của <strong id="deleteCardName" style="color:#ef4444"></strong>? Hành động này không thể hoàn tác.</div>
            <div class="modal-actions">
                <button class="btn btn-gray" onclick="closeModal()">Hủy</button>
                <form id="deleteForm" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger">Xóa danh thiếp</button>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    function showDeleteModal(name, id = null) {
        document.getElementById('deleteCardName').textContent = name;
        if(id) document.getElementById('deleteForm').action = `/admin/cards/${id}`;
        document.getElementById('deleteModal').style.display = 'flex';
    }
    function confirmDelete(id, name) { showDeleteModal(name, id); }
    function closeModal() { document.getElementById('deleteModal').style.display = 'none'; }
    </script>
    @endpush
</x-admin-layout>
