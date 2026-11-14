<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f5f7f4">
    <title>@yield('title', 'AntriKendaraan') - AntriKendaraan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @auth
        <div class="app-shell">
            <aside class="sidebar">
                <a class="brand" href="{{ route('dashboard') }}">
                    <span class="brand-mark" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none"><path d="M4 13.5h16l-1.6-5a2 2 0 0 0-1.9-1.4H7.5a2 2 0 0 0-1.9 1.4L4 13.5Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M4 13.5v4m16-4v4M7.5 17.5h9M7 17.5a1 1 0 1 1-2 0m14 0a1 1 0 1 1-2 0" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                    </span>
                    <span>antri<span class="brand-light">kendaraan</span></span>
                </a>

                <p class="nav-caption">MENU UTAMA</p>
                <nav class="side-nav" aria-label="Navigasi utama">
                    <a class="{{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="3.5" y="3.5" width="7" height="7" rx="1.5"/><rect x="13.5" y="3.5" width="7" height="7" rx="1.5"/><rect x="3.5" y="13.5" width="7" height="7" rx="1.5"/><rect x="13.5" y="13.5" width="7" height="7" rx="1.5"/></svg>
                        Ringkasan
                    </a>
                    <a class="{{ request()->routeIs('vehicles.*') ? 'active' : '' }}" href="{{ route('vehicles.index') }}">
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 13.5h16l-1.6-5a2 2 0 0 0-1.9-1.4H7.5a2 2 0 0 0-1.9 1.4L4 13.5Z"/><path d="M4 13.5v4m16-4v4M7.5 17.5h9M7 17.5a1 1 0 1 1-2 0m14 0a1 1 0 1 1-2 0"/></svg>
                        Kendaraan
                    </a>
                    <a class="{{ request()->routeIs('queues.*') ? 'active' : '' }}" href="{{ route('queues.index') }}">
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M8 5h12M8 12h12M8 19h12M3.5 5h.01M3.5 12h.01M3.5 19h.01"/></svg>
                        Antrian
                    </a>
                </nav>

                <p class="nav-caption nav-caption-reports">LAPORAN</p>
                <nav class="side-nav" aria-label="Laporan">
                    <a href="{{ route('reports.vehicles') }}">
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M7 3.75h7l4 4v12.5H7a2 2 0 0 1-2-2v-12.5a2 2 0 0 1 2-2Z"/><path d="M14 3.75v4h4M8.5 12h7m-7 3.5h7"/></svg>
                        Laporan kendaraan
                        <span class="download-mark" aria-hidden="true">↓</span>
                    </a>
                    <a href="{{ route('reports.queues') }}">
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M7 3.75h7l4 4v12.5H7a2 2 0 0 1-2-2v-12.5a2 2 0 0 1 2-2Z"/><path d="M14 3.75v4h4M8.5 12h7m-7 3.5h7"/></svg>
                        Laporan antrian
                        <span class="download-mark" aria-hidden="true">↓</span>
                    </a>
                </nav>

                <div class="sidebar-bottom">
                    <div class="help-card">
                        <span class="help-spark" aria-hidden="true">✳</span>
                        <strong>Semua lebih teratur.</strong>
                        <p>Kelola kendaraan dan pantau antrian dalam satu tempat.</p>
                    </div>
                    <div class="profile-card">
                        <span class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                        <span class="profile-copy"><strong>{{ auth()->user()->name }}</strong><small>Akun pengelola</small></span>
                        <form method="post" action="{{ route('logout') }}">
                            @csrf
                            <button class="logout-button" type="submit" aria-label="Keluar">
                                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M10 4H5.5A1.5 1.5 0 0 0 4 5.5v13A1.5 1.5 0 0 0 5.5 20H10m4-4 4-4-4-4m4 4H9"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </aside>

            <div class="workspace">
                <header class="mobile-header">
                    <div class="mobile-header-top">
                        <a class="brand" href="{{ route('dashboard') }}"><span class="brand-mark" aria-hidden="true">A</span><span>antri<span class="brand-light">kendaraan</span></span></a>
                        <form method="post" action="{{ route('logout') }}">@csrf<button class="logout-button" type="submit" aria-label="Keluar"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M10 4H5.5A1.5 1.5 0 0 0 4 5.5v13A1.5 1.5 0 0 0 5.5 20H10m4-4 4-4-4-4m4 4H9"/></svg></button></form>
                    </div>
                    <nav class="mobile-nav" aria-label="Navigasi utama">
                        <a class="{{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Ringkasan</a>
                        <a class="{{ request()->routeIs('vehicles.*') ? 'active' : '' }}" href="{{ route('vehicles.index') }}">Kendaraan</a>
                        <a class="{{ request()->routeIs('queues.*') ? 'active' : '' }}" href="{{ route('queues.index') }}">Antrian</a>
                        <a href="{{ route('reports.vehicles') }}">PDF kendaraan</a>
                        <a href="{{ route('reports.queues') }}">PDF antrian</a>
                    </nav>
                </header>
                <main class="main-content">
                    @if (session('success'))<div class="alert">{{ session('success') }}</div>@endif
                    @if ($errors->any())
                        <div class="alert errors"><strong>Periksa kembali data yang dimasukkan.</strong><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
                    @endif
                    @yield('content')
                </main>
                <footer class="app-footer"><span>ANTRIKENDARAAN</span><span>Pengelolaan kendaraan, tanpa repot.</span></footer>
            </div>
        </div>
    @else
        <div class="public-shell">
            <header class="public-header">
                <a class="brand" href="{{ route('login') }}">
                    <span class="brand-mark" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none"><path d="M4 13.5h16l-1.6-5a2 2 0 0 0-1.9-1.4H7.5a2 2 0 0 0-1.9 1.4L4 13.5Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M4 13.5v4m16-4v4M7.5 17.5h9M7 17.5a1 1 0 1 1-2 0m14 0a1 1 0 1 1-2 0" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                    </span>
                    <span>antri<span class="brand-light">kendaraan</span></span>
                </a>
                <div class="public-links">
                    <span class="public-prompt">Mulai kelola antrian dengan mudah</span>
                    <a class="public-link" href="{{ request()->routeIs('register') ? route('login') : route('register') }}">{{ request()->routeIs('register') ? 'Masuk' : 'Buat akun' }} <span aria-hidden="true">↗</span></a>
                </div>
            </header>
            <main class="public-main">
                @if (session('success'))<div class="alert">{{ session('success') }}</div>@endif
                @if ($errors->any())
                    <div class="alert errors"><strong>Periksa kembali data yang dimasukkan.</strong><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
                @endif
                @yield('content')
            </main>
            <footer class="public-footer"><span>© {{ now()->year }} AntriKendaraan</span><span>Lebih rapi. Lebih lancar.</span></footer>
        </div>
    @endauth
</body>
</html>
