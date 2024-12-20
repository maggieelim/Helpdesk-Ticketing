@extends('layout/main')

@section('dahsboardContent')
<div class="content-wrapper">
  <div class="content-header custom-margin">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Ticket</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active"><a href="{{route('ticket.index')}}">Ticket</a></li>
          <li class="breadcrumb-item active">Detail</li>
        </ol>
      </div>
    </div>
  </div>

  <div class="card custom-margin">
    <div class="card-body">
      <div class="section">
        <h5>Merchant</h5>
        <div class="row">
          <div class="col-6">
            <label class="form-label">Merchant ID</label>
            <p>{{ $data->merchant->MID }}</p>
          </div>
          <div class="col-6">
            <label class="form-label">Name</label>
            <p>{{ $data->merchant->merchant_name }}</p>
          </div>
        </div>
      </div>

      <div class="section">
        <h5>Ticket Detail</h5>
        <label class="form-label">Ticket ID</label>
        <p>{{ $data->TID }}</p>
        <label class="form-label">Ticket Title</label>
        <p>{{ $data->title }}</p>
        <label class="form-label">Ticket Description</label>
        <p>{{ $data->note }}</p>
        <label class="form-label">Comment</label>
        <p>{{ $data->comment }}</p>
      </div>

      <!-- Ticket Info Section -->
      <div class="row">
        <div class="col-6">
          <label class="form-label">Ticket Urgency</label>
          <p>@if($data->urgency_id == null)
            -
            @else
            {{ $data->ticketUrgensi->urgency }}
            @endif
          </p>
        </div>
        <div class="col-6">
          <label class="form-label">Ticket Status</label>
          <p> {{ $data->ticketStatus->status }}</p>
        </div>
        <div class="col-6">
          <label class="form-label">Ticket Category</label>
          <p>@if($data->category_id == null)
            -
            @else
            {{ $data->ticketCategory->category }}
            @endif
          </p>
        </div>
        <div class="col-6">
          <label class="form-label">Ticket Created Date</label>
          <p>{{ $data->created_at }}</p>
        </div>
      </div>
    </div>
  </div>
  <a type="button" href="{{ url('/ticketTask/print/' . rawurlencode(rawurlencode($data->TID))) }}" class="btn custom-card-header print-button custom-margin mb-3" target="_blank"><i class="fas fa-print"></i> Print</a>
</div>
@endsection