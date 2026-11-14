@extends('layouts.app')

@section('title', 'Masuk')

@section('content')
<div class="auth-wrap grid">
    <section class="auth-aside">
        <div class="auth-aside-top">
            <span class="auth-aside-tag"><span></span> Sistem antrian kendaraan</span>
            <h2>Perjalanan yang lancar dimulai dari sini.</h2>
            <p>Simpan data kendaraan dan atur antrian harian dengan cara yang lebih praktis.</p>
        </div>
        <div class="auth-illustration" aria-hidden="true">
            <svg class="road-art" viewBox="0 0 280 126" fill="none">
                <path d="M88 126 116 0h48l28 126" fill="#ffffff0b" stroke="#ffffff22"/>
                <path d="m137 111 2-17m3-27 2-17m2-27 1-13" stroke="#e5c48d" stroke-width="3" stroke-linecap="round" stroke-dasharray="7 8"/>
                <path d="m56 87 8-20 8-4h39l10 24v24H56V87Z" fill="#e4b979"/>
                <path d="m67 68 6-14h35l8 14H67Z" fill="#edf2e8"/>
                <path d="M58 87h62m-53 15h40" stroke="#173f31" stroke-width="2"/>
                <circle cx="71" cy="111" r="7" fill="#183f30" stroke="#e9eee5" stroke-width="2"/>
                <circle cx="107" cy="111" r="7" fill="#183f30" stroke="#e9eee5" stroke-width="2"/>
                <path d="m169 75 6-15 6-3h30l8 18v19h-50V75Z" fill="#a9c8b3"/>
                <path d="m178 61 5-11h26l6 11h-37Z" fill="#eff3ed"/>
                <path d="M171 75h47m-40 12h32" stroke="#183f30" stroke-width="2"/>
                <circle cx="181" cy="94" r="6" fill="#183f30" stroke="#e9eee5" stroke-width="2"/>
                <circle cx="208" cy="94" r="6" fill="#183f30" stroke="#e9eee5" stroke-width="2"/>
                <path d="M32 36h18m-9-9v18m190-9h18m-9-9v18" stroke="#ffffff42" stroke-linecap="round"/>
            </svg>
        </div>
        <span class="auth-aside-note">Dibuat untuk hari yang lebih tertata.</span>
    </section>
    <section class="auth-panel">
        <div class="auth-panel-inner">
            <p class="auth-kicker">Senang bertemu lagi</p>
            <h1 class="auth-title">Selamat datang</h1>
            <p class="auth-intro">Masuk ke akun Anda untuk melanjutkan mengelola kendaraan dan antrian.</p>
            <form method="post" action="{{ route('login.store') }}">
                @csrf
                <label for="email">Alamat email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="nama@email.com" required autofocus autocomplete="email">
                <label for="password">Kata sandi</label>
                <input id="password" name="password" type="password" placeholder="Masukkan kata sandi" required autocomplete="current-password">
                <label class="remember-row"><input type="checkbox" name="remember" value="1"> Ingat saya di perangkat ini</label>
                <div class="form-actions flex gap-2"><button class="btn" type="submit">Masuk ke akun <span aria-hidden="true">→</span></button></div>
            </form>
            <p class="auth-switch">Belum punya akun? <a href="{{ route('register') }}">Daftar gratis</a></p>
        </div>
    </section>
</div>
@endsection
