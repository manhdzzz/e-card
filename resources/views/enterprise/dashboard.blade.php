<x-enterprise-layout>
    <x-slot name="title">Bảng điều khiển doanh nghiệp</x-slot>

    <div class="breadcrumb">
        <a href="{{ route('enterprise.dashboard') }}">Doanh nghiệp</a><span>/</span>
        <span>Bảng điều khiển</span>
    </div>

    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 2rem;">
        <div>
            <h1 style="font-size: 1.5rem; font-weight: 800; color: var(--e-navy);">Bảng điều khiển</h1>
            <p style="font-size: .85rem; color: #64748b; margin-top: .15rem;">Chào mừng bạn đến với hệ thống quản lý danh thiếp doanh nghiệp {{ $company->name }}.</p>
        </div>
        <a href="{{ route('enterprise.employees.create') }}" class="btn btn-primary">
            <i class="ti ti-user-plus"></i> Thêm nhân viên
        </a>
    </div>

    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; margin-bottom: 2.5rem;">
        <div style="background: white; border-radius: 12px; padding: 1.5rem; border: 1px solid #e2e8f0; display: flex; align-items: center; gap: 1rem;">
            <div style="width: 48px; height: 48px; border-radius: 12px; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                <i class="ti ti-sitemap"></i>
            </div>
            <div>
                <div style="font-size: .75rem; color: #64748b; font-weight: 700; text-transform: uppercase;">Phòng ban</div>
                <div style="font-size: 1.4rem; font-weight: 800; color: var(--e-navy);">{{ $stats['departments'] }}</div>
            </div>
        </div>
        <div style="background: white; border-radius: 12px; padding: 1.5rem; border: 1px solid #e2e8f0; display: flex; align-items: center; gap: 1rem;">
            <div style="width: 48px; height: 48px; border-radius: 12px; background: #f0fdf4; color: #16a34a; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                <i class="ti ti-users"></i>
            </div>
            <div>
                <div style="font-size: .75rem; color: #64748b; font-weight: 700; text-transform: uppercase;">Nhân viên</div>
                <div style="font-size: 1.4rem; font-weight: 800; color: var(--e-navy);">{{ $stats['employees'] }}</div>
            </div>
        </div>
        <div style="background: white; border-radius: 12px; padding: 1.5rem; border: 1px solid #e2e8f0; display: flex; align-items: center; gap: 1rem;">
            <div style="width: 48px; height: 48px; border-radius: 12px; background: #fffbeb; color: #d97706; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                <i class="ti ti-id-badge"></i>
            </div>
            <div>
                <div style="font-size: .75rem; color: #64748b; font-weight: 700; text-transform: uppercase;">Danh thiếp</div>
                <div style="font-size: 1.4rem; font-weight: 800; color: var(--e-navy);">{{ $stats['cards'] }}</div>
            </div>
        </div>
        <div style="background: white; border-radius: 12px; padding: 1.5rem; border: 1px solid #e2e8f0; display: flex; align-items: center; gap: 1rem;">
            <div style="width: 48px; height: 48px; border-radius: 12px; background: #fdf2f8; color: #db2777; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                <i class="ti ti-eye"></i>
            </div>
            <div>
                <div style="font-size: .75rem; color: #64748b; font-weight: 700; text-transform: uppercase;">Lượt xem</div>
                <div style="font-size: 1.4rem; font-weight: 800; color: var(--e-navy);">{{ number_format($stats['total_views']) }}</div>
            </div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem;">
        <div>
            <div style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden;">
                <div style="padding: 1rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: space-between;">
                    <h2 style="font-size: 1rem; font-weight: 800; color: var(--e-navy); margin: 0;">Nhân viên mới thêm</h2>
                    <a href="{{ route('enterprise.employees.index') }}" style="font-size: .8rem; color: #2563eb; text-decoration: none; font-weight: 600;">Xem tất cả</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Nhân viên</th>
                            <th>Phòng ban</th>
                            <th>Chức vụ</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentEmployees as $emp)
                        <tr>
                            <td>
                                <div style="font-weight: 600;">{{ $emp->full_name }}</div>
                                <div style="font-size: .75rem; color: #64748b;">{{ $emp->email }}</div>
                            </td>
                            <td>{{ $emp->department->name ?? '---' }}</td>
                            <td>{{ $emp->position ?? '---' }}</td>
                            <td>
                                <span style="font-size: .7rem; font-weight: 700; padding: .2rem .5rem; border-radius: 6px; {{ $emp->is_active ? 'background: #f0fdf4; color: #16a34a;' : 'background: #fef2f2; color: #dc2626;' }}">
                                    {{ $emp->is_active ? 'Hoạt động' : 'Tạm khóa' }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 2rem; color: #94a3b8;">Chưa có nhân viên nào.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div>
            <div style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 1.5rem;">
                <h2 style="font-size: 1rem; font-weight: 800; color: var(--e-navy); margin-bottom: 1.2rem;">Thông tin doanh nghiệp</h2>
                <div style="text-align: center; margin-bottom: 1.5rem;">
                    @if($company->logo)
                        <img src="{{ asset('storage/' . $company->logo) }}" alt="" style="max-height: 80px; max-width: 100%; object-fit: contain;">
                    @else
                        <div style="width: 80px; height: 80px; background: #f1f5f9; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto; color: #94a3b8; font-size: 2rem;">
                            <i class="ti ti-building"></i>
                        </div>
                    @endif
                </div>
                <div style="display: flex; flex-direction: column; gap: .8rem;">
                    <div>
                        <div style="font-size: .7rem; color: #64748b; font-weight: 700; text-transform: uppercase;">Tên công ty</div>
                        <div style="font-size: .9rem; font-weight: 600;">{{ $company->name }}</div>
                    </div>
                    <div>
                        <div style="font-size: .7rem; color: #64748b; font-weight: 700; text-transform: uppercase;">Mã số thuế</div>
                        <div style="font-size: .9rem;">{{ $company->tax_code ?? '---' }}</div>
                    </div>
                    <div>
                        <div style="font-size: .7rem; color: #64748b; font-weight: 700; text-transform: uppercase;">Địa chỉ</div>
                        <div style="font-size: .9rem;">{{ $company->address ?? '---' }}</div>
                    </div>
                </div>
                <a href="{{ route('enterprise.settings') }}" class="btn btn-gray" style="width: 100%; margin-top: 1.5rem;">Chỉnh sửa thông tin</a>
            </div>
        </div>
    </div>
</x-enterprise-layout>
