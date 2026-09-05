<x-enterprise-layout>
    <x-slot name="title">{{ isset($department) ? 'Sửa phòng ban' : 'Thêm phòng ban' }}</x-slot>

    <div class="breadcrumb">
        <a href="{{ route('enterprise.dashboard') }}">Doanh nghiệp</a><span>/</span>
        <a href="{{ route('enterprise.departments.index') }}">Phòng ban</a><span>/</span>
        <span>{{ isset($department) ? 'Sửa' : 'Thêm mới' }}</span>
    </div>

    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 1.5rem; font-weight: 800; color: var(--e-navy);">{{ isset($department) ? 'Chỉnh sửa phòng ban' : 'Thêm phòng ban mới' }}</h1>
    </div>

    <div style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 2rem; max-width: 600px;">
        <form action="{{ isset($department) ? route('enterprise.departments.update', $department) : route('enterprise.departments.store') }}" method="POST">
            @csrf
            @if(isset($department)) @method('PUT') @endif

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-size: .85rem; font-weight: 700; color: #475569; margin-bottom: .5rem;">Tên phòng ban <span style="color: #ef4444;">*</span></label>
                <input type="text" name="name" value="{{ old('name', $department->name ?? '') }}" required placeholder="VD: Phòng Kinh Doanh" 
                       style="width: 100%; padding: .7rem 1rem; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: .9rem; outline: none; transition: border-color .2s;">
                @error('name') <div style="color: #ef4444; font-size: .75rem; margin-top: .4rem;">{{ $message }}</div> @enderror
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-size: .85rem; font-weight: 700; color: #475569; margin-bottom: .5rem;">Mô tả</label>
                <textarea name="description" rows="4" placeholder="Nhập mô tả ngắn về chức năng nhiệm vụ của phòng ban..."
                          style="width: 100%; padding: .7rem 1rem; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: .9rem; outline: none; transition: border-color .2s; resize: vertical;">{{ old('description', $department->description ?? '') }}</textarea>
                @error('description') <div style="color: #ef4444; font-size: .75rem; margin-top: .4rem;">{{ $message }}</div> @enderror
            </div>

            <div style="display: flex; gap: 1rem; margin-top: 1rem;">
                <button type="submit" class="btn btn-primary" style="padding: .7rem 2rem;">
                    <i class="ti ti-check"></i> {{ isset($department) ? 'Cập nhật' : 'Lưu phòng ban' }}
                </button>
                <a href="{{ route('enterprise.departments.index') }}" class="btn btn-gray" style="padding: .7rem 2rem;">Hủy</a>
            </div>
        </form>
    </div>
</x-enterprise-layout>
