<x-admin-layout>
    <x-slot name="title">Quản lý người dùng</x-slot>

    @push('styles')
    <style>
        .page-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:1.2rem; }
        .filter-bar { background:white; border-radius:12px; border:1px solid #e2e8f0; padding:1rem 1.2rem; margin-bottom:1rem; display:flex; align-items:center; gap:.7rem; flex-wrap:wrap; }
        .filter-search { flex:1; min-width:240px; position:relative; }
        .filter-search i { position:absolute; left:11px; top:50%; transform:translateY(-50%); color:#94a3b8; font-size:.85rem; }
        .filter-search input { width:100%; padding:.55rem .9rem .55rem 2.3rem; border:1.5px solid #e2e8f0; border-radius:8px; font-size:.85rem; font-family:inherit; outline:none; transition:border-color .2s; }
        .filter-search input:focus { border-color:#2563eb; }
        .filter-select { padding:.55rem .9rem; border:1.5px solid #e2e8f0; border-radius:8px; font-size:.85rem; font-family:inherit; outline:none; color:#64748b; background:white; min-width:150px; }
        .filter-select:focus { border-color:#2563eb; }
        .table-wrap { background:white; border-radius:12px; border:1px solid #e2e8f0; overflow:hidden; }
        .user-thumb { width:36px; height:36px; border-radius:50%; object-fit:cover; }
        .user-thumb-placeholder { width:36px; height:36px; border-radius:50%; background:#eff6ff; display:flex; align-items:center; justify-content:center; color:#2563eb; font-weight:700; font-size:.82rem; }
        .role-badge { padding:.2rem .65rem; border-radius:20px; font-size:.72rem; font-weight:700; }
        .role-admin { background:#fdf4ff; color:#a855f7; }
        .role-user { background:#eff6ff; color:#2563eb; }
        .status-toggle { display:flex; align-items:center; gap:.5rem; }
        .toggle { width:40px; height:22px; border-radius:11px; border:none; cursor:pointer; position:relative; transition:background .2s; }
        .toggle.on { background:#10b981; }
        .toggle.off { background:#d1d5db; }
        .toggle-dot { width:16px; height:16px; border-radius:50%; background:white; position:absolute; top:3px; transition:left .2s; }
        .toggle.on .toggle-dot { left:21px; }
        .toggle.off .toggle-dot { left:3px; }
        .status-text { font-size:.8rem; font-weight:700; }
        .status-active { color:#10b981; }
        .status-locked { color:#ef4444; }
        .action-btns { display:flex; align-items:center; gap:.4rem; }
        .action-btn { width:30px; height:30px; border-radius:7px; display:flex; align-items:center; justify-content:center; border:none; cursor:pointer; font-size:.82rem; text-decoration:none; transition:all .15s; }
        .ab-edit { background:#eff6ff; color:#2563eb; }
        .ab-edit:hover { background:#dbeafe; }
        .ab-lock { background:#fff7ed; color:#f97316; }
        .ab-lock:hover { background:#ffedd5; }
        .ab-delete { background:#fef2f2; color:#ef4444; }
        .ab-delete:hover { background:#fee2e2; }
        /* Pagination */
        .pagination { display:flex; align-items:center; justify-content:space-between; padding:.9rem 1.2rem; border-top:1px solid #f1f5f9; }
        .pag-info { font-size:.78rem; color:#64748b; }
        .pag-btns { display:flex; align-items:center; gap:.3rem; }
        .pag-btn { width:32px; height:32px; border-radius:8px; border:1.5px solid #e2e8f0; background:white; cursor:pointer; font-size:.82rem; font-weight:600; color:#64748b; display:flex; align-items:center; justify-content:center; transition:all .15s; text-decoration:none; }
        .pag-btn:hover, .pag-btn.active { background:#2563eb; border-color:#2563eb; color:white; }
        .pag-select { border:1.5px solid #e2e8f0; border-radius:8px; padding:.3rem .6rem; font-size:.78rem; font-family:inherit; outline:none; color:#64748b; }
        /* Modal */
        .modal-overlay { position:fixed; inset:0; background:rgba(0,0,0,.45); z-index:1000; display:flex; align-items:center; justify-content:center; padding:1rem; }
        .modal { background:white; border-radius:16px; padding:1.5rem; max-width:420px; width:100%; box-shadow:0 20px 60px rgba(0,0,0,.2); }
        .modal-icon { width:56px; height:56px; border-radius:50%; background:#fef2f2; display:flex; align-items:center; justify-content:center; margin:0 auto .9rem; color:#ef4444; font-size:1.4rem; }
        .modal-title { font-size:1rem; font-weight:700; color:#1e293b; text-align:center; margin-bottom:.4rem; }
        .modal-sub { font-size:.83rem; color:#64748b; text-align:center; margin-bottom:1.2rem; line-height:1.6; }
        .modal-actions { display:flex; gap:.7rem; }
        .modal-actions .btn { flex:1; justify-content:center; }
    </style>
    @endpush

    <div class="breadcrumb">
        <a href="{{ route('admin.dashboard') }}">Trang chủ</a><span>/</span>
        <span>Quản lý người dùng</span>
    </div>

    <div class="page-header">
        <div>
            <h1 style="font-size:1.4rem;font-weight:800;color:#1e293b">Quản lý người dùng</h1>
            <p style="font-size:.82rem;color:#64748b;margin-top:.15rem">Quản lý và kiểm soát tất cả tài khoản trong hệ thống.</p>
        </div>
        <a href="#" class="btn btn-primary" onclick="alert('Tính năng đang được phát triển')">
            <i class="fa-solid fa-plus"></i> Thêm người dùng
        </a>
    </div>

    <!-- Filter bar -->
    <form action="{{ route('admin.users') }}" method="GET" class="filter-bar">
        <div class="filter-search">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm theo tên hoặc email...">
        </div>
        <select name="role" class="filter-select">
            <option value="all">Tất cả vai trò</option>
            <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>Người dùng</option>
            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
        </select>
        <select name="status" class="filter-select">
            <option value="all">Tất cả trạng thái</option>
            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Hoạt động</option>
            <option value="locked" {{ request('status') == 'locked' ? 'selected' : '' }}>Đã khóa</option>
        </select>
        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i> Tìm kiếm</button>
        <a href="{{ route('admin.users') }}" class="btn btn-gray"><i class="fa-solid fa-rotate"></i> Xóa bộ lọc</a>
    </form>

    <!-- Table -->
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th style="width:40px"><input type="checkbox" style="accent-color:#2563eb"></th>
                    <th>STT</th>
                    <th>Ảnh</th>
                    <th>Họ và tên</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Vai trò</th>
                    <th>Trạng thái</th>
                    <th>Ngày tạo</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users ?? [] as $i => $user)
                <tr>
                    <td><input type="checkbox" style="accent-color:#2563eb"></td>
                    <td style="color:#94a3b8;font-size:.8rem">{{ $i + 1 }}</td>
                    <td>
                        @if($user->avatar)
                            <img src="{{ Storage::url($user->avatar) }}" class="user-thumb" alt="">
                        @else
                            <div class="user-thumb-placeholder">{{ strtoupper(substr($user->name,0,1)) }}</div>
                        @endif
                    </td>
                    <td style="font-weight:600">{{ $user->name }}</td>
                    <td style="color:#64748b">{{ $user->email }}</td>
                    <td style="color:#64748b">{{ $user->phone ?? '—' }}</td>
                    <td>
                        <span class="role-badge {{ $user->role === 'admin' ? 'role-admin' : 'role-user' }}">
                            {{ $user->role === 'admin' ? 'Admin' : 'Người dùng' }}
                        </span>
                    </td>
                    <td>
                        <div class="status-toggle">
                            <button class="toggle {{ $user->is_active ? 'on' : 'off' }}" onclick="toggleUser({{ $user->id }})">
                                <div class="toggle-dot"></div>
                            </button>
                            <span class="status-text {{ $user->is_active ? 'status-active' : 'status-locked' }}">
                                {{ $user->is_active ? 'Hoạt động' : 'Đã khóa' }}
                            </span>
                        </div>
                    </td>
                    <td style="font-size:.8rem;color:#64748b;white-space:nowrap">
                        {{ $user->created_at->format('d/m/Y') }}<br>
                        <span style="color:#94a3b8">{{ $user->created_at->format('H:i:s') }}</span>
                    </td>
                    <td>
                        <div class="action-btns">
                            <form action="{{ route('admin.users.toggle', $user) }}" method="POST" style="display:inline">
                                @csrf
                                <button type="submit" class="action-btn ab-lock" title="{{ $user->is_active ? 'Khóa' : 'Mở khóa' }}">
                                    <i class="fa-solid {{ $user->is_active ? 'fa-lock' : 'fa-lock-open' }}"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                {{-- Demo rows --}}
                @php
                $demoUsers = [
                    ['Nguyễn Văn An','nguyenvanan@example.com','0123 456 789','Người dùng',true,'20/05/2025','10:30:45'],
                    ['Trần Thị Bình','tranthibinh@example.com','0987 654 321','Người dùng',true,'18/05/2025','09:15:22'],
                    ['Lê Minh Hoàng','leminhhoang@example.com','0912 345 678','Người dùng',false,'15/05/2025','14:22:10'],
                    ['Phạm Quỳnh Anh','phamquynhanh@example.com','0333 222 111','Người dùng',true,'10/05/2025','08:45:00'],
                    ['Hoàng Đức Duy','hoangducduy@example.com','0822 456 789','Admin',true,'01/05/2025','11:00:00'],
                    ['Vũ Thị Ngọc','vutingoc@example.com','0777 888 999','Người dùng',false,'28/04/2025','16:30:12'],
                    ['Đặng Quốc Bảo','dangquocbao@example.com','0933 111 222','Người dùng',true,'22/04/2025','13:10:05'],
                ];
                @endphp
                @foreach($demoUsers as $i => $u)
                <tr>
                    <td><input type="checkbox" style="accent-color:#2563eb"></td>
                    <td style="color:#94a3b8;font-size:.8rem">{{ $i+1 }}</td>
                    <td>
                        <div class="user-thumb-placeholder" style="background:{{ ['#eff6ff','#f0fdf4','#fdf4ff','#fff7ed','#eff6ff','#fdf4ff','#f0fdf4'][$i] }};color:{{ ['#2563eb','#10b981','#a855f7','#f97316','#2563eb','#a855f7','#10b981'][$i] }}">
                            {{ strtoupper(substr($u[0],0,1)) }}
                        </div>
                    </td>
                    <td style="font-weight:600">{{ $u[0] }}</td>
                    <td style="color:#64748b;font-size:.83rem">{{ $u[1] }}</td>
                    <td style="color:#64748b;font-size:.83rem">{{ $u[2] }}</td>
                    <td><span class="role-badge {{ $u[3]==='Admin' ? 'role-admin' : 'role-user' }}">{{ $u[3] }}</span></td>
                    <td>
                        <div class="status-toggle">
                            <button class="toggle {{ $u[4] ? 'on' : 'off' }}">
                                <div class="toggle-dot"></div>
                            </button>
                            <span class="status-text {{ $u[4] ? 'status-active' : 'status-locked' }}">
                                {{ $u[4] ? 'Hoạt động' : 'Đã khóa' }}
                            </span>
                        </div>
                    </td>
                    <td style="font-size:.8rem;color:#64748b;white-space:nowrap">{{ $u[5] }}<br><span style="color:#94a3b8">{{ $u[6] }}</span></td>
                    <td>
                        <div class="action-btns">
                            <span class="action-btn" style="background:#f8fafc;color:#94a3b8;cursor:default" title="Chỉ xem">
                                <i class="fa-regular fa-eye"></i>
                            </span>
                        </div>
                    </td>
                </tr>
                @endforeach
                @endforelse
            </tbody>
        </table>

        <div style="padding: 1rem 1.3rem;">
            {{ $users->links('vendor.pagination.custom') }}
        </div>
    </div>

    @push('scripts')
    <script>
    function toggleUser(id) {
        fetch(`/admin/users/${id}/toggle-status`, { method:'POST', headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}','Content-Type':'application/json'} })
            .then(r => { if(r.ok) location.reload(); });
    }
    </script>
    @endpush
</x-admin-layout>
