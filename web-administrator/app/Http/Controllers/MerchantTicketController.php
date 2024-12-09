<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\employee;
use App\Models\Merchant;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\TicketStatusDetail;
use App\Models\TicketUrgensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MerchantTicketController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user()->id;
        $status = TicketStatus::all();
        $query = Ticket::where('MID', $user)->orderBy('created_at', 'desc');
        $urgensi = TicketUrgensi::select('urgency_id', 'urgency')->orderBy('urgency_id', 'asc')->distinct()->get();

        // Filter berdasarkan status jika parameter status ada
        if ($request->filled('status')) {
            $query->where('status_id', $request->status);
        }
        if ($request->filled('urgency')) {
            $query->where('urgency_id', $request->urgency);
        }

        // Mengurutkan dan melakukan paginasi
        $data = $query->paginate(10);
        return view('merchant_ticket.index', compact('data', "status", "urgensi"));
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
        $data = Ticket::where('TID', $id)->first();
        return view('merchant_ticket/show')->with('data', $data);
    }

    public function view_pdf(string $id)
    {
        $data = Ticket::where('TID', $id)->first();
        $address = Address::select('address')->distinct()->first();
        return view('merchant_ticket/print', compact('data', 'address'));
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
            'status_id' => $request->input('status'),
            'updated_at' => Carbon::now()->setTimezone('Asia/Jakarta')
        ];
        Ticket::where('TID', $id)->update($updateTicket);
        $statusUpdate = [
            'TID' => $id,
            'status_id' => '5',
            'created_at' => Carbon::now()->setTimezone('Asia/Jakarta')
        ];
        TicketStatusDetail::create($statusUpdate);
        return redirect('merchantTicket')->with('success', 'Ticket Closed');
    }

    public function comment(Request $request, string $id)
    {
        $status = Ticket::select('status_id')->where('TID', $id)->first();

        if ($status->status_id === 3) {
            $newStatusId = 2;
            $statusUpdate = [
                'TID' => $id,
                'status_id' => '2',
                'created_at' => Carbon::now()->setTimezone('Asia/Jakarta')
            ];
            TicketStatusDetail::create($statusUpdate);
        } else {
            $newStatusId =  $request->input('status');
        }
        $commentUpdate = [
            'comment' => $request->input('comment'),
            'status_id' => $newStatusId,
            'category_id' => $request->input('category'),
            'urgency_id' => $request->input('urgensi'),
            'action' => $request->input('NIP'),
            'updated_at' => Carbon::now()->setTimezone('Asia/Jakarta')
        ];
        Ticket::where('TID', $id)->update($commentUpdate);
        return redirect('merchantTicket')->with('success', 'Comment Created Successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
