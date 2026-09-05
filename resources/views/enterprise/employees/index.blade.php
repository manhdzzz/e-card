<x-enterprise-layout>
    <x-slot name="title">Quản lý nhân viên</x-slot>

    <div class="breadcrumb">
        <a href="{{ route('enterprise.dashboard') }}">Doanh nghiệp</a><span>/</span>
        <span>Nhân viên</span>
    </div>

    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 2rem;">
        <div>
            <h1 style="font-size: 1.5rem; font-weight: 800; color: var(--e-navy);">Quản lý nhân viên</h1>
            <p style="font-size: .85rem; color: #64748b; margin-top: .15rem;">Quản lý thông tin nhân sự và cấp tài khoản danh thiếp.</p>
        </div>
        <a href="{{ route('enterprise.employees.create') }}" class="btn btn-primary">
            <i class="ti ti-user-plus"></i> Thêm nhân viên mới
        </a>
    </div>

    {{-- Filters --}}
    <form action="{{ route('enterprise.employees.index') }}" method="GET" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 1.2rem; margin-bottom: 1.5rem; display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
        <div style="flex: 1; min-width: 250px; position: relative;">
            <i class="ti ti-search" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8;"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm theo tên, email, SĐT..." 
                   style="width: 100%; padding: .6rem 1rem .6rem 2.5rem; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: .85rem; outline: none;">
        </div>
        <select name="department" style="padding: .6rem 1rem; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: .85rem; outline: none; color: #475569; background: white; min-width: 180px;">
            <option value="all">Tất cả phòng ban</option>
            @foreach($departments as $dept)
                <option value="{{ $dept->id }}" {{ request('department') == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Lọc</button>
        <a href="{{ route('enterprise.employees.index') }}" class="btn btn-gray">Xóa lọc</a>
    </form>

    <div style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden;">
        <table>
            <thead>
                <tr>
                    <th>Nhân viên</th>
                    <th>Phòng ban</th>
                    <th>Chức vụ</th>
                    <th>Liên kết tài khoản</th>
                    <th style="text-align: center;">Trạng thái</th>
                    <th style="text-align: right;">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($employees as $emp)
                <tr>
                    <td>
                        <div style="display: flex; align-items: center; gap: .8rem;">
                            <div style="width: 38px; height: 38px; border-radius: 50%; background: #f1f5f9; color: var(--e-navy); display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: .8rem;">
                                {{ strtoupper(substr($emp->full_name, 0, 1)) }}
                            </div>
                            <div>
                                <div style="font-weight: 700; color: var(--e-navy);">{{ $emp->full_name }}</div>
                                <div style="font-size: .75rem; color: #64748b;">{{ $emp->email ?? 'Không có email' }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span style="font-size: .85rem; color: #475569;">{{ $emp->department->name ?? '---' }}</span>
                    </td>
                    <td>
                        <span style="font-size: .85rem; color: #475569;">{{ $emp->position ?? '---' }}</span>
                    </td>
                    <td>
                        @if($emp->user_id)
                            <span style="color: #16a34a; font-size: .75rem; font-weight: 700;">
                                <i class="ti ti-link"></i> Đã liên kết
                            </span>
                        @else
                            <span style="color: #94a3b8; font-size: .75rem;">Chưa liên kết</span>
                        @endif
                    </td>
                    <td style="text-align: center;">
                        <span style="font-size: .7rem; font-weight: 700; padding: .25rem .6rem; border-radius: 20px; {{ $emp->is_active ? 'background: #f0fdf4; color: #16a34a;' : 'background: #fef2f2; color: #dc2626;' }}">
                            {{ $emp->is_active ? 'Đang làm việc' : 'Đã nghỉ/Khóa' }}
                        </span>
                    </td>
                    <td style="text-align: right;">
                        <div style="display: flex; align-items: center; justify-content: flex-end; gap: .5rem;">
                            <a href="{{ route('enterprise.employees.edit', $emp) }}" class="btn btn-gray" style="padding: .4rem .6rem;" title="Sửa">
                                <i class="ti ti-edit"></i>
                            </a>
                            <form action="{{ route('enterprise.employees.destroy', $emp) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa nhân viên này?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="padding: .4rem .6rem;" title="Xóa">
                                    <i class="ti ti-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 3rem; color: #94a3b8;">
                        <i class="ti ti-users-group" style="font-size: 3rem; display: block; margin-bottom: 1rem; opacity: .2;"></i>
                        Chưa có nhân viên nào.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        @if($employees->hasPages())
        <div style="padding: 1rem 1.5rem; border-top: 1px solid #f1f5f9;">
            {{ $employees->links() }}
        </div>
        @endif
    </div>
</x-enterprise-layout>
