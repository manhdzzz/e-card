<section>
    <p class="pf-desc">
        Đảm bảo tài khoản của bạn đang sử dụng một mật khẩu dài và ngẫu nhiên để giữ an toàn.
    </p>

    <form method="post" action="{{ route('password.update') }}" style="margin-top: 1.5rem;">
        @csrf
        @method('put')

        <div class="pf-form-group">
            <label for="update_password_current_password" class="pf-form-label">Mật khẩu hiện tại</label>
            <input id="update_password_current_password" name="current_password" type="password" class="pf-form-input" autocomplete="current-password" />
            @error('current_password', 'updatePassword')<span class="pf-error">{{ $message }}</span>@enderror
        </div>

        <div class="pf-form-group">
            <label for="update_password_password" class="pf-form-label">Mật khẩu mới</label>
            <input id="update_password_password" name="password" type="password" class="pf-form-input" autocomplete="new-password" />
            @error('password', 'updatePassword')<span class="pf-error">{{ $message }}</span>@enderror
        </div>

        <div class="pf-form-group">
            <label for="update_password_password_confirmation" class="pf-form-label">Xác nhận mật khẩu</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="pf-form-input" autocomplete="new-password" />
            @error('password_confirmation', 'updatePassword')<span class="pf-error">{{ $message }}</span>@enderror
        </div>

        <div style="display: flex; align-items: center; gap: 1rem; margin-top: 2rem;">
            <button type="submit" class="pf-btn">Cập nhật mật khẩu</button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" style="color: #16a34a; font-size: .85rem; font-weight: 600; margin: 0;">
                    <i class="ti ti-check"></i> Đã cập nhật.
                </p>
            @endif
        </div>
    </form>
</section>
