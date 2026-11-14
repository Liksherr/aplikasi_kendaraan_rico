@extends('layouts.app')

@section('title', 'Daftar')

@section('content')
<div class="auth-wrap grid">
    <section class="auth-aside">
        <div class="auth-aside-top">
            <span class="auth-aside-tag"><span></span> Mulai dalam beberapa langkah</span>
            <h2>Ruang kerja baru untuk kendaraan Anda.</h2>
            <p>Buat akun, daftarkan kendaraan, dan kelola jadwal antrian dengan lebih tenang.</p>
        </div>
        <div class="auth-illustration" aria-hidden="true">
            <svg class="road-art" viewBox="0 0 280 126" fill="none">
                <path d="M88 126 116 0h48l28 126" fill="#ffffff0b" stroke="#ffffff22"/>
                <path d="m137 111 2-17m3-27 2-17m2-27 1-13" stroke="#e5c48d" stroke-width="3" stroke-linecap="round" stroke-dasharray="7 8"/>
                <path d="M56 87 69 57h42l13 30v24H56V87Z" fill="#e4b979"/>
                <path d="m70 59 5-13h30l7 13H70Z" fill="#edf2e8"/>
                <path d="M58 87h64m-53 15h40" stroke="#173f31" stroke-width="2"/>
                <circle cx="71" cy="111" r="7" fill="#183f30" stroke="#e9eee5" stroke-width="2"/>
                <circle cx="108" cy="111" r="7" fill="#183f30" stroke="#e9eee5" stroke-width="2"/>
                <path d="m169 75 6-15 6-3h30l8 18v19h-50V75Z" fill="#a9c8b3"/>
                <path d="m178 61 5-11h26l6 11h-37Z" fill="#eff3ed"/>
                <path d="M171 75h47m-40 12h32" stroke="#183f30" stroke-width="2"/>
                <circle cx="181" cy="94" r="6" fill="#183f30" stroke="#e9eee5" stroke-width="2"/>
                <circle cx="208" cy="94" r="6" fill="#183f30" stroke="#e9eee5" stroke-width="2"/>
                <path d="M32 36h18m-9-9v18m190-9h18m-9-9v18" stroke="#ffffff42" stroke-linecap="round"/>
            </svg>
        </div>
        <span class="auth-aside-note">Gratis untuk memulai. Mudah digunakan setiap hari.</span>
    </section>
    <section class="auth-panel">
        <div class="auth-panel-inner">
            <p class="auth-kicker">Mulai sekarang</p>
            <h1 class="auth-title">Buat akun baru</h1>
            <p class="auth-intro">Isi data berikut untuk mulai mengatur kendaraan dan antrian.</p>
            <form method="post" action="{{ route('register.store') }}">
                @csrf
                <label for="name">Nama lengkap</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" placeholder="Nama Anda" required autocomplete="name">
                <label for="email">Alamat email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="nama@email.com" required autocomplete="email">
                <label for="password">Kata sandi</label>
                <input id="password" name="password" type="password" placeholder="Minimal 8 karakter" required autocomplete="new-password">
                <label for="password_confirmation">Ulangi kata sandi</label>
                <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Masukkan kembali kata sandi" required autocomplete="new-password">
                <div class="form-actions flex gap-2"><button class="btn" type="submit">Buat akun <span aria-hidden="true">→</span></button></div>
            </form>
            <p class="auth-switch">Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></p>
        </div>
    </section>
</div>
@endsection
