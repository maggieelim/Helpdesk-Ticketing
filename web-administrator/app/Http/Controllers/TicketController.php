<?php

namespace App\Http\Controllers;

use App\Models\Assets;
use App\Models\employee;
use App\Models\Merchant;
use App\Models\Ticket;
use App\Models\TicketCategory;
use App\Models\TicketStatus;
use App\Models\TicketStatusDetail;
use App\Models\TicketTask;
use App\Models\TicketUrgensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Ticket::orderBy('id', 'asc')->paginate(15);
        $employee = employee::select('NIP', 'first_name', 'last_name')->distinct()->get();
        $urgensi = TicketUrgensi::select('id', 'urgensi')->distinct()->get();
        $category = TicketCategory::select('category_id', 'category')->distinct()->get();
        foreach ($data as $ticket) {
            $merchantServicePoint = $ticket->merchant->service_point;

            // Mendapatkan TS yang service point-nya sama dengan merchant yang membuat tiket
            $ticket->availableTS = employee::select('NIP', 'first_name', 'last_name')
                ->where('service_point', $merchantServicePoint)
                ->distinct()
                ->get();
        }
        return view('ticket.index', compact('data', 'employee', 'urgensi', 'category'));
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
        $data = Ticket::where('id', $id)->first();
        return view('ticket/show')->with('data', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Ticket::where('id', $id)->first();
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
        $updateTicket = [
            'status_id' => '1',
            'category_id' => $request->input('category'),
            'urgency_id' => $request->input('urgensi'),
            'action' => $request->input('NIP'),
            'updated_at' => Carbon::now()->setTimezone('Asia/Jakarta')
        ];
        Ticket::where('TID', $id)->update($updateTicket);

        $request->validate([
            'NIP' => 'required',
        ], [
            'NIP.required' => 'NIP field is required.',
        ]);

        $statusUpdate = [
            'TID' => $id,
            'status_id' => '1',
            'created_at' => Carbon::now()->setTimezone('Asia/Jakarta')
        ];
        TicketStatusDetail::create($statusUpdate);


        return redirect('ticket')->with('success', 'Ticket Assigned Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
