@extends('layout/main')
@section('dahsboardContent')
<div class="content-wrapper">
  <div class="content-header custom-margin">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Ticket Task</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{route('ticket.index')}}">Ticket</a></li>
          <li class="breadcrumb-item active">Assign Ticket</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div>

  <div class="card custom-margin">
    <div class="card-header custom-card-header">
      <h1 class="card-title">Assign</h1>
    </div>
    <form class="form-horizontal" method="post" action="{{'/ticketTask/'.$data->id}}">
      @csrf
      @method('put')
      <div class="card-body">
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <p>{{ $data->title }}</p>
        </div>
        <div class="mb-3">
          <label for="desc" class="form-label">Description</label>
          <p>{{ $data->desc }}</p>
        </div>
        <div class="row">
          <div class="col">
            <div class="mb-3">
              <label for="MID" class="form-label">MID</label>
              <p>{{$data->merchant->merchant_name}}</p>
            </div>
          </div>
          <div class="col">
            <div class="mb-3">
              <label for="urgensi" class="form-label">Urgency</label>
              <p>{{$data->ticketUrgensi->urgensi}}</p>
            </div>
            <div class="mb-3">
              <label for="NIP" class="form-label">NIP</label>
              <p>{{$data1->employee->first_name}}</p>
            </div>
            <div class="mb-3">
              <label for="status" class="form-label">Status</label>
              <select name="status" class="form-control" style="width: 100%;">
                <option value="">--Select Urgency Level--</option>
                @foreach($status as $status)
                <option value="{{ $status->id }}" @if($status->id == $data->status) selected
                  @endif>
                  {{ $status->status }}
                </option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <button type="submit" class="btn custom-card-header">SAVE</button>
      </div>
    </form>
  </div>
</div>
@endsection