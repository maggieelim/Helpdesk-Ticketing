<?php

namespace App\Http\Controllers;

use App\Models\employee;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function manager(Request $request)
    {
        // Get start and end dates from the request
        $startDate = $request->input('start');
        $endDate = $request->input('end');

        $query = Ticket::where('status_id', 5);
        // Apply date filtering if provided
        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }
        $tickets = $query->get()->groupBy('action');

        // Hasil data per action
        $data = []; // Initialize $data as an empty array
        $actionData = [];
        $totalAvgResolutionTime = 0; // Variable to store the sum of avg_resolution_time
        $actionCount = 0; // To count how many actions (groups) we have

        foreach ($tickets as $action => $groupedTickets) {
            $totalTickets = $groupedTickets->count();
            $totalResolutionTime = $groupedTickets->sum(function ($ticket) {
                return round(Carbon::parse($ticket->created_at)->diffInBusinessHours(Carbon::parse($ticket->updated_at)), 2);
            });

            $employee = employee::select('first_name', 'last_name')->where('NIP', $action)->first();

            // Now you can access the first_name and last_name properties
            $avgResolutionTime = $totalTickets > 0 ? round($totalResolutionTime / $totalTickets, 2) : 0;

            $data[] = [
                'first_name' => $employee->first_name,
                'last_name' => $employee->last_name,
                'action' => $action,
                'total_tickets' => $totalTickets,
                'total_resolution_time' => $totalResolutionTime,
                'avg_resolution_time' => $avgResolutionTime,
            ];

            // Add to overall sum and action count for overall average calculation
            $totalAvgResolutionTime += $avgResolutionTime;
            $actionCount++;
        }

        // Calculate overall average resolution time
        $overallAvg = $actionCount > 0 ? round($totalAvgResolutionTime / $actionCount, 2) : 0;

        return view('ticket.evaluation', compact('data', 'overallAvg'));
    }


    public function technicalSupport(Request $request)
    {
        $user = Auth::user();
        $startDate = $request->input('start');
        $endDate = $request->input('end');
        $categoryCountsQuery = Ticket::select('tk.category', DB::raw('count(*) as totalCategory'))
            ->join('tiket_category as tk', 'tiket.category_id', '=', 'tk.category_id') // Join dengan tabel tiket_category
            ->where('tiket.action', $user->id)
            ->where('tiket.status_id', 5);


        $urgencyCountsQuery = Ticket::select('tk.urgency', DB::raw('count(*) as totalUrgency'))
            ->join('tiket_urgency as tk', 'tiket.urgency_id', '=', 'tk.urgency_id') // Join dengan tabel tiket_category
            ->where('tiket.action', $user->id)
            ->where('tiket.status_id', 5);

        // Ambil data tiket yang telah diselesaikan
        $query = Ticket::where('status_id', 5)
            ->where('action', $user->id);

        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
            $categoryCountsQuery->whereDate('tiket.created_at', '>=', $startDate);
            $urgencyCountsQuery->whereDate('tiket.created_at', '>=', $startDate);
        }
        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
            $categoryCountsQuery->whereDate('tiket.created_at', '<=', $endDate);
            $urgencyCountsQuery->whereDate('tiket.created_at', '<=', $endDate);
        }

        $categoryCounts = $categoryCountsQuery->groupBy('tk.category')
            ->orderBy('tk.category')
            ->get();

        $urgencyCounts = $urgencyCountsQuery->groupBy('tk.urgency')
            ->orderBy('tk.urgency')
            ->get();

        $tickets = $query->orderBy('id', 'asc')->get();
        $totalTickets = $tickets->count();
        $totalResolutionTime = $tickets->sum(function ($ticket) {
            return round(Carbon::parse($ticket->created_at)->diffInBusinessHours(Carbon::parse($ticket->updated_at)), 2);
        });

        $avgResolutionTime = $totalTickets > 0 ? round($totalResolutionTime / $totalTickets, 2) : 0; // Hitung rata-rata waktu penyelesaian

        // Menyusun data untuk setiap tiket
        $ticketData = [];
        foreach ($tickets as $index => $ticket) {
            $start = Carbon::parse($ticket->created_at);
            $end = Carbon::parse($ticket->updated_at);
            $resolutionTime = $start->diffInBusinessHours($end);
            $ticketData[] = [
                'ticket_number' => $ticket->TID, // Nomor urut tiket
                'resolution_time' => $resolutionTime // Waktu penyelesaian
            ];
        }

        $data = [
            'total_tickets' => $totalTickets,
            'total_resolution_time' => $totalResolutionTime,
            'avg_resolution_time' => $avgResolutionTime,
            'ticket_details' => $ticketData
        ];

        return view('ticketTask.evaluation', compact('data', 'categoryCounts', 'urgencyCounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
