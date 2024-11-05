<?php

namespace App\Http\Controllers\Admin;

use Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Ticket;

class HomeController
{
    public function index()
    {
        // Cek izin akses ke dashboard
        abort_if(Gate::denies('dashboard_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // Hitung total semua tiket
        $totalTickets = Ticket::count();

        // Hitung tiket yang dibuat bulan ini
        $ticketThisMonth = Ticket::whereMonth('created_at', now()->month)
                                ->whereYear('created_at', now()->year)
                                ->count();

        // Hitung jumlah tiket berdasarkan statusnya
        $ticketCounts = Ticket::with('status')
            ->selectRaw("
                SUM(CASE WHEN statuses.name = 'New' THEN 1 ELSE 0 END) as newTickets,
                SUM(CASE WHEN statuses.name = 'Open' THEN 1 ELSE 0 END) as openTickets,
                SUM(CASE WHEN statuses.name = 'Pending' THEN 1 ELSE 0 END) as pendingTickets,
                SUM(CASE WHEN statuses.name = 'Closed' THEN 1 ELSE 0 END) as closedTickets
            ")
            ->join('statuses', 'tickets.status_id', '=', 'statuses.id')
            ->first();

        return view('home', [
            'totalTickets' => $totalTickets,
            'ticketThisMonth' => $ticketThisMonth,
            'newTickets' => $ticketCounts->newTickets,
            'openTickets' => $ticketCounts->openTickets,
            'pendingTickets' => $ticketCounts->pendingTickets,
            'closedTickets' => $ticketCounts->closedTickets,
        ]);
    }
}
