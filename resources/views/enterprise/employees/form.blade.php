<x-enterprise-layout>
    <x-slot name="title">{{ isset($employee) ? 'Sửa nhân viên' : 'Thêm nhân viên' }}</x-slot>

    <div class="breadcrumb">
        <a href="{{ route('enterprise.dashboard') }}">Doanh nghiệp</a><span>/</span>
        <a href="{{ route('enterprise.employees.index') }}">Nhân viên</a><span>/</span>
        <span>{{ isset($employee) ? 'Sửa' : 'Thêm mới' }}</span>
    </div>

    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 1.5rem; font-weight: 800; color: var(--e-navy);">{{ isset($employee) ? 'Chỉnh sửa thông tin nhân viên' : 'Thêm nhân viên mới' }}</h1>
    </div>

    <form action="{{ isset($employee) ? route('enterprise.employees.update', $employee) : route('enterprise.employees.store') }}" method="POST">
        @csrf
        @if(isset($employee)) @method('PUT') @endif

        <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 1.5rem; align-items: start;">
            {{-- Left Column: Basic Info --}}
            <div style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 2rem;">
                <h2 style="font-size: 1.1rem; font-weight: 800; color: var(--e-navy); margin-bottom: 1.5rem; border-bottom: 2px solid #f1f5f9; padding-bottom: .8rem;">Thông tin cơ bản</h2>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.2rem;">
                    <div>
                        <label style="display: block; font-size: .85rem; font-weight: 700; color: #475569; margin-bottom: .5rem;">Họ và tên <span style="color: #ef4444;">*</span></label>
                        <input type="text" name="full_name" value="{{ old('full_name', $employee->full_name ?? '') }}" required placeholder="VD: Nguyễn Văn A" 
                               style="width: 100%; padding: .7rem 1rem; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: .9rem; outline: none;">
                    </div>
                    <div>
                        <label style="display: block; font-size: .85rem; font-weight: 700; color: #475569; margin-bottom: .5rem;">Chức vụ</label>
                        <input type="text" name="position" value="{{ old('position', $employee->position ?? '') }}" placeholder="VD: Trưởng phòng" 
                               style="width: 100%; padding: .7rem 1rem; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: .9rem; outline: none;">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.2rem;">
                    <div>
                        <label style="display: block; font-size: .85rem; font-weight: 700; color: #475569; margin-bottom: .5rem;">Số điện thoại</label>
                        <input type="text" name="phone" value="{{ old('phone', $employee->phone ?? '') }}" placeholder="0123 456 789" 
                               style="width: 100%; padding: .7rem 1rem; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: .9rem; outline: none;">
                    </div>
                    <div>
                        <label style="display: block; font-size: .85rem; font-weight: 700; color: #475569; margin-bottom: .5rem;">Email <span style="color: #ef4444;">*</span></label>
                        <input type="email" name="email" value="{{ old('email', $employee->email ?? '') }}" required placeholder="email@example.com" 
                               style="width: 100%; padding: .7rem 1rem; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: .9rem; outline: none;">
                    </div>
                </div>

                <div style="margin-bottom: 1.2rem;">
                    <label style="display: block; font-size: .85rem; font-weight: 700; color: #475569; margin-bottom: .5rem;">Phòng ban</label>
                    <select name="department_id" style="width: 100%; padding: .7rem 1rem; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: .9rem; outline: none; background: white;">
                        <option value="">-- Chọn phòng ban --</option>
                        @foreach($departments as $dept)
                            <option value="{{ $dept->id }}" {{ old('department_id', $employee->department_id ?? '') == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                        @endforeach
                    </select>
                </div>

                @if(isset($employee))
                <div style="margin-top: 1.5rem;">
                    <label style="display: flex; align-items: center; gap: .6rem; cursor: pointer;">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $employee->is_active ?? 1) ? 'checked' : '' }} style="width: 18px; height: 18px; accent-color: var(--e-navy);">
                        <span style="font-size: .9rem; font-weight: 600; color: #475569;">Đang làm việc (Kích hoạt)</span>
                    </label>
                </div>
                @endif
            </div>

            {{-- Right Column: Account Management --}}
            <div style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 2rem;">
                <h2 style="font-size: 1.1rem; font-weight: 800; color: var(--e-navy); margin-bottom: 1.5rem; border-bottom: 2px solid #f1f5f9; padding-bottom: .8rem;">Tài khoản hệ thống</h2>
                
                @if(!isset($employee))
                <div style="background: #f8fafc; border-radius: 10px; padding: 1.2rem; margin-bottom: 1.5rem; border: 1px dashed #cbd5e1;">
                    <label style="display: flex; align-items: center; gap: .6rem; cursor: pointer; margin-bottom: 1rem;">
                        <input type="checkbox" name="create_account" value="1" id="create_account" style="width: 18px; height: 18px; accent-color: var(--e-navy);">
                        <span style="font-size: .9rem; font-weight: 700; color: var(--e-navy);">Cấp tài khoản đăng nhập</span>
                    </label>
                    <p style="font-size: .75rem; color: #64748b; line-height: 1.5;">Hệ thống sẽ tự động tạo một tài khoản User liên kết với email này để nhân viên có thể tự quản lý danh thiếp của họ.</p>
                </div>

                <div id="account_fields" style="display: none;">
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; font-size: .85rem; font-weight: 700; color: #475569; margin-bottom: .5rem;">Mật khẩu mặc định</label>
                        <input type="password" name="password" placeholder="Nhập mật khẩu (mặc định: ecard123)" 
                               style="width: 100%; padding: .7rem 1rem; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: .9rem; outline: none;">
                    </div>
                </div>
                @else
                    @if($employee->user_id)
                        <div style="display: flex; align-items: center; gap: .8rem; color: #16a34a; background: #f0fdf4; padding: 1rem; border-radius: 8px; font-weight: 700; font-size: .9rem;">
                            <i class="ti ti-circle-check" style="font-size: 1.2rem;"></i> Đã cấp tài khoản User
                        </div>
                    @else
                        <div style="color: #64748b; font-size: .85rem; font-style: italic;">Nhân viên này chưa có tài khoản hệ thống.</div>
                    @endif
                @endif
            </div>
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 2rem;">
            <button type="submit" class="btn btn-primary" style="padding: .8rem 2.5rem; font-size: 1rem;">
                <i class="ti {{ isset($employee) ? 'ti-check' : 'ti-user-plus' }}"></i> {{ isset($employee) ? 'Cập nhật nhân viên' : 'Lưu thông tin nhân viên' }}
            </button>
            <a href="{{ route('enterprise.employees.index') }}" class="btn btn-gray" style="padding: .8rem 2rem;">Quay lại</a>
        </div>
    </form>

    <script>
        const checkbox = document.getElementById('create_account');
        const fields = document.getElementById('account_fields');
        if(checkbox) {
            checkbox.addEventListener('change', function() {
                fields.style.display = this.checked ? 'block' : 'none';
            });
        }
    </script>
</x-enterprise-layout>
