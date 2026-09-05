<x-guest-layout>
<div style="width:100%;max-width:460px">
    <div style="background:white;border-radius:16px;padding:2.2rem 2rem;box-shadow:0 8px 32px rgba(5,37,66,.15);border:1px solid #e2e8f0">
        <div style="text-align:center;margin-bottom:1.6rem">
            <div style="width:64px;height:64px;background:linear-gradient(135deg,var(--e-navy),#0a3d6b);border-radius:16px;margin:0 auto .9rem;display:flex;align-items:center;justify-content:center">
                <i class="ti ti-key" style="color:var(--e-gold);font-size:1.6rem"></i>
            </div>
            <h1 style="font-size:1.5rem;font-weight:800;color:#1e293b;margin-bottom:.3rem">Đặt lại mật khẩu</h1>
            <p style="color:#64748b;font-size:.85rem">Nhập mật khẩu mới cho tài khoản của bạn.</p>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul style="margin:0; padding-left: 1.2rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('password.store') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="form-group">
                <label class="form-label">Email</label>
                <div class="input-wrap">
                    <i class="fa-regular fa-envelope fi"></i>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $request->email) }}" required autofocus readonly style="background:#f8fafc;">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Mật khẩu mới</label>
                <div class="input-wrap">
                    <i class="fa-solid fa-lock fi"></i>
                    <input type="password" name="password" id="reset_pw" class="form-control" placeholder="Nhập mật khẩu mới" required>
                    <button type="button" class="toggle-pw" onclick="toggleResetPw('reset_pw','reset_pw_icon')">
                        <i class="fa-regular fa-eye-slash" id="reset_pw_icon"></i>
                    </button>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Xác nhận mật khẩu mới</label>
                <div class="input-wrap">
                    <i class="fa-solid fa-lock fi"></i>
                    <input type="password" name="password_confirmation" id="reset_pw2" class="form-control" placeholder="Nhập lại mật khẩu mới" required>
                    <button type="button" class="toggle-pw" onclick="toggleResetPw('reset_pw2','reset_pw2_icon')">
                        <i class="fa-regular fa-eye-slash" id="reset_pw2_icon"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="guest-btn-primary" style="margin-top: .5rem;">
                <i class="ti ti-check"></i> Đặt lại mật khẩu
            </button>
        </form>
    </div>
</div>

<script>
function toggleResetPw(inputId, iconId) {
    var pw = document.getElementById(inputId);
    var icon = document.getElementById(iconId);
    if (pw.type === 'password') {
        pw.type = 'text';
        icon.className = 'fa-regular fa-eye';
    } else {
        pw.type = 'password';
        icon.className = 'fa-regular fa-eye-slash';
    }
}
</script>
</x-guest-layout>
