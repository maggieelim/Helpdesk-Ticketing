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
          <li class="breadcrumb-item active">Edit Ticket</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div>

  <div class="card custom-margin">
    <div class="card-header custom-card-header">
      <h1 class="card-title">Edit</h1>
    </div>
    <form class="form-horizontal" method="post" action="{{'/ticket/'.$data->TID}}">
      @csrf
      @method('put')
      <div class="card-body">
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <p>{{ $data->title }}</p>
        </div>
        <div class="mb-3">
          <label for="desc" class="form-label">Description</label>
          <p>{{ $data->note }}</p>
        </div>
        <div class="row">
          <div class="col">
            <div class="mb-3">
              <label for="urgensi" class="form-label">Urgency</label>
              <select name="urgensi" class="form-control" style="width: 100%;">
                <option value="">--Select Urgency Level--</option>
                @foreach($urgensi as $status)
                <option value="{{ $status->id }}" @if($status->id == $data->urgency_id) selected
                  @endif>
                  {{ $status->urgensi }}
                </option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="category" class="form-label">Category</label>
              <span class="text-danger font-weight-bold">*</span>
              <select name="category" class="form-control select2bs4" style="width: 100%;">
                <option value="">--Select Category--</option>
                @foreach($category as $category)
                <option value="{{ $category->category_id }}" @if($category->category_id == $data->category_id) selected
                  @endif>
                  {{$category->category}}
                </option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <input type="text" id="NIP" class="form-control" name="NIP" value="{{ $data->action }}">
            </div>
          </div>
        </div>
        <button type="submit" class="btn custom-card-header">SAVE</button>
      </div>
    </form>
  </div>
</div>
@endsection