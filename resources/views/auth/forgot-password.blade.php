<x-guest-layout>
<div style="width:100%;max-width:460px">
    <div style="background:white;border-radius:16px;padding:2.2rem 2rem;box-shadow:0 8px 32px rgba(5,37,66,.15);border:1px solid #e2e8f0">
        <div style="text-align:center;margin-bottom:1.6rem">
            <div style="width:64px;height:64px;background:linear-gradient(135deg,var(--e-navy),#0a3d6b);border-radius:16px;margin:0 auto .9rem;display:flex;align-items:center;justify-content:center">
                <i class="ti ti-lock-question" style="color:var(--e-gold);font-size:1.6rem"></i>
            </div>
            <h1 style="font-size:1.5rem;font-weight:800;color:#1e293b;margin-bottom:.3rem">Quên mật khẩu?</h1>
            <p style="color:#64748b;font-size:.85rem;line-height:1.5;max-width:340px;margin:0 auto">Nhập địa chỉ email đã đăng ký, chúng tôi sẽ gửi cho bạn liên kết để đặt lại mật khẩu.</p>
        </div>

        @if(session('status'))
        <div class="alert alert-success">
            <i class="ti ti-circle-check" style="margin-right: 5px;"></i> {{ session('status') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger">
            <i class="fa-solid fa-circle-exclamation"></i>
            <span>{{ $errors->first() }}</span>
        </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <label class="form-label">Địa chỉ Email</label>
                <div class="input-wrap">
                    <i class="fa-regular fa-envelope fi"></i>
                    <input type="email" name="email" class="form-control" placeholder="Nhập email đã đăng ký" value="{{ old('email') }}" required autofocus>
                </div>
            </div>

            <button type="submit" class="guest-btn-primary" style="margin-top: .5rem;">
                <i class="ti ti-send"></i> Gửi liên kết đặt lại mật khẩu
            </button>
        </form>

        <div style="text-align:center;margin-top:1.5rem">
            <a href="{{ route('login') }}" style="font-size:.85rem;color:var(--e-navy);text-decoration:none;font-weight:600;display:inline-flex;align-items:center;gap:.4rem">
                <i class="ti ti-arrow-left"></i> Quay lại đăng nhập
            </a>
        </div>
    </div>
</div>
</x-guest-layout>
