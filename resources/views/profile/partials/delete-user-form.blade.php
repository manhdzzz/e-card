<section>
    <button class="pf-btn-danger" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
        <i class="ti ti-trash"></i> Xóa tài khoản
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" style="padding: 2rem;">
            @csrf
            @method('delete')

            <h2 style="font-size: 1.2rem; font-weight: 700; color: #1e293b; margin-bottom: 1rem; margin-top: 0;">
                Bạn có chắc chắn muốn xóa tài khoản này không?
            </h2>

            <p class="pf-desc">
                Một khi tài khoản của bạn bị xóa, tất cả dữ liệu sẽ bị xóa vĩnh viễn. Vui lòng nhập mật khẩu của bạn để xác nhận hành động này.
            </p>

            <div class="pf-form-group">
                <label for="password" class="pf-form-label sr-only">Mật khẩu</label>
                <input id="password" name="password" type="password" class="pf-form-input" placeholder="Mật khẩu của bạn" />
                @error('password', 'userDeletion')<span class="pf-error">{{ $message }}</span>@enderror
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 1.5rem;">
                <button type="button" class="pf-btn" style="background: #f1f5f9; color: #475569;" x-on:click="$dispatch('close')">
                    Hủy
                </button>

                <button type="submit" class="pf-btn-danger">
                    Xác nhận xóa tài khoản
                </button>
            </div>
        </form>
    </x-modal>
</section>
