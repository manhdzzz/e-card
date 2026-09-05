<section>
    <p class="pf-desc">
        Cập nhật thông tin hồ sơ tài khoản và địa chỉ email của bạn.
    </p>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" style="margin-top: 1.5rem;">
        @csrf
        @method('patch')

        <div class="pf-form-group">
            <label for="name" class="pf-form-label">Họ và tên</label>
            <input id="name" name="name" type="text" class="pf-form-input" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            @error('name')<span class="pf-error">{{ $message }}</span>@enderror
        </div>

        <div class="pf-form-group">
            <label for="email" class="pf-form-label">Email</label>
            <input id="email" name="email" type="email" class="pf-form-input" value="{{ old('email', $user->email) }}" required autocomplete="username" />
            @error('email')<span class="pf-error">{{ $message }}</span>@enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div style="margin-top: .5rem;">
                    <p class="pf-desc" style="color: #ca8a04; margin-bottom: 0;">
                        Địa chỉ email của bạn chưa được xác minh.
                        <button form="send-verification" style="background:none; border:none; color:#2563eb; text-decoration:underline; cursor:pointer; padding:0; font-size:.85rem;">
                            Nhấn vào đây để gửi lại email xác minh.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p style="color: #16a34a; font-size: .85rem; font-weight: 600; margin-top: .5rem;">
                            Một liên kết xác minh mới đã được gửi đến địa chỉ email của bạn.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div style="display: flex; align-items: center; gap: 1rem; margin-top: 2rem;">
            <button type="submit" class="pf-btn">Lưu thông tin</button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" style="color: #16a34a; font-size: .85rem; font-weight: 600; margin: 0;">
                    <i class="ti ti-check"></i> Đã lưu thành công.
                </p>
            @endif
        </div>
    </form>
</section>
