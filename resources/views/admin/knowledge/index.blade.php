<x-admin-layout>
    <x-slot name="title">Kiến thức ECard</x-slot>
    <div class="breadcrumb"><a href="{{ route('admin.dashboard') }}">Trang chủ</a><span>/</span><span>Kiến thức</span></div>
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;">
        <h1 style="font-size:1.4rem;font-weight:800;color:#1e293b;">Kiến thức ECard</h1>
        <a href="{{ route('admin.knowledge.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Thêm bài viết</a>
    </div>
    <div class="card" style="overflow:hidden;">
        <table>
            <thead><tr><th>Ảnh</th><th>Tiêu đề</th><th>Thứ tự</th><th>Trạng thái</th><th>Thao tác</th></tr></thead>
            <tbody>
            @forelse($articles as $a)
            <tr>
                <td><img src="{{ $a->image ?: asset('assets/images/knowledge1.png') }}" style="height:50px;border-radius:6px;"></td>
                <td style="font-weight:700;">{{ $a->title }}</td>
                <td>{{ $a->sort_order }}</td>
                <td><span style="padding:3px 10px;border-radius:20px;font-size:.75rem;font-weight:700;{{ $a->is_active ? 'background:#dcfce7;color:#16a34a' : 'background:#fee2e2;color:#dc2626' }}">{{ $a->is_active ? 'Hiện' : 'Ẩn' }}</span></td>
                <td style="display:flex;gap:.4rem;">
                    <a href="{{ route('admin.knowledge.edit', $a) }}" class="btn btn-gray btn-icon"><i class="fa-solid fa-pen"></i></a>
                    <form action="{{ route('admin.knowledge.destroy', $a) }}" method="POST" onsubmit="return confirm('Xóa bài viết này?')">@csrf @method('DELETE')<button class="btn btn-danger btn-icon"><i class="fa-solid fa-trash"></i></button></form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" style="text-align:center;padding:2rem;color:#94a3b8;">Chưa có bài viết nào</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>
