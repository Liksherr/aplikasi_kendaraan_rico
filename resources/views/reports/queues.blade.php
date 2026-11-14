<!doctype html>
<html lang="id">
<head><meta charset="utf-8"><style>
    body{font-family:DejaVu Sans,sans-serif;font-size:10px;color:#172033}h1{font-size:20px;margin:0 0 5px}p{color:#64748b;margin:0 0 18px}
    table{width:100%;border-collapse:collapse}th,td{border:1px solid #cbd5e1;padding:7px;text-align:left}th{background:#eaf0f8}
</style></head>
<body>
    <h1>Laporan Data Antrian Kendaraan</h1>
    <p>Pemilik akun: {{ $user->name }} · Dicetak {{ now()->format('d/m/Y H:i') }}</p>
    <table><thead><tr><th>No.</th><th>No. antrian</th><th>Tanggal</th><th>Waktu</th><th>Nomor polisi</th><th>Jenis kendaraan</th><th>Nama pemilik</th><th>Status</th></tr></thead>
        <tbody>
        @forelse ($queues as $index => $queue)
            <tr><td>{{ $index + 1 }}</td><td>{{ $queue->queue_number }}</td><td>{{ $queue->queue_date->format('d/m/Y') }}</td><td>{{ substr($queue->queue_time, 0, 5) }}</td><td>{{ $queue->vehicle->plate_number }}</td><td>{{ $queue->vehicle->vehicle_type }}</td><td>{{ $queue->vehicle->owner_name }}</td><td>{{ $queue->status }}</td></tr>
        @empty
            <tr><td colspan="8">Belum ada data antrian.</td></tr>
        @endforelse
        </tbody>
    </table>
</body>
</html>
