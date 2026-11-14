@extends('layouts.app')

@section('title', 'Data Kendaraan')

@section('content')
<div class="page-head">
    <div><h1>Data kendaraan</h1><p class="muted">Kendaraan yang terdaftar pada akun Anda.</p></div>
    <div class="toolbar flex items-center gap-2"><a class="btn secondary" href="{{ route('reports.vehicles') }}">Unduh PDF</a><a class="btn" href="{{ route('vehicles.create') }}">+ Tambah kendaraan</a></div>
</div>
<section class="card">
    @if ($vehicles->isEmpty())
        <p class="muted">Belum ada kendaraan terdaftar.</p>
    @else
        <div class="table-wrap"><table>
            <thead><tr><th>Nomor polisi</th><th>Jenis kendaraan</th><th>Nama pemilik</th><th>Aksi</th></tr></thead>
            <tbody>@foreach ($vehicles as $vehicle)
                <tr>
                    <td><strong>{{ $vehicle->plate_number }}</strong></td><td>{{ $vehicle->vehicle_type }}</td><td>{{ $vehicle->owner_name }}</td>
                    <td><div class="actions"><a class="btn secondary small" href="{{ route('vehicles.edit', $vehicle) }}">Ubah</a>
                        <form method="post" action="{{ route('vehicles.destroy', $vehicle) }}" onsubmit="return confirm('Hapus kendaraan ini?')">@csrf @method('DELETE')<button class="btn danger small" type="submit">Hapus</button></form>
                    </div></td>
                </tr>
            @endforeach</tbody>
        </table></div>
        <div class="pagination">{{ $vehicles->links() }}</div>
    @endif
</section>
@endsection
