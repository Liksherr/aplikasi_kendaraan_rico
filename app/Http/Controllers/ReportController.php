<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReportController extends Controller
{
    public function vehicles(Request $request): Response
    {
        $pdf = Pdf::loadView('reports.vehicles', [
            'vehicles' => $request->user()->vehicles()->orderBy('plate_number')->get(),
            'user' => $request->user(),
        ])->setPaper('a4', 'portrait');

        return $pdf->download('laporan-kendaraan.pdf');
    }

    public function queues(Request $request): Response
    {
        $pdf = Pdf::loadView('reports.queues', [
            'queues' => $request->user()->queueEntries()->with('vehicle')
                ->orderByDesc('queue_date')->orderBy('queue_time')->get(),
            'user' => $request->user(),
        ])->setPaper('a4', 'landscape');

        return $pdf->download('laporan-antrian-kendaraan.pdf');
    }
}
