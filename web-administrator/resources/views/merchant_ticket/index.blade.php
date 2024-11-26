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
              <form method="GET" action="{{ route('merchantTicket.index') }}">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Urgency</label>
                      <select name="urgency" class="form-control select2bs4" style="width: 100%;">
                        <option value="" selected="selected">All</option>
                        @foreach($urgensi as $urgency)
                        <option value="{{ $urgency->urgency_id }}"
                          {{ request('urgency') == $urgency->urgency_id ? 'selected' : '' }}>
                          {{ $urgency->urgency }}
                        </option> @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Status</label>
                      <select name="status" class="form-control select2bs4" style="width: 100%;">
                        <option selected="selected" value="">All</option>
                        @foreach($status as $status)
                        <option value="{{ $status->status_id }}"
                          {{ request('status') == $status->status_id ? 'selected' : '' }}>
                          {{ $status->status }}
                        </option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <button type="submit" class="btn custom-card-header">Apply Filter</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <table class="table mt-3" id="ticket-table">
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
                <button type="button" class="btn btn-secondary btn-sm" style="pointer-events: none;">
                  {{ $item->ticketStatus->status }}
                </button>
                @elseif($item->status_id ==3)
                <button type="button" class="btn btn-info btn-sm" style="pointer-events: none;">
                  {{ $item->ticketStatus->status }}
                </button>
                @elseif($item->status_id ==5)
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
                <div class="d-flex justify-content-center">
                  @if($item->status_id==3)
                  <form method="POST" action="{{ url('/merchantTicket/' . $item->TID) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="5">
                    <button type="submit" class="btn btn-danger btn-sm mr-1">Close</button>
                  </form>
                  @endif
                  <a class="btn btn-info btn-sm mr-1" href='{{url('/merchantTicket/'.$item->TID)}}'><i class="fas fa-eye"></i></a>
                  @if($item->status_id!==5)
                  <a class="btn btn-warning btn-sm" href="#"
                    data-id="{{ $item->TID }}"
                    data-status="{{ $item->status_id }}"
                    data-urgency-id="{{ $item->urgency_id }}"
                    data-action="{{ $item->action }}"
                    data-category-id="{{ $item->category_id }}"
                    data-NIP="{{ $item->action }}"
                    data-comment="{{ $item->comment }}"
                    data-toggle="modal"
                    data-target="#commentModal">
                    <i class="fas fa-comment" style="color: white;"></i> </a>
                  @endif
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $data->appends(request()->query())->links() }}
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

<div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="commentModalLabel">Add Comment</h5>
      </div>
      <div class="modal-body">
        <form method="POST" id="commentForm">
          @csrf
          @method('put')
          <div class="mb-3">
            <input type="hidden" name="NIP" id="NIP" value="">
            <input type="hidden" name="TID" id="TID" value="">
            <input type="hidden" name="status" id="status" value="">
            <input type="hidden" name="category" id="category" value="">
            <input type="hidden" name="urgensi" id="urgensi" value="">
            <label for="comment" class="form-label">Comment</label>
            <span class="text-danger font-weight-bold">*</span>
            <input type="text" placeholder="Enter comment" id="comment" class="form-control" name="comment" value="{{Session::get('comment')}}">
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

<script>
  document.addEventListener('DOMContentLoaded', function() {
    updateDurations();
    setInterval(refreshTable, 60000);

    $('#commentModal').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget);
      var ticketId = button.data('id');
      var urgencyId = button.data('urgency-id');
      var categoryId = button.data('category-id');
      var action = button.data('action');
      var status = button.data('status');
      var comment = button.data('comment');

      var modal = $(this);
      modal.find('form#commentForm').attr('action', '/merchantTicket/comment/' + ticketId)
      modal.find('#TID').val(ticketId);
      modal.find('#urgensi').val(urgencyId).change();
      modal.find('#category').val(categoryId).change();
      modal.find('#NIP').val(action);
      modal.find('#status').val(status);
    });
  });

  function updateDurations() {
    const updateElements = document.querySelectorAll(".updatedAt");
    const testElements = document.querySelectorAll(".test");
    const createdElements = document.querySelectorAll(".createdAt");

    updateElements.forEach((el, index) => {
      const updatedAtText = el.textContent.trim();
      const now = new Date();

      let dateToCompare;
      if (updatedAtText === "") {
        dateToCompare = new Date(createdElements[index].textContent.trim());
      } else {
        dateToCompare = new Date(updatedAtText);
      }

      const duration = calculateDuration(dateToCompare, now);
      testElements[index].textContent = duration;
    });
  }

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

  function refreshTable() {
    const urgency = document.querySelector('select[name="urgency"]').value;
    const status = document.querySelector('select[name="status"]').value;

    const url = `{{ route('merchantTicket.index') }}?urgency=${urgency}&status=${status}`;

    fetch(url)
      .then(response => response.text())
      .then(data => {
        // Update bagian tabel dengan respon dari server
        const parser = new DOMParser();
        const doc = parser.parseFromString(data, "text/html");
        const newTableContent = doc.querySelector("#ticket-table").innerHTML;
        document.querySelector("#ticket-table").innerHTML = newTableContent;
        updateDurations(); // Hitung ulang durasi setelah tabel diperbarui
      })
      .catch(error => console.error('Error fetching data:', error));
  }
</script>

@endsection