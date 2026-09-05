<x-admin-layout>
    <x-slot name="title">{{ $product ? 'Sửa' : 'Thêm' }} Giải pháp</x-slot>
    <div class="breadcrumb"><a href="{{ route('admin.dashboard') }}">Trang chủ</a><span>/</span><a href="{{ route('admin.products.index') }}">Giải pháp</a><span>/</span><span>{{ $product ? 'Sửa' : 'Thêm' }}</span></div>
    <h1 style="font-size:1.4rem;font-weight:800;color:#1e293b;margin-bottom:1.5rem;">{{ $product ? 'Sửa giải pháp' : 'Thêm giải pháp mới' }}</h1>
    <div class="card" style="padding:1.5rem;max-width:800px;">
        <form action="{{ $product ? route('admin.products.update', $product) : route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($product) @method('PUT') @endif
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem;">
                <div><label style="font-size:.8rem;font-weight:700;color:#64748b;display:block;margin-bottom:.4rem;">Tên giải pháp *</label>
                    <input type="text" name="title" value="{{ old('title', $product->title ?? '') }}" required style="width:100%;padding:.6rem;border:1px solid #e2e8f0;border-radius:8px;font-size:.85rem;">
                </div>
                <div><label style="font-size:.8rem;font-weight:700;color:#64748b;display:block;margin-bottom:.4rem;">Giá *</label>
                    <input type="text" name="price" value="{{ old('price', $product->price ?? '') }}" required style="width:100%;padding:.6rem;border:1px solid #e2e8f0;border-radius:8px;font-size:.85rem;">
                </div>
            </div>
            <div style="margin-bottom:1rem;display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                <div><label style="font-size:.8rem;font-weight:700;color:#64748b;display:block;margin-bottom:.4rem;">Thứ tự sắp xếp</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $product->sort_order ?? 0) }}" style="width:100%;padding:.6rem;border:1px solid #e2e8f0;border-radius:8px;font-size:.85rem;">
                </div>
                <div><label style="font-size:.8rem;font-weight:700;color:#64748b;display:block;margin-bottom:.4rem;">Ảnh đại diện</label>
                    @if($product && $product->image)<img src="{{ $product->image }}" style="height:60px;border-radius:6px;margin-bottom:.5rem;display:block;">@endif
                    <input type="file" name="image" accept="image/*" style="font-size:.85rem;">
                </div>
            </div>
            <div style="margin-bottom:1rem;"><label style="font-size:.8rem;font-weight:700;color:#64748b;display:block;margin-bottom:.4rem;">Mô tả ngắn</label>
                <textarea name="short_desc" rows="3" style="width:100%;padding:.6rem;border:1px solid #e2e8f0;border-radius:8px;font-size:.85rem;">{{ old('short_desc', $product->short_desc ?? '') }}</textarea>
            </div>
            <div style="margin-bottom:1rem;"><label style="font-size:.8rem;font-weight:700;color:#64748b;display:block;margin-bottom:.4rem;">Mô tả chi tiết</label>
                <textarea name="full_desc" rows="6" style="width:100%;padding:.6rem;border:1px solid #e2e8f0;border-radius:8px;font-size:.85rem;">{{ old('full_desc', $product->full_desc ?? '') }}</textarea>
            </div>
            <div style="margin-bottom:1.5rem;"><label style="display:flex;align-items:center;gap:.5rem;cursor:pointer;">
                <input type="checkbox" name="is_active" {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}> <span style="font-size:.85rem;font-weight:600;">Hiển thị trên trang chủ</span>
            </label></div>
            <div style="display:flex;gap:.8rem;">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-check"></i> {{ $product ? 'Cập nhật' : 'Thêm mới' }}</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-gray">Hủy</a>
            </div>
        </form>
    </div>
</x-admin-layout>
