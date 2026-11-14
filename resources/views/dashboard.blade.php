@extends('layouts.app')

@section('title', 'Ringkasan')

@section('content')
<div class="page-head dashboard-head">
    <div>
        <p class="auth-kicker">RINGKASAN HARIAN &nbsp;·&nbsp; {{ now()->format('d.m.Y') }}</p>
        <h1>Selamat datang, {{ auth()->user()->name }} <span aria-hidden="true">✳</span></h1>
        <p class="muted">Semua urusan kendaraan Anda, tertata dalam satu tempat.</p>
    </div>
    <div class="toolbar flex items-center gap-2">
        <a class="btn secondary" href="{{ route('vehicles.create') }}"><span aria-hidden="true">＋</span> Kendaraan</a>
        <a class="btn" href="{{ route('queues.create') }}"><span aria-hidden="true">＋</span> Buat antrian</a>
    </div>
</div>
<section class="cards">
    <article class="card metric-card">
        <div class="metric-top"><span class="metric-label">Kendaraan terdaftar</span><span class="metric-icon"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 13.5h16l-1.6-5a2 2 0 0 0-1.9-1.4H7.5a2 2 0 0 0-1.9 1.4L4 13.5Z"/><path d="M4 13.5v4m16-4v4M7.5 17.5h9M7 17.5a1 1 0 1 1-2 0m14 0a1 1 0 1 1-2 0"/></svg></span></div>
        <div class="metric">{{ $vehicleCount }}</div><p class="metric-note">Total kendaraan milik Anda</p>
    </article>
    <article class="card metric-card">
        <div class="metric-top"><span class="metric-label">Antrian hari ini</span><span class="metric-icon amber"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="4" y="5.5" width="16" height="15" rx="2"/><path d="M8 3.5v4m8-4v4M4 10h16m-11 4h2m3 0h2m-7 3h2"/></svg></span></div>
        <div class="metric">{{ $todayQueueCount }}</div><p class="metric-note">Jadwal yang tercatat untuk hari ini</p>
    </article>
    <article class="card metric-card">
        <div class="metric-top"><span class="metric-label">Sedang menunggu</span><span class="metric-icon blue"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="12" r="8.5"/><path d="M12 7v5l3 2"/></svg></span></div>
        <div class="metric">{{ $waitingCount }}</div><p class="metric-note">Antrian dengan status menunggu</p>
    </article>
</section>
<section class="card section-card">
    <div class="section-heading">
        <div><h2>Antrian terbaru</h2><p>Aktivitas antrian kendaraan Anda</p></div>
        <a class="text-link" href="{{ route('queues.index') }}">Lihat semua <span aria-hidden="true">→</span></a>
    </div>
    @if ($queues->isEmpty())
        <div class="empty-state">
            <span class="empty-icon" aria-hidden="true">↗</span>
            <strong>Belum ada antrian</strong>
            <p>Buat antrian pertama untuk melihat aktivitas Anda di sini.</p>
            <a class="btn" href="{{ route('queues.create') }}">Buat antrian pertama <span aria-hidden="true">→</span></a>
        </div>
    @else
        <div class="table-wrap overflow-x-auto"><table>
            <thead><tr><th>No. antrian</th><th>Tanggal</th><th>Waktu</th><th>Kendaraan</th><th>Status</th></tr></thead>
            <tbody>@foreach ($queues as $queue)
                <tr>
                    <td><span class="table-primary">#{{ str_pad($queue->queue_number, 3, '0', STR_PAD_LEFT) }}</span></td>
                    <td>{{ $queue->queue_date->format('d/m/Y') }}</td>
                    <td>{{ substr($queue->queue_time, 0, 5) }}</td>
                    <td><span class="table-primary">{{ $queue->vehicle->plate_number }}</span><span class="table-sub">{{ $queue->vehicle->vehicle_type }}</span></td>
                    <td><span class="status {{ strtolower($queue->status) }}">{{ $queue->status }}</span></td>
                </tr>
            @endforeach</tbody>
        </table></div>
    @endif
</section>
@endsection
