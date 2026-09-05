<x-admin-layout>
    <x-slot name="title">Giải pháp & Bảng giá</x-slot>
    <div class="breadcrumb"><a href="{{ route('admin.dashboard') }}">Trang chủ</a><span>/</span><span>Giải pháp</span></div>
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;">
        <h1 style="font-size:1.4rem;font-weight:800;color:#1e293b;">Giải pháp & Bảng giá</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Thêm giải pháp</a>
    </div>
    <div class="card" style="overflow:hidden;">
        <table>
            <thead><tr><th>Ảnh</th><th>Tên</th><th>Giá</th><th>Thứ tự</th><th>Trạng thái</th><th>Thao tác</th></tr></thead>
            <tbody>
            @forelse($products as $p)
            <tr>
                <td><img src="{{ $p->image ?: asset('assets/images/product1.png') }}" style="height:50px;border-radius:6px;"></td>
                <td style="font-weight:700;">{{ $p->title }}</td>
                <td>{{ $p->price }}</td>
                <td>{{ $p->sort_order }}</td>
                <td><span style="padding:3px 10px;border-radius:20px;font-size:.75rem;font-weight:700;{{ $p->is_active ? 'background:#dcfce7;color:#16a34a' : 'background:#fee2e2;color:#dc2626' }}">{{ $p->is_active ? 'Hiện' : 'Ẩn' }}</span></td>
                <td style="display:flex;gap:.4rem;">
                    <a href="{{ route('admin.products.edit', $p) }}" class="btn btn-gray btn-icon"><i class="fa-solid fa-pen"></i></a>
                    <form action="{{ route('admin.products.destroy', $p) }}" method="POST" onsubmit="return confirm('Xóa giải pháp này?')">@csrf @method('DELETE')<button class="btn btn-danger btn-icon"><i class="fa-solid fa-trash"></i></button></form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center;padding:2rem;color:#94a3b8;">Chưa có giải pháp nào</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>
