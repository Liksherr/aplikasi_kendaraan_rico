<!doctype html>
<html lang="id">
<head><meta charset="utf-8"><style>
    body{font-family:DejaVu Sans,sans-serif;font-size:11px;color:#172033}h1{font-size:20px;margin:0 0 5px}p{color:#64748b;margin:0 0 18px}
    table{width:100%;border-collapse:collapse}th,td{border:1px solid #cbd5e1;padding:8px;text-align:left}th{background:#eaf0f8}
</style></head>
<body>
    <h1>Laporan Data Kendaraan</h1>
    <p>Pemilik akun: {{ $user->name }} · Dicetak {{ now()->format('d/m/Y H:i') }}</p>
    <table><thead><tr><th>No.</th><th>Nomor polisi</th><th>Jenis kendaraan</th><th>Nama pemilik</th><th>Terdaftar</th></tr></thead>
        <tbody>
        @forelse ($vehicles as $index => $vehicle)
            <tr><td>{{ $index + 1 }}</td><td>{{ $vehicle->plate_number }}</td><td>{{ $vehicle->vehicle_type }}</td><td>{{ $vehicle->owner_name }}</td><td>{{ $vehicle->created_at->format('d/m/Y') }}</td></tr>
        @empty
            <tr><td colspan="5">Belum ada data kendaraan.</td></tr>
        @endforelse
        </tbody>
    </table>
</body>
</html>
