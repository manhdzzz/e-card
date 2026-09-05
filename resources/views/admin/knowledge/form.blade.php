<x-admin-layout>
    <x-slot name="title">{{ $article ? 'Sửa' : 'Thêm' }} Kiến thức</x-slot>
    <div class="breadcrumb"><a href="{{ route('admin.dashboard') }}">Trang chủ</a><span>/</span><a href="{{ route('admin.knowledge.index') }}">Kiến thức</a><span>/</span><span>{{ $article ? 'Sửa' : 'Thêm' }}</span></div>
    <h1 style="font-size:1.4rem;font-weight:800;color:#1e293b;margin-bottom:1.5rem;">{{ $article ? 'Sửa bài viết' : 'Thêm bài viết mới' }}</h1>
    <div class="card" style="padding:1.5rem;max-width:800px;">
        <form action="{{ $article ? route('admin.knowledge.update', $article) : route('admin.knowledge.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($article) @method('PUT') @endif
            <div style="margin-bottom:1rem;"><label style="font-size:.8rem;font-weight:700;color:#64748b;display:block;margin-bottom:.4rem;">Tiêu đề *</label>
                <input type="text" name="title" value="{{ old('title', $article->title ?? '') }}" required style="width:100%;padding:.6rem;border:1px solid #e2e8f0;border-radius:8px;font-size:.85rem;">
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem;">
                <div><label style="font-size:.8rem;font-weight:700;color:#64748b;display:block;margin-bottom:.4rem;">Thứ tự</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $article->sort_order ?? 0) }}" style="width:100%;padding:.6rem;border:1px solid #e2e8f0;border-radius:8px;font-size:.85rem;">
                </div>
                <div><label style="font-size:.8rem;font-weight:700;color:#64748b;display:block;margin-bottom:.4rem;">Ảnh đại diện</label>
                    @if($article && $article->image)<img src="{{ $article->image }}" style="height:60px;border-radius:6px;margin-bottom:.5rem;display:block;">@endif
                    <input type="file" name="image" accept="image/*" style="font-size:.85rem;">
                </div>
            </div>
            <div style="margin-bottom:1rem;"><label style="font-size:.8rem;font-weight:700;color:#64748b;display:block;margin-bottom:.4rem;">Mô tả ngắn</label>
                <textarea name="short_desc" rows="3" style="width:100%;padding:.6rem;border:1px solid #e2e8f0;border-radius:8px;font-size:.85rem;">{{ old('short_desc', $article->short_desc ?? '') }}</textarea>
            </div>
            <div style="margin-bottom:1rem;"><label style="font-size:.8rem;font-weight:700;color:#64748b;display:block;margin-bottom:.4rem;">Nội dung chi tiết</label>
                <textarea name="full_desc" rows="8" style="width:100%;padding:.6rem;border:1px solid #e2e8f0;border-radius:8px;font-size:.85rem;">{{ old('full_desc', $article->full_desc ?? '') }}</textarea>
            </div>
            <div style="margin-bottom:1.5rem;"><label style="display:flex;align-items:center;gap:.5rem;cursor:pointer;">
                <input type="checkbox" name="is_active" {{ old('is_active', $article->is_active ?? true) ? 'checked' : '' }}> <span style="font-size:.85rem;font-weight:600;">Hiển thị trên trang chủ</span>
            </label></div>
            <div style="display:flex;gap:.8rem;">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-check"></i> {{ $article ? 'Cập nhật' : 'Thêm mới' }}</button>
                <a href="{{ route('admin.knowledge.index') }}" class="btn btn-gray">Hủy</a>
            </div>
        </form>
    </div>
</x-admin-layout>
