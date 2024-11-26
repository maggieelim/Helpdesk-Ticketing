@extends('layout/main')
@section('dahsboardContent')
<div class="content-wrapper">
  <div class="content-header custom-margin">
    <div class="row ">
      <div class="col-sm-6">
        <h1>Ticket</h1>
      </div>
    </div>
  </div>

  <div class="card custom-margin">
    <div class="card-body">
      <div class="col-md-12 card card-default collapsed-card">
        <div class="card-header">
          <h3 class="card-title">Filter</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <form method="GET" action="{{ route('ticket.index') }}"> <!-- Replace with your actual route -->
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
                  <label>Technical Support</label>
                  <select name="NIP" class="form-control select2bs4" style="width: 100%;">
                    <option value="" selected="selected">All</option>
                    @foreach($employees as $employee)
                    <option value="{{ $employee->NIP }}"
                      {{ request('NIP') == $employee->NIP ? 'selected' : '' }}>
                      {{ $employee->first_name }}
                    </option> @endforeach
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
              @php
              $statusClass = 'btn-danger'; // Kelas default
              if ($item->ticketUrgensi) {
              $statusClasses = [
              1 => 'btn-info',
              2 => 'btn-warning',
              3 => 'btn-danger',
              ];
              $statusClass = $statusClasses[$item->urgency_id] ?? $statusClass; // Ambil kelas sesuai urgency_id
              }
              @endphp

              <a class="btn {{ $statusClass }} btn-sm" href="#"
                data-id="{{ $item->TID }}"
                data-status="{{ $item->status_id }}"
                data-urgency-id="{{ $item->urgency_id }}"
                data-action="{{ $item->action }}"
                data-category-id="{{ $item->category_id }}"
                data-NIP="{{ $item->action }}"
                data-toggle="modal"
                data-target="#editModal">
                {{ $item->ticketUrgensi->urgency ?? '-' }}
              </a>
            </td>

            <td class="text-center">
              @if($item->ticketCategory)
              <a class="btn btn-info btn-sm" href="#"
                data-id="{{ $item->TID }}"
                data-status="{{$item->status_id}}"
                data-urgency-id="{{ $item->urgency_id }}"
                data-action="{{ $item->action }}"
                data-category-id="{{ $item->category_id }}"
                data-toggle="modal"
                data-target="#editModal">
                {{ $item->ticketCategory->category }}
              </a>
              @else
              <a class="btn btn-danger btn-sm" href="#"
                data-id="{{ $item->TID }}"
                data-status="{{$item->status_id}}"
                data-action="{{ $item->action }}"
                data-urgency-id="{{ $item->urgency_id }}"
                data-category-id="{{ $item->category_id }}"
                data-toggle="modal"
                data-target="#editModal">
                - </a>
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
              @elseif($item->status_id ==4)
              <button type="button" class="btn btn-danger btn-sm" style="pointer-events: none;">
                {{ $item->ticketStatus->status }}
              </button>
              @elseif($item->status_id ==5)
              <button type="button" class="btn btn-success btn-sm" style="pointer-events: none;">
                {{ $item->ticketStatus->status }}
              </button>
              @else
              <button type="button" class="btn btn-danger btn-sm" style="pointer-events: none;">
                -
              </button>
              @endif
            </td>
            <td class="text-center">
              @if($item->action== null)
              <a class="btn btn-info btn-sm" href="#"
                data-id="{{ $item->TID }}"
                data-action="{{ $item->action }}"
                data-urgency-id="{{ $item->urgency_id }}"
                data-category-id="{{ $item->category_id }}"
                data-toggle="modal"
                data-target="#assignModal">
                Assign To
              </a>
              @else
              {{ $item->employee->first_name}}
              @endif
            </td>
            <td hidden class="updatedAt text-center">{{ $item->updated_at }}</td>
            <td class="test text-center"></td>
            <td class="text-center">
              <a class="btn btn-info mr-2" href='{{url('/ticket/'.$item->TID)}}'><i class="fas fa-eye"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {{ $data->appends(request()->query())->links() }}

    </div>
  </div>
  <div class="modal fade" id="assignModal" tabindex="-1" aria-labelledby="assignModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="assignModalLabel">Assign to technical support</h5>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" method="post" action="{{'/ticket/'.$item->TID}}">
            @csrf
            @method('put')
            <input type="hidden" name="TID" id="TID" value="">
            <input type="hidden" name="category" id="category" value="">
            <input type="hidden" name="urgensi" id="urgensi" value="">
            <input type="hidden" name="status" id="status" value="1">
            <div class="mb-3">
              <label for="NIP" class="form-label">Technical Support</label>
              <span class="text-danger font-weight-bold">*</span>
              <select name="NIP" class="form-control select2bs4" id="NIP" style="width: 100%;">
                <option disabled value="">Select Technical Support</option>
                @foreach($item->availableTS as $NIP)
                <option value="{{ $NIP->NIP }}" {{ old('NIP', Session::get('NIP')) == $NIP->NIP ? 'selected' : '' }}>
                  {{ $NIP->first_name }}
                </option>
                @endforeach
              </select>
            </div>
            <div class="d-flex justify-content-between">
              <button type="button" class="btn custom-card-header" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn custom-card-header">Assign</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Ticket</h5>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" method="post" action="{{ '/ticket/' . $item->TID }}">
            @csrf
            @method('put')
            <div class="mb-3">
              <input type="hidden" name="NIP" id="NIP" value="">
              <input type="hidden" name="TID" id="TID" value="">
              <input type="hidden" name="status" id="status" value="">
              <label for="urgensi" class="form-label">Ticket Urgency</label>
              <span class="text-danger font-weight-bold">*</span>
              <select name="urgensi" class="form-control select2bs4" id="urgensi" style="width: 100%;">
                <option disabled value="">Select Urgency</option>
                @foreach($urgensi as $status)
                <option value="{{ $status->urgency_id }}" {{ $status->urgency_id == $item->urgency_id ? 'selected':'' }}>
                  {{ $status->urgency }}
                </option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="category" class="form-label">Ticket Category</label>
              <span class="text-danger font-weight-bold">*</span>
              <select name="category" class="form-control select2bs4" id="category" style="width: 100%;">
                <option disabled value="">Select Category</option>
                @foreach($category as $cat)
                <option value="{{ $cat->category_id }}" {{ $cat->category_id == $item->category_id ? 'selected' : '' }}>
                  {{ $cat->category }}
                </option>
                @endforeach
              </select>
            </div>
            <input type="hidden" id="NIP" class="form-control" name="NIP" value="">
            <div class="d-flex justify-content-between">
              <button type="button" class="btn custom-card-header" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn custom-card-header">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    updateDurations();
    setInterval(refreshTable, 60000);

    $('#editModal').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget);
      var ticketId = button.data('id');
      var urgencyId = button.data('urgency-id');
      var categoryId = button.data('category-id');
      var action = button.data('action');
      var status = button.data('status');

      var modal = $(this);
      modal.find('form').attr('action', '/ticket/' + ticketId)
      modal.find('#TID').val(ticketId);
      modal.find('#urgensi').val(urgencyId).change();
      modal.find('#category').val(categoryId).change();
      modal.find('#NIP').val(action);
      modal.find('#status').val(status);
    });

    $('#assignModal').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget);
      var ticketId = button.data('id');
      var urgencyId = button.data('urgency-id');
      var categoryId = button.data('category-id');
      var action = button.data('action');

      var modal = $(this);
      modal.find('form').attr('action', '/ticket/' + ticketId)
      modal.find('#TID').val(ticketId);
      modal.find('#urgensi').val(urgencyId).change();
      modal.find('#category').val(categoryId).change();
      modal.find('#NIP').val(action).change();
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
    const NIP = document.querySelector('select[name="NIP"]').value;

    // Buat URL dengan query string
    const url = `{{ route('ticket.index') }}?urgency=${urgency}&NIP=${NIP}`;

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