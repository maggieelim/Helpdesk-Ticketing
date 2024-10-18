<?php

namespace App\Http\Controllers;

use App\Models\Assets;
use App\Models\employee;
use App\Models\Merchant;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\TicketTask;
use App\Models\TicketUrgensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MerchantTicketController extends Controller
{
    public function index()
    {
        $user = Auth::user()->id;
        $data = Ticket::orderBy('TID', 'asc')->where('MID', $user)->paginate(15);
        $employee = employee::select('NIP', 'first_name', 'last_name')->distinct()->get();
        $MID = Merchant::select('MID', 'merchant_name')->distinct()->get();
        $status = TicketStatus::select('id', 'status')->distinct()->get();
        $urgensi = TicketUrgensi::select('id', 'urgensi')->distinct()->get();
        return view('merchant_ticket.index', compact('data', 'employee', 'MID', 'status', 'urgensi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status = TicketStatus::select('id', 'status')->distinct()->get();
        $urgensi = TicketUrgensi::select('id', 'urgensi')->distinct()->get();
        $MID = Merchant::select('MID', 'merchant_name')->distinct()->get();
        return view('merchant_ticket.create', compact('status', 'urgensi', 'SN', 'MID'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('title', $request->title);
        Session::flash('note', $request->note);
        Session::flash('MID', $request->MID);

        date_default_timezone_set('Asia/Jakarta');
        $tid = 'ID' . date('His');

        $request->validate([
            'title' => 'required',
            'note' => 'required',
        ], [
            'title.required' => 'Title field is required.',
            'note.required' => 'note field is required.',
        ]);
        $data = [
            'TID' => $tid,
            'title' => $request->input('title'),
            'note' => $request->input('note'),
            'MID' => Auth::user()->id,
            'created_at' => Carbon::now('Asia/Jakarta'), // Menetapkan timezone Jakarta
        ];
        Ticket::create($data);
        return redirect('merchantTicket')->with('success', 'Ticket Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Ticket::where('id', $id)->first();
        return view('merchant_ticket/show')->with('data', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Ticket::where('id', $id)->first();
        $status = TicketStatus::select('id', 'status')->distinct()->get();
        $urgensi = TicketUrgensi::select('id', 'urgensi')->distinct()->get();

        $MID = Merchant::select('MID', 'merchant_name')->distinct()->get();
        $NIP = employee::select('NIP', 'fist_name', 'last_name')->distinct()->get();
        return view('merchant_ticket/edit', compact('status', 'urgensi', 'SN', 'MID', 'data', 'NIP'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updateTicket = [
            'status' => '1',
            'updated_at' => Carbon::now()->setTimezone('Asia/Jakarta')
        ];
        Ticket::where('id', $id)->update($updateTicket);

        $request->validate([
            'NIP' => 'required',
        ], [
            'NIP.required' => 'NIP field is required.',
        ]);
        $data = [
            'id' => $id,
            'NIP' => $request->input('NIP'),
        ];
        TicketTask::create($data);
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
