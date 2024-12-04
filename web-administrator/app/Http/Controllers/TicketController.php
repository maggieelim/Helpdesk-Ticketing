<?php

namespace App\Http\Controllers;

use App\Models\employee;
use App\Models\Merchant;
use App\Models\Ticket;
use App\Models\TicketCategory;
use App\Models\TicketStatus;
use App\Models\TicketStatusDetail;
use App\Models\TicketUrgensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index(Request $request)
    {
        // Ambil semua employee dengan service point
        $actionNips = Ticket::select('action')->distinct()->pluck('action')->toArray();

        $employees = Employee::where('role', 2)
            ->whereIn('NIP', $actionNips)
            ->get();

        $query = Ticket::orderBy('created_at', 'desc');

        if ($request->filled('NIP')) {
            $query->where('action', $request->NIP);
        }
        if ($request->filled('urgency')) {
            $query->where('urgency_id', $request->urgency);
        }

        $data = $query->paginate(15);

        $urgensi = TicketUrgensi::select('urgency_id', 'urgency')->orderBy('urgency_id', 'asc')->distinct()->get();
        $category = TicketCategory::select('category_id', 'category')->orderBy('category', 'asc')->distinct()->get();

        // Mendapatkan available Technical Support (TS) untuk setiap tiket
        foreach ($data as $ticket) {
            $merchantServicePoint = $ticket->merchant->service_point;

            // Mendapatkan TS yang service point-nya sama dengan merchant yang membuat tiket
            $ticket->availableTS = Employee::select('NIP', 'first_name', 'last_name')
                ->where('service_point', $merchantServicePoint)
                ->distinct()
                ->get();
        }

        return view('ticket.index', compact('data', 'employees', 'urgensi', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status = TicketStatus::select('id', 'status')->distinct()->get();
        $urgensi = TicketUrgensi::select('id', 'urgensi')->distinct()->get();
        $MID = Merchant::select('MID', 'merchant_name')->distinct()->get();
        return view('merchant_ticket.create', compact('status', 'urgensi', 'MID'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Ticket::where('TID', $id)->first();
        return view('ticket/show')->with('data', $data);
    }

    public function view_pdf(string $id)
    {
        $data = Ticket::where('TID', $id)->first();
        return view('ticket/print', compact('data'));
    }

    public function printChart()
    {
        return view('ticket/print_evaluation');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Ticket::where('TID', $id)->first();
        $status = TicketStatus::select('id', 'status')->distinct()->get();
        $urgensi = TicketUrgensi::select('id', 'urgensi')->distinct()->get();
        $category = TicketCategory::select('category_id', 'category')->distinct()->get();
        $MID = Merchant::select('MID', 'merchant_name')->distinct()->get();
        $NIP = employee::select('NIP', 'first_name', 'last_name')->distinct()->get();
        return view('ticket/edit', compact('status', 'urgensi', 'category', 'MID', 'data', 'NIP'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $action = Ticket::select('action')->where('TID', $id)->first();
        $updateTicket = [
            'status_id' => $request->input('status'),
            'category_id' => $request->input('category'),
            'urgency_id' => $request->input('urgensi'),
            'action' => $request->input('NIP'),
            'updated_at' => Carbon::now()->setTimezone('Asia/Jakarta')
        ];

        Ticket::where('TID', $id)->update($updateTicket);

        if ($action->action === null && $request->input('NIP') !== null) {
            $statusUpdate = [
                'TID' => $id,
                'status_id' => '1',
                'created_at' => Carbon::now()->setTimezone('Asia/Jakarta')
            ];
            TicketStatusDetail::create($statusUpdate);
            return redirect('ticket')->with('success', 'Ticket Assigned Successfully');
        }
        return redirect('ticket')->with('success', 'Ticket Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
