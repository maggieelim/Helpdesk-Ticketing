@extends('layout/main')
@section('dahsboardContent')
<div class="content-wrapper">
  <div class="content-header custom-margin">
    <div class="row ">
      <div class="col-sm-6">
        <h1>Ticket</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">Ticket</li>
        </ol>
      </div>
    </div>
  </div>

  <div class="card custom-margin">
    <div class="card-body">
      <div class="container-fluid">
        <div class="row mb-3 align-items-center">
          <div class="col-md-2 mb-3">
            <button type="button" class="btn custom-card-header" data-toggle="modal" data-target="#ticketModal">
              + Create Ticket
            </button>
          </div>

          <div class="col-md-10 card card-default collapsed-card">
            <div class="card-header">
              <h3 class="card-title">Filter</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <form method="GET" action="">
                <div class="col">
                  <div class="form-group">
                    <label>Employee</label>
                    <select name="nip" class="form-control select2bs4" style="width: 100%;">
                      <option selected="selected">All</option>

                    </select>
                  </div>
                </div>
                <div class="col-12">
                  <button type="submit" class="btn custom-card-header">Apply Filter</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="row">
          <table class="table mt-3">
            <thead>
              <tr>
                <th class="text-center">Ticket ID</th>
                <th class="text-center">Title</th>
                <th class="text-center">Priority</th>
                <th class="text-center">Category</th>
                <th class="text-center">Date Request</th>
                <th class="text-center">Status</th>
                <th class="text-center">Assign To</th>
                <th class="text-center">Last Reply</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $item)
              <tr>
                <td class="text-center">{{ $item->TID }}</td>
                <td class="text-center">{{ $item->title }}</td>
                <td class="text-center">
                  @if($item->ticketUrgensi)
                  @php
                  $statusClasses = [
                  1 => 'btn-info',
                  2 => 'btn-warning',
                  3 => 'btn-danger',
                  ];
                  $statusClass = $statusClasses[$item->urgency_id] ?? 'btn-danger';
                  @endphp
                  <button type="button" class="btn {{ $statusClass }} btn-sm" style="pointer-events: none;">
                    {{ $item->ticketUrgensi->urgency }}
                  </button>
                  @else
                  <button type="button" class="btn btn-info btn-sm" style="pointer-events: none;">
                    -
                  </button>
                  @endif
                </td>
                <td class="text-center">
                  @if($item->ticketCategory)
                  {{ $item->ticketCategory->category }}
                  @else
                  -
                  @endif
                </td>
                <td class="createdAt text-center">{{ $item->created_at }}</td>
                <td class="text-center">
                  @if($item->status_id == 1)
                  <button type="button" class="btn btn-warning btn-sm" style="pointer-events: none;">
                    {{ $item->ticketStatus->status }}
                  </button>
                  @elseif($item->status_id == 2)
                  <button type="button" class="btn btn-info btn-sm" style="pointer-events: none;">
                    {{ $item->ticketStatus->status }}
                  </button>
                  @elseif($item->status_id ==3)
                  <button type="button" class="btn btn-success btn-sm" style="pointer-events: none;">
                    {{ $item->ticketStatus->status }}
                  </button>
                  @else
                  <button type="button" class="btn btn-danger btn-sm" style="pointer-events: none;">
                    {{ $item->ticketStatus->status }}
                  </button>
                  @endif
                </td>

                <td class="text-center">
                  @if($item->status_id==4)
                  -
                  @else
                  {{ $item->employee->first_name }}
                  @endif
                </td>

                <td hidden class="updatedAt text-center">{{ $item->updated_at }}</td>
                <td class="test text-center">
                </td>
                <td class="text-center">
                  <a class="btn btn-info" href='{{url('/merchantTicket/'.$item->id)}}'><i class="fas fa-eye"></i></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {{ $data->links() }}
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="ticketModal" tabindex="-1" aria-labelledby="ticketModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ticketModalLabel">Create Ticket</h5>
        </div>
        <div class="modal-body">
          <form id="ticketForm" class="form-horizontal" method="post" action="/merchantTicket">
            @csrf
            <div class="mb-3">
              <label for="title" class="form-label">Title</label>
              <span class="text-danger font-weight-bold">*</span>
              <input type="text" placeholder="Enter title" id="title" class="form-control" name="title" value="{{Session::get('title')}}">
            </div>
            <div class="mb-3">
              <label for="note" class="form-label">Description</label>
              <span class="text-danger font-weight-bold">*</span>
              <textarea id="note" placeholder="Enter description" class="form-control" name="note">{{Session::get('note')}}</textarea>
            </div>
            <div class="d-flex justify-content-between">
              <button type="button" class="btn custom-card-header" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn custom-card-header">Create</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const updateElements = document.querySelectorAll(".updatedAt");
    const testElements = document.querySelectorAll(".test");
    const createdElements = document.querySelectorAll(".createdAt");

    updateElements.forEach((el, index) => {
      const updatedAtText = el.textContent.trim();
      const now = new Date();

      // Menggunakan tanggal dari createdAt jika updatedAt kosong
      let dateToCompare;
      if (updatedAtText === "") {
        dateToCompare = new Date(createdElements[index].textContent.trim());
      } else {
        dateToCompare = new Date(updatedAtText);
      }

      const duration = calculateDuration(dateToCompare, now);
      testElements[index].textContent = duration;
    });
  });

  function calculateDuration(updatedAt, now) {
    const diffMs = now - updatedAt;

    const diffDays = Math.floor(diffMs / (1000 * 60 * 60 * 24));
    const diffHours = Math.floor((diffMs % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const diffMinutes = Math.floor((diffMs % (1000 * 60 * 60)) / (1000 * 60));
    const diffSeconds = Math.floor((diffMs % (1000 * 60)) / 1000);

    if (diffDays > 0) {
      return `${diffDays} days ago`;
    } else if (diffHours > 0) {
      return `${diffHours} hours ago`;
    } else if (diffMinutes > 0) {
      return `${diffMinutes} minutes ago`;
    } else {
      return `${diffSeconds} seconds ago`;
    }
  }
</script>

@endsection