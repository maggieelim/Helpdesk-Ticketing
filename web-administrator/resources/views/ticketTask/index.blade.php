@extends('layout/main')
@section('dahsboardContent')
<div class="content-wrapper">
  <div class="content-header custom-margin">
    <div class="row ">
      <div class="col-sm-6">
        <h1>Ticket Task</h1>
      </div>
    </div>
  </div>

  <div class="card custom-margin">
    <div class="card-body">
      <div class="container-fluid">
        <div class="row mb-3 align-items-center">
          <div class=" col-md-12 card card-default collapsed-card">
            <div class="card-header">
              <h3 class="card-title">Filter</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <form method="GET" action="{{ route('ticketTask.index') }}">
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

        @if ($browser->isMobile())
        @foreach($data as $item1)
        <div class="col">
          <div class=" card">
            <div class="card-header">
              <label class="card-title">
                Ticket {{ $item1->TID }}
              </label>
            </div>
            <div class="card-body">
              <div class="row">
                <label class="mr-3">Title</label>
                <p>{{ $item1->title }}</p>
              </div>
              <div class="row">
                <label class="mr-3">Priority</label>
                <p>
                  @php
                  $priorityClasses = [1 => 'btn-info', 2 => 'btn-warning', 3 => 'btn-danger'];
                  $priorityClass = $priorityClasses[$item1->urgency_id] ?? 'btn-danger';
                  @endphp
                  <button type="button" class="btn {{ $priorityClass }} btn-sm" style="pointer-events: none;">
                    {{ $item1->ticketUrgensi->urgency ?? '-' }}
                  </button>
                </p>
              </div>
              <div class="row">
                <label class="mr-3">Category</label>
                <p>{{ $item1->ticketCategory->category ?? '-' }}</p>
              </div>
              <div class="row">
                <label class="mr-3">Date Request</label>
                <p class="createdAt">{{ $item1->created_at }}</p>
              </div>
              <div class="row">
                <label class="mr-3">Status</label>
                <p>
                  @php
                  $statusClasses = [1 => 'btn-warning', 2 => 'btn-secondary', 3 => 'btn-info', 5=> 'btn-success'];
                  $statusClass = $statusClasses[$item1->status_id] ?? 'btn-danger';
                  @endphp
                  <button type="button" class="btn {{ $statusClass }} btn-sm" style="pointer-events: none;">
                    {{ $item1->ticketStatus->status }}
                  </button>
                </p>
              </div>
              <div class="row">
                <label class="mr-3">Last Reply</label>
                <p hidden class="updatedAt">{{ $item1->updated_at }}</p>
                <p class="test"></p>
              </div>
              <div class="row">
                <label class="mr-3">Action</label>
                <div class="d-flex justify-content-around w-100">
                  @if($item1->status_id != 3 && $item1->status_id != 5)
                  <form method="POST" action="{{ url('/ticketTask/' . $item1->TID) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="2">
                    <button type="submit" class="btn btn-info btn-sm mr-1" @disabled($item1->status_id == 2)>In Progress</button>
                  </form>
                  <form method="POST" action="{{ url('/ticketTask/' . $item1->TID) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="3">
                    <button type="submit" class="btn btn-success btn-sm mr-1" @disabled($item1->status_id == 3 || $item1->status_id == 1)>Done</button>
                  </form>
                  @else
                  <button class="btn btn-info btn-sm mr-1" disabled>In Progress</button>
                  <button class="btn btn-success btn-sm mr-1" disabled>Done</button>
                  @endif
                  <a class="btn btn-info btn-sm" href='{{url('/ticketTask/'.$item1->TID)}}'><i class="fas fa-eye"></i></a>
                </div>
                </p>
              </div>
            </div>
          </div>
        </div>
        @endforeach

        @else
        <table class="table mt-3" id="ticket-table">
          <thead>
            <tr>
              <th class="text-center">Ticket ID</th>
              <th class="text-center">Title</th>
              <th class="text-center">Priority</th>
              <th class="text-center">Category</th>
              <th class="text-center">Date Request</th>
              <th class="text-center">Status</th>
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
                $priorityClasses = [1 => 'btn-info', 2 => 'btn-warning', 3 => 'btn-danger'];
                $priorityClass = $priorityClasses[$item->urgency_id] ?? 'btn-danger';
                @endphp
                <button type="button" class="btn {{ $priorityClass }} btn-sm" style="pointer-events: none;">
                  {{ $item->ticketUrgensi->urgency ?? '-' }}
                </button>
              </td>
              <td class="text-center">
                {{ $item->ticketCategory->category ?? '-' }}
              </td>
              <td class="createdAt text-center">{{ $item->created_at }}</td>
              <td class="text-center">
                @php
                $statusClasses = [1 => 'btn-warning', 2 => 'btn-secondary', 3 => 'btn-info', 5=> 'btn-success'];
                $statusClass = $statusClasses[$item->status_id] ?? 'btn-danger';
                @endphp
                <button type="button" class="btn {{ $statusClass }} btn-sm" style="pointer-events: none;">
                  {{ $item->ticketStatus->status }}
                </button>
              </td>
              <td hidden class="updatedAt text-center">{{ $item->updated_at }}</td>
              <td class="test text-center"></td>
              <td class="text-center">
                <div class="d-flex justify-content-center">
                  @if($item->status_id != 3 && $item->status_id !=5)
                  <form method="POST" action="{{ url('/ticketTask/' . $item->TID) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="2">
                    <button type="submit" class="btn btn-info btn-sm mr-1" @disabled($item->status_id == 2)>In Progress</button>
                  </form>
                  <form method="POST" action="{{ url('/ticketTask/' . $item->TID) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="3">
                    <button type="submit" class="btn btn-success btn-sm mr-1" @disabled($item->status_id == 3 || $item->status_id == 1)>Done</button>
                  </form>
                  @else
                  <button class="btn btn-info btn-sm mr-1" disabled>In Progress</button>
                  <button class="btn btn-success btn-sm mr-1" disabled>Done</button>
                  @endif
                  <a class="btn btn-info btn-sm" href='{{url('/ticketTask/'.$item->TID)}}'><i class="fas fa-eye"></i></a>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $data->appends(request()->query())->links() }}
        @endif

      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    updateDurations();
    setInterval(refreshTable, 60000);
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

    const url = `{{ route('ticketTask.index') }}?urgency=${urgency}&status=${status}`;
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