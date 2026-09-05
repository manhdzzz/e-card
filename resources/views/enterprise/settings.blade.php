<x-enterprise-layout>
    <x-slot name="title">Cài đặt doanh nghiệp</x-slot>

    <div class="breadcrumb">
        <a href="{{ route('enterprise.dashboard') }}">Doanh nghiệp</a><span>/</span>
        <span>Cài đặt</span>
    </div>

    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 1.5rem; font-weight: 800; color: var(--e-navy);">Thông tin doanh nghiệp</h1>
        <p style="font-size: .85rem; color: #64748b; margin-top: .15rem;">Cập nhật thông tin nhận diện và thông tin liên hệ của công ty.</p>
    </div>

    <form action="{{ route('enterprise.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 1.5rem; align-items: start;">
            {{-- Left: Details --}}
            <div style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 2rem;">
                <h2 style="font-size: 1.1rem; font-weight: 800; color: var(--e-navy); margin-bottom: 1.5rem; border-bottom: 2px solid #f1f5f9; padding-bottom: .8rem;">Thông tin chung</h2>

                <div style="margin-bottom: 1.2rem;">
                    <label style="display: block; font-size: .85rem; font-weight: 700; color: #475569; margin-bottom: .5rem;">Tên doanh nghiệp <span style="color: #ef4444;">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $company->name) }}" required 
                           style="width: 100%; padding: .7rem 1rem; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: .9rem; outline: none;">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.2rem;">
                    <div>
                        <label style="display: block; font-size: .85rem; font-weight: 700; color: #475569; margin-bottom: .5rem;">Mã số thuế</label>
                        <input type="text" name="tax_code" value="{{ old('tax_code', $company->tax_code) }}" placeholder="Mã số thuế doanh nghiệp" 
                               style="width: 100%; padding: .7rem 1rem; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: .9rem; outline: none;">
                    </div>
                    <div>
                        <label style="display: block; font-size: .85rem; font-weight: 700; color: #475569; margin-bottom: .5rem;">Website</label>
                        <input type="url" name="website" value="{{ old('website', $company->website) }}" placeholder="https://example.com" 
                               style="width: 100%; padding: .7rem 1rem; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: .9rem; outline: none;">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.2rem;">
                    <div>
                        <label style="display: block; font-size: .85rem; font-weight: 700; color: #475569; margin-bottom: .5rem;">Email công ty</label>
                        <input type="email" name="email" value="{{ old('email', $company->email) }}" placeholder="contact@company.com" 
                               style="width: 100%; padding: .7rem 1rem; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: .9rem; outline: none;">
                    </div>
                    <div>
                        <label style="display: block; font-size: .85rem; font-weight: 700; color: #475569; margin-bottom: .5rem;">Số điện thoại</label>
                        <input type="text" name="phone" value="{{ old('phone', $company->phone) }}" placeholder="Số hotline công ty" 
                               style="width: 100%; padding: .7rem 1rem; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: .9rem; outline: none;">
                    </div>
                </div>

                <div style="margin-bottom: 1.2rem;">
                    <label style="display: block; font-size: .85rem; font-weight: 700; color: #475569; margin-bottom: .5rem;">Địa chỉ trụ sở</label>
                    <textarea name="address" rows="3" style="width: 100%; padding: .7rem 1rem; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: .9rem; outline: none; resize: vertical;">{{ old('address', $company->address) }}</textarea>
                </div>
            </div>

            {{-- Right: Logo --}}
            <div style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 2rem;">
                <h2 style="font-size: 1.1rem; font-weight: 800; color: var(--e-navy); margin-bottom: 1.5rem; border-bottom: 2px solid #f1f5f9; padding-bottom: .8rem;">Logo công ty</h2>
                
                <div style="text-align: center; margin-bottom: 1.5rem;">
                    <div style="width: 150px; height: 150px; margin: 0 auto; border: 2px dashed #cbd5e1; border-radius: 16px; display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden; background: #f8fafc;">
                        @if($company->logo)
                            <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo" style="width: 100%; height: 100%; object-fit: contain;">
                        @else
                            <i class="ti ti-photo-plus" style="font-size: 2.5rem; color: #94a3b8;"></i>
                        @endif
                    </div>
                </div>

                <div style="margin-bottom: 1rem;">
                    <label style="display: block; font-size: .85rem; font-weight: 700; color: #475569; margin-bottom: .5rem;">Tải lên logo mới</label>
                    <input type="file" name="logo" accept="image/*" style="font-size: .8rem; color: #64748b;">
                    <p style="font-size: .7rem; color: #94a3b8; margin-top: .5rem;">Định dạng: JPG, PNG, SVG (tối đa 2MB)</p>
                </div>
            </div>
        </div>

        <div style="margin-top: 2rem;">
            <button type="submit" class="btn btn-primary" style="padding: .8rem 3rem; font-size: 1rem;">
                <i class="ti ti-device-floppy"></i> Lưu thay đổi
            </button>
        </div>
    </form>
</x-enterprise-layout>
