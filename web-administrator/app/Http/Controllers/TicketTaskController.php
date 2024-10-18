<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\TicketStatusDetail;
use App\Models\TicketTask;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TicketTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Ticket::where('status_id', '!=', 4)->orderBy('id', 'asc')->paginate(15);
        return view('ticketTask.index', compact('data'));
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
        $data = Ticket::where('id', $id)->first();
        $data1 = TicketTask::where('id', $id)->first();
        return view('ticketTask.show', compact('data', 'data1'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Ticket::where('id', $id)->first();
        $data1 = TicketTask::where('id', $id)->first();
        $status = TicketStatus::select('id', 'status')->where('id', '!=', 4)->distinct()->get();
        return view('ticketTask.edit', compact('data', 'data1', 'status'));
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
