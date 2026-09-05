<x-admin-layout>
    <x-slot name="title">Chỉnh sửa người dùng</x-slot>

    <div class="breadcrumb">
        <a href="{{ route('admin.dashboard') }}">Trang chủ</a><span>/</span>
        <a href="{{ route('admin.users') }}">Quản lý người dùng</a><span>/</span>
        <span>Chỉnh sửa</span>
    </div>

    <div style="margin-bottom: 1.5rem">
        <h1 style="font-size:1.4rem;font-weight:800;color:#1e293b">Chỉnh sửa người dùng</h1>
        <p style="font-size:.82rem;color:#64748b;margin-top:.15rem">Cập nhật thông tin tài khoản cho <strong>{{ $user->name }}</strong></p>
    </div>

    <div style="background: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 1.5rem; max-width: 600px;">
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 1.2rem;">
                <label style="display: block; font-size: .88rem; font-weight: 700; color: #1e293b; margin-bottom: .5rem;">Họ và tên</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" style="width: 100%; padding: .7rem .9rem; border: 1.5px solid #e2e8f0; border-radius: 8px; outline: none; font-size: .9rem;">
                @error('name')<p style="color:#ef4444; font-size:.75rem; margin-top:.3rem">{{ $message }}</p>@enderror
            </div>

            <div style="margin-bottom: 1.2rem;">
                <label style="display: block; font-size: .88rem; font-weight: 700; color: #1e293b; margin-bottom: .5rem;">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" style="width: 100%; padding: .7rem .9rem; border: 1.5px solid #e2e8f0; border-radius: 8px; outline: none; font-size: .9rem;">
                @error('email')<p style="color:#ef4444; font-size:.75rem; margin-top:.3rem">{{ $message }}</p>@enderror
            </div>

            <div style="margin-bottom: 1.2rem;">
                <label style="display: block; font-size: .88rem; font-weight: 700; color: #1e293b; margin-bottom: .5rem;">Vai trò</label>
                <select name="role" style="width: 100%; padding: .7rem .9rem; border: 1.5px solid #e2e8f0; border-radius: 8px; outline: none; font-size: .9rem; background:white;">
                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>Người dùng</option>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Quản trị viên</option>
                </select>
                @error('role')<p style="color:#ef4444; font-size:.75rem; margin-top:.3rem">{{ $message }}</p>@enderror
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-size: .88rem; font-weight: 700; color: #1e293b; margin-bottom: .5rem;">Trạng thái tài khoản</label>
                <select name="is_active" style="width: 100%; padding: .7rem .9rem; border: 1.5px solid #e2e8f0; border-radius: 8px; outline: none; font-size: .9rem; background:white;">
                    <option value="1" {{ old('is_active', $user->is_active) ? 'selected' : '' }}>Hoạt động</option>
                    <option value="0" {{ !old('is_active', $user->is_active) ? 'selected' : '' }}>Đang khóa</option>
                </select>
                @error('is_active')<p style="color:#ef4444; font-size:.75rem; margin-top:.3rem">{{ $message }}</p>@enderror
            </div>

            <div style="display: flex; gap: .7rem; justify-content: flex-end;">
                <a href="{{ route('admin.users') }}" class="btn btn-gray" style="text-decoration:none">Hủy</a>
                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
            </div>
        </form>
    </div>
</x-admin-layout>
