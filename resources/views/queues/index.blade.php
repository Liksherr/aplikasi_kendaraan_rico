@extends('layouts.app')

@section('title', 'Data Antrian')

@section('content')
<div class="page-head">
    <div><h1>Daftar antrian kendaraan</h1><p class="muted">Kelola jadwal dan status antrian kendaraan.</p></div>
    <div class="toolbar flex items-center gap-2"><a class="btn secondary" href="{{ route('reports.queues') }}">Unduh PDF</a><a class="btn" href="{{ route('queues.create') }}">+ Buat antrian</a></div>
</div>
<section class="card">
    @if ($queues->isEmpty())
        <p class="muted">Belum ada data antrian.</p>
    @else
        <div class="table-wrap"><table>
            <thead><tr><th>No. antrian</th><th>Tanggal</th><th>Waktu</th><th>Kendaraan</th><th>Pemilik</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>@foreach ($queues as $queue)
                <tr>
                    <td><strong>#{{ $queue->queue_number }}</strong></td><td>{{ $queue->queue_date->format('d/m/Y') }}</td><td>{{ substr($queue->queue_time, 0, 5) }}</td>
                    <td>{{ $queue->vehicle->plate_number }}<br><span class="muted">{{ $queue->vehicle->vehicle_type }}</span></td><td>{{ $queue->vehicle->owner_name }}</td>
                    <td><span class="status {{ strtolower($queue->status) }}">{{ $queue->status }}</span></td>
                    <td><div class="actions"><a class="btn secondary small" href="{{ route('queues.edit', $queue) }}">Ubah</a>
                        <form method="post" action="{{ route('queues.destroy', $queue) }}" onsubmit="return confirm('Hapus antrian ini?')">@csrf @method('DELETE')<button class="btn danger small" type="submit">Hapus</button></form>
                    </div></td>
                </tr>
            @endforeach</tbody>
        </table></div>
        <div class="pagination">{{ $queues->links() }}</div>
    @endif
</section>
@endsection
