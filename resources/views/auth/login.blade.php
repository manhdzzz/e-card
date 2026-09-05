<x-guest-layout>
<div style="width:100%;max-width:460px">
    <div style="background:white;border-radius:16px;padding:2.2rem 2rem;box-shadow:0 8px 32px rgba(5,37,66,.15);border:1px solid #e2e8f0">
        <!-- Icon & Title -->
        <div style="text-align:center;margin-bottom:1.6rem">
            <div style="width:64px;height:64px;background:linear-gradient(135deg,var(--e-navy),#0a3d6b);border-radius:16px;margin:0 auto .9rem;display:flex;align-items:center;justify-content:center">
                <i class="ti ti-id-badge" style="color:var(--e-gold);font-size:1.6rem"></i>
            </div>
            <h1 style="font-size:1.6rem;font-weight:800;color:#1e293b;margin-bottom:.3rem">Đăng nhập</h1>
            <p style="color:#64748b;font-size:.88rem">Truy cập hệ thống danh thiếp điện tử</p>
        </div>

        <!-- Session errors -->
        @if ($errors->any())
        <div class="alert alert-danger">
            <i class="fa-solid fa-circle-exclamation"></i>
            <span>{{ $errors->first() }}</span>
        </div>
        @endif

        @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label class="form-label">Email hoặc tên đăng nhập</label>
                <div class="input-wrap">
                    <i class="fa-regular fa-user fi"></i>
                    <input type="email" name="email" class="form-control" placeholder="Nhập email hoặc tên đăng nhập" value="{{ old('email') }}" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Mật khẩu</label>
                <div class="input-wrap">
                    <i class="fa-solid fa-lock fi"></i>
                    <input type="password" name="password" id="pw" class="form-control" placeholder="Nhập mật khẩu" required>
                    <button type="button" class="toggle-pw" id="toggle-pw-btn">
                        <i class="fa-regular fa-eye-slash" id="pw-icon"></i>
                    </button>
                </div>
            </div>

            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.3rem">
                <label style="display:flex;align-items:center;gap:.45rem;font-size:.83rem;color:#64748b;cursor:pointer">
                    <input type="checkbox" name="remember" style="accent-color:var(--e-navy);width:15px;height:15px">
                    Ghi nhớ đăng nhập
                </label>
                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" style="font-size:.83rem;color:var(--e-navy);text-decoration:none;font-weight:600">Quên mật khẩu?</a>
                @endif
            </div>

            <button type="submit" class="guest-btn-primary">Đăng nhập</button>
        </form>

        <div style="text-align:center;margin-top:1.2rem">
            <div style="display:flex;align-items:center;gap:.7rem;margin-bottom:.9rem">
                <div style="flex:1;height:1px;background:#e2e8f0"></div>
                <span style="font-size:.8rem;color:#94a3b8">Hoặc</span>
                <div style="flex:1;height:1px;background:#e2e8f0"></div>
            </div>
            <p style="font-size:.85rem;color:#64748b">
                Chưa có tài khoản? <a href="{{ route('register') }}" style="color:var(--e-navy);font-weight:700;text-decoration:none">Đăng ký ngay</a>
            </p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var btn = document.getElementById('toggle-pw-btn');
    if (btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            var pw = document.getElementById('pw');
            var icon = document.getElementById('pw-icon');
            if (pw.type === 'password') {
                pw.type = 'text';
                icon.className = 'fa-regular fa-eye';
            } else {
                pw.type = 'password';
                icon.className = 'fa-regular fa-eye-slash';
            }
        });
    }
});
</script>
</x-guest-layout>
