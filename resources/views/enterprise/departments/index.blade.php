<x-enterprise-layout>
    <x-slot name="title">Quản lý phòng ban</x-slot>

    <div class="breadcrumb">
        <a href="{{ route('enterprise.dashboard') }}">Doanh nghiệp</a><span>/</span>
        <span>Phòng ban</span>
    </div>

    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 2rem;">
        <div>
            <h1 style="font-size: 1.5rem; font-weight: 800; color: var(--e-navy);">Quản lý phòng ban</h1>
            <p style="font-size: .85rem; color: #64748b; margin-top: .15rem;">Quản lý sơ đồ tổ chức và danh sách các phòng ban.</p>
        </div>
        <a href="{{ route('enterprise.departments.create') }}" class="btn btn-primary">
            <i class="ti ti-plus"></i> Thêm phòng ban mới
        </a>
    </div>

    <div style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden;">
        <table>
            <thead>
                <tr>
                    <th style="width: 60px;">ID</th>
                    <th>Tên phòng ban</th>
                    <th>Mô tả</th>
                    <th style="text-align: center;">Số nhân viên</th>
                    <th>Ngày tạo</th>
                    <th style="text-align: right;">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($departments as $dept)
                <tr>
                    <td style="color: #94a3b8;">#{{ $dept->id }}</td>
                    <td style="font-weight: 700; color: var(--e-navy);">{{ $dept->name }}</td>
                    <td style="color: #64748b; font-size: .8rem;">{{ \Illuminate\Support\Str::limit($dept->description, 50) }}</td>
                    <td style="text-align: center;">
                        <span style="background: #eff6ff; color: #2563eb; padding: .2rem .6rem; border-radius: 20px; font-weight: 700; font-size: .75rem;">
                            {{ $dept->employees_count }}
                        </span>
                    </td>
                    <td style="font-size: .8rem; color: #64748b;">{{ $dept->created_at->format('d/m/Y') }}</td>
                    <td style="text-align: right;">
                        <div style="display: flex; align-items: center; justify-content: flex-end; gap: .5rem;">
                            <a href="{{ route('enterprise.departments.edit', $dept) }}" class="btn btn-gray" style="padding: .4rem .6rem;" title="Sửa">
                                <i class="ti ti-edit"></i>
                            </a>
                            <form action="{{ route('enterprise.departments.destroy', $dept) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa phòng ban này?');">
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
                        <i class="ti ti-sitemap" style="font-size: 3rem; display: block; margin-bottom: 1rem; opacity: .2;"></i>
                        Chưa có phòng ban nào được tạo.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-enterprise-layout>
