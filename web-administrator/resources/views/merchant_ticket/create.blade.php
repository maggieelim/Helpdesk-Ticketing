@extends('layout/main')
@section('dahsboardContent')
<div class="content-wrapper">
  <div class="content-header custom-margin">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Ticket</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{route('ticket.index')}}">Ticket</a></li>
          <li class="breadcrumb-item active">Create Ticket</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div>

  <div class="card custom-margin">
    <div class="card-header custom-card-header">
      <h1 class="card-title">Create</h1>
    </div>
    <form class="form-horizontal" method="post" action="/ticket">
      @csrf
      <div class="card-body">
        <div class="row">
          <div class="col">
            <div class="mb-3">
              <label for="title" class="form-label">Title</label>
              <span class="text-danger font-weight-bold">*</span>
              <input type="text" id="title" class="form-control" name="title" value="{{Session::get('title')}}">
            </div>
            <div class="mb-3">
              <label for="desc" class="form-label">Desc</label>
              <span class="text-danger font-weight-bold">*</span>
              <textarea id="desc" class="form-control" name="desc" value="{{Session::get('desc')}}"></textarea>
            </div>
            <div class="mb-3">
              <label for="MID" class="form-label">MID</label>
              <span class="text-danger font-weight-bold">*</span>
              <select name="MID" class="form-control select2bs4" style="width: 100%;">
                <option value="">--Select MID--</option>
                @foreach($MID as $merchant)
                <option value="{{ $merchant->MID }}" {{ old('MID', Session::get('MID')) == $merchant->MID ? 'selected' : '' }}>
                  {{ $merchant->MID }} - {{ $merchant->merchant_name }}
                </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col">
            <div class="mb-3">
              <label for="urgensi" class="form-label">Urgency</label>
              <span class="text-danger font-weight-bold">*</span>
              <select name="urgensi" class="form-control" style="width: 100%;">
                <option value="">--Select Urgency Level--</option>
                @foreach($urgensi as $status)
                <option value="{{ $status->id }}" {{ old('urgensi', Session::get('urgensi')) == $status->id ? 'selected' : '' }}>
                  {{ $status->urgensi }}
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