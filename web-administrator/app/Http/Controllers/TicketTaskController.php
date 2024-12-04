<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\TicketStatusDetail;
use App\Models\TicketUrgensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $status = TicketStatus::all();
        $urgensi = TicketUrgensi::select('urgency_id', 'urgency')->orderBy('urgency_id', 'asc')->distinct()->get();
        $query = Ticket::where('status_id', '!=', 4)
            ->where('action', $user->id);

        if ($request->filled('status')) {
            $query->where('status_id', $request->status);
        }
        if ($request->filled('urgency')) {
            $query->where('urgency_id', $request->urgency);
        }
        $data = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('ticketTask.index', compact('data', 'status', 'urgensi'));
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
        $data = Ticket::where('TID', $id)->first();
        return view('ticketTask.show', compact('data'));
    }

    public function view_pdf(string $id)
    {
        $data = Ticket::where('TID', $id)->first();
        return view('ticketTask/print', compact('data'));
    }

    public function printChart()
    {
        return view('ticketTask/print_evaluation');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Ticket::where('TID', $id)->first();
        $status = TicketStatus::select('id', 'status')->where('id', '!=', 4)->distinct()->get();
        return view('ticketTask.edit', compact('data',  'status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = [
            'status_id' => $request->input('status'),
            'updated_at' => Carbon::now()->setTimezone('Asia/Jakarta'),
        ];
        Ticket::where('TID', $id)->update($data);

        $statusUpdate = [
            'TID' => $id,
            'status_id' => $request->input('status'),
            'created_at' => Carbon::now()->setTimezone('Asia/Jakarta')
        ];
        TicketStatusDetail::create($statusUpdate);
        return redirect('ticketTask')->with('success', 'Ticket Task Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
