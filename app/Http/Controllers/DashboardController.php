<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user = $request->user();

        return view('dashboard', [
            'vehicleCount' => $user->vehicles()->count(),
            'todayQueueCount' => $user->queueEntries()->whereDate('queue_date', today())->count(),
            'waitingCount' => $user->queueEntries()->where('status', 'Menunggu')->count(),
            'queues' => $user->queueEntries()->with('vehicle')->orderByDesc('queue_date')
                ->orderByDesc('queue_time')->limit(6)->get(),
        ]);
    }
}
