<div>
    <h2 class="h2 text-center mb-4">{{ $app }}</h2>
    <form wire:submit.prevent="loginHandle()" autocomplete="off"
        action="{{ route('login') }}?{{ http_build_query(['next' => request()->query('next', ''), 'param' => Str::random(10)]) }}">
        <div class="mb-3">
            <label class="form-label">Alamat Email</label>
            <input type="email" wire:model="email" required class="form-control" placeholder="email@sekolah.com"
                autocomplete="off">
            @error('email')
                <span>{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-2">
            <label class="form-label">
                Kata sandi
            </label>
            <div class="input-group input-group-flat">
                <input type="password" wire:model="password" required class="form-control" placeholder="Kata sandi"
                    autocomplete="off">
                @error('password')
                    <span>{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div>
            <small>Jika terjadi lupa password, harap hubungi operator aplikasi untuk minta
                reset password!</small>
        </div>
        <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">Masuk Aplikasi</button>
        </div>
    </form>
</div>
@push('js')
@endpush
