@extends('layout/main')

@section('dahsboardContent')
<div class="content-wrapper">
  <div class="content-header custom-margin">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Purchase Order</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{route('purchaseOrderList.index')}}">Purchase Order List</a></li>
          <li class="breadcrumb-item active">Edit Purchase Order</li>
        </ol>
      </div>
    </div>
  </div>

  <div class="custom-margin">
    <div class="bs-stepper row" style="justify-content:space-around; width:100%">
      <!-- step -->
      <div class="card" style="width: 18%; height:fit-content">
        <div class="card-body">
          <div class="bs-stepper-header" role="tablist" style="flex-direction: column;">
            <!-- your steps here -->
            <div class="step" data-target="#info-part">
              <button class="step-trigger" role="tab" aria-controls="info-part" id="info-part-trigger">
                <span class="bs-stepper-circle" style="background-color: rgba(12, 40, 131, 0.9);"><i class="fas fa-list-alt"></i></span>
                <span class="bs-stepper-label">Purchase Info</span>
              </button>
            </div>
            <div class="line" style="width: 3px;"></div>
            <div class="step" data-target="#detail-part">
              <button class="step-trigger" role="tab" aria-controls="detail-part" id="detail-part-trigger">
                <span class="bs-stepper-circle" style="background-color: rgba(12, 40, 131, 0.9);"><i class="fas fa-shopping-bag"></i>
                </span>
                <span class="bs-stepper-label">Purchase Detail</span>
              </button>
            </div>
            <div class="line" style="width: 3px;"></div>
            <div class="step" data-target="#review-part">
              <button class="step-trigger" role="tab" aria-controls="review-part" id="review-part-trigger">
                <span class="bs-stepper-circle" style="background-color: rgba(12, 40, 131, 0.9);"><i class="fas fa-file-alt"></i>
                </span>
                <span class="bs-stepper-label">Purchase Review</span>
              </button>
            </div>
            <div class="line" style="width: 3px;"></div>
            <!-- success -->
            <div class="step" data-target="#success-part">
              <button class="step-trigger" role="tab" aria-controls="success-part" id="success-part-trigger">
                <span class="bs-stepper-circle" style="background-color: rgba(12, 40, 131, 0.9);"><i class="fas fa-check-circle"></i>
                </span>
                <span class="bs-stepper-label">Purchase Order Success</span>
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- step body -->
      <div class="card" style="width: 77%; height:fit-content">
        <div class="card-body">
          <div class="bs-stepper-content">
            <form id="purchase-detail-form" action="{{ '/purchaseOrderList/' . rawurlencode(rawurlencode($data->po_number)) }}" method="POST">
              @csrf
              @method('put')
              <!-- purchase info -->
              <div id="info-part" class="content" role="tabpanel" aria-labelledby="info-part-trigger">
                <div class="mb-3">
                  <label for="supplier" class="form-label">Supplier</label>
                  <span class="text-danger font-weight-bold">*</span>
                  <select disabled id="supplier" class="form-control select" name="supplier_id" required>
                    <option value="">-- Select supplier --</option>
                    @foreach($supplier as $supplier)
                    <option value="{{ $supplier->id }}" @if($data->supplier_id == $supplier->id) selected @endif
                      data-address="{{ $supplier->address }}"
                      data-phone="{{ $supplier->phoneNum }}"
                      data-email="{{ $supplier->email }}"
                      data-pic-phone="{{ $supplier->PIC_phone }}"
                      data-pic-name="{{ $supplier->PIC_name }}"
                      data-alias="{{ $supplier->alias }}">
                      {{ $supplier->PIC_name }} - {{ $supplier->address }}
                    </option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">Please select a supplier.</div>
                </div>

                <div id="supplier-details" @if($data->supplier_id) style="display: block;" @else style="display: none;" @endif>
                  <div class="m-3">
                    <h5 class="my-0" style="font-weight: bold;">Supplier Address:</h5>
                    <p class="my-0" id="supplier-address">{{ $data->supplier_id ? $data->supplier->address : '' }}</p>
                    <p class="my-0" id="supplier-phone">{{ $data->supplier_id ? $data->supplier->phoneNum : '' }}</p>
                    <p class="my-0" id="supplier-email">{{ $data->supplier_id ? $data->supplier->email : '' }}</p>
                    <p class="my-0" id="PIC-name">{{ $data->supplier_id ? $data->supplier->PIC_name : '' }}</p>
                    <p class="my-0" id="PIC-phone">{{ $data->supplier_id ? $data->supplier->PIC_phone : '' }}</p>
                  </div>
                </div>

                <div class="mb-3">
                  <label for="po-number" class="form-label">PO Number:</label>
                  <span class="text-danger font-weight-bold">*</span>
                  <input type="text" id="po-number" class="form-control" readonly name="po_number" placeholder="Purchase Order Number" value="{{ $data->po_number }}">
                  <div class="invalid-feedback">PO Number is already exist.</div>
                </div>

                <div class="mb-3">
                  <label for="po-date" class="form-label">PO Date</label>
                  <span class="text-danger font-weight-bold">*</span>
                  <input type="date" id="po-date" class="form-control" readonly name="po_date" value="{{ $data->po_date }}">
                  <div class="invalid-feedback">Please select a date.</div>
                </div>

                <div class="mt-3 d-flex justify-content-end">
                  <button type="submit" class="btn custom-card-header" onclick="navigateToDetails(event)">Next</button>
                </div>
              </div>


              <!-- purchase detail -->
              <div id="detail-part" class="content" role="tabpanel" aria-labelledby="detail-part-trigger">
                <div class="form-group">
                  <label>Purchase Detail</label>
                  <div class="row" style="justify-content:flex-end;">
                    <button type="button" class="btn custom-card-header" data-toggle="modal" data-target="#modal-lg">
                      + Add Item
                    </button>
                  </div>

                  <table class="table table-hover mt-3">
                    <thead>
                      <tr>
                        <th class="text-center">Item Code</th>
                        <th class="text-center">Item Name</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Item Price</th>
                        <th class="text-right">Amount</th>
                        <th class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody id="purchase-details-body">
                      @foreach($poItem as $item)
                      <tr data-id="{{ $item->item_id }}">
                        <td class="text-center item-code">{{ $item->item->item_code }}</td>
                        <td class="text-center">{{ $item->item->item_name }}</td>
                        <td class="text-center item-quantity-test">
                          <input type="number" oninput="validity.valid||(value='');" class="form-control item-quantity" name="details[{{ $item->id }}][qty]" value="{{ $item->qty }}" min="0" required>
                        </td>
                        <td class="text-center">
                          <input type="number" oninput="validity.valid||(value='1');" class="form-control item-price" name="details[{{ $item->id }}][item_price]" value="{{ $item->item_price }}" min="1" required>
                        </td>
                        <td class="item-subtotal text-right">Rp {{ number_format($item->subtotal) }}</td>
                        <td class="text-center">
                          <button type="button" class="btn btn-danger delete-item-btn"><i class="fas fa-times-circle"></i></button>
                        </td>
                        <input type="hidden" name="details[{{ $item->id }}][item_id]" value="{{ $item->item_id }}">
                        <input type="hidden" name="details[{{ $item->id }}][subtotal]" class="item-subtotal-input" value="{{ $item->subtotal }}">
                      </tr>
                      @endforeach
                    </tbody>
                    <tfoot style="border: none;">
                      <tr>
                        <th style="border: none;" colspan="4" class="text-right">Subtotal :</th>
                        <th style="width:20%; border: none" id="total-amount" class="text-right">{{ 'Rp ' . number_format($data->total, 0, '.', '.') }}</th>
                      </tr>
                      <tr>
                        <th style="border: none;" colspan="4" class="text-right">PPN 11% :</th>
                        <th style="width:20%; border: none" id="ppn" class="text-right">{{ 'Rp ' . number_format($data->ppn, 0, '.', '.') }}</th>
                        <th style="border: none">
                          <div class="switch">
                            <input type="hidden" value="0">
                            <input id="tax" type="checkbox" class="form-check-input setting-input" value="1" @if($data->ppn != 0) checked @endif>
                            <span class="slider round"></span>
                          </div>
                        </th>
                      </tr>

                      <tr>
                        <th style="border: none;" colspan="4" class="text-right">Total Order :</th>
                        <th style="width:20%; border: none" id="total-ppn" class="text-right">{{ 'Rp ' . number_format($data->totalPPN, 0, '.', '.') }}</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>

                <div id="item-templates" style="display: none;">
                  <!-- Item template for JavaScript injection -->
                  <template id="item-template">
                    <tr>
                      <td class="text-center">
                        <input type="hidden" name="details[][item_id]" value="ITEM_ID">
                        ITEM_CODE
                      </td>
                      <td class="text-center">ITEM_NAME</td>
                      <td class="text-center">
                        <input type="number" name="details[][qty]" class="form-control" value="1" required>
                      </td>
                      <td class="text-center">ITEM_PRICE</td>
                      <td class="text-center">SUBTOTAL</td>
                      <td class="text-center">
                        <button type="button" class="btn btn-danger remove-item-btn">Remove</button>
                      </td>
                    </tr>
                  </template>
                </div>

                <input type="hidden" name="total" id="total-hidden">
                <input type="hidden" name="ppn" id="ppn-hidden">
                <input type="hidden" name="totalPPN" id="totalPPN-hidden">

                <div class="mt-3 d-flex justify-content-end">
                  <button type="button" class="btn custom-card-header mx-3" onclick="stepper.previous()">Back</button>
                  <button type="submit" class="btn custom-card-header" onclick="navigateToReview(event)">Next</button>
                </div>
              </div>

              <!-- purchase review -->
              <div id="review-part" class="content" role="tabpanel" aria-labelledby="review-part-trigger">
                <div class="my-3">
                  <img src="{{ asset('images/Indopay.png') }}" style="max-width: 20%; height: auto;">
                </div>

                <div class="row mb-3 d-flex justify-content-between">
                  <p style="font-weight: bold;" id="poNumberDisplay"></p>
                  <p style="font-weight: bold;" id="poDateDisplay"></p>
                </div>
                <div class="mb-3">
                  <h5 class="my-0" style="font-weight: bold;">Supplier Detail:</h5>
                  <p class="my-0" id="supplier-address-display"></p>
                  <p class="my-0" id="supplier-phone-display"></p>
                  <p class="my-0" id="supplier-email-display"></p>
                  <p class="my-0" id="PIC-name-display"></p>
                  <p class="my-0" id="PIC-phone-display"></p>
                </div>

                <div class="mb-3">
                  <h5 style="font-weight: bold;">Purchased Items:</h5>
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th class="text-center">Item Code</th>
                        <th class="text-center">Item Name</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Price</th>
                        <th class="text-right">Subtotal</th>
                      </tr>
                    </thead>
                    <tbody id="purchase-details-body">
                      <!-- Purchased items will be dynamically inserted here -->
                    </tbody>
                    <tfoot>
                      <tr>
                        <th colspan="4" class="text-right">Subtotal :</th>
                        <th id="totalAmount" class="text-right"></th>
                      </tr>
                      <tr>
                        <th colspan="4" class="text-right">PPN 11% :</th>
                        <th id="ppn-review" class="text-right"></th>
                      </tr>
                      <tr>
                        <th colspan="4" class="text-right">Total Order :</th>
                        <th id="totalReview" class="text-right"></th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <div class="mt-3 d-flex justify-content-end">
                  <button type="button" class="btn custom-card-header mx-3" onclick="stepper.previous()">Back</button>
                  <button type="submit" class="btn custom-card-header">Submit</button>
                </div>
              </div>

              <!-- success -->
              <div id="success-part" class="content" role="tabpanel" aria-labelledby="success-part-trigger">
                <div class="text-center my-4 justify-content-center">
                  <img src="{{ asset('images/success.png') }}" style="max-width: 20%; height: auto;">
                </div>
                <div class="text-center my-4 justify-content-center">
                  <h5 class="font-weight-bold" id="successPO"></h5>
                </div>
                <div class="d-flex justify-content-center">
                  <a href="{{route('purchaseOrderList.index')}}" type="button" class="btn custom-card-header mx-2">Back To PO List</a>
                  <a id="go-to-po" type="button" class="btn custom-card-header mx-2">Go To PO</a>
                  <a id="print-po-link" target="_blank" type="button" class="btn custom-card-header mx-2">Print</a>
                </div>
              </div>
            </form>

            <div class="modal fade" id="modal-lg">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header mx-3">
                    <h4 class="modal-title" style="font-weight: bold;">Add Items</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body  mx-3">
                    <form action="" method="POST">
                      <div class="row">
                        <div class="input-group mb-3">
                          <input type="text" class="form-control" placeholder="Search Products" id="search">
                        </div>
                      </div>
                    </form>

                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th class="text-center">Item Code</th>
                          <th class="text-center">Item Name</th>
                          <th class="text-center">Price</th>
                          <th class="text-center">Action</th>
                        </tr>
                      </thead>
                      <tbody class="alldata">
                        @foreach($items as $item)
                        <tr>
                          <td class="text-center">{{ $item->item_code }}</td>
                          <td class="text-center">{{ $item->item_name }}</td>
                          <td class="text-center">{{ 'Rp ' . number_format($item->item_price, 0, '.', '.') }}</td>
                          <td class="text-center"> <button type="button" class="btn custom-card-header add-item-btn" data-id="{{ $item->id }}" data-code="{{ $item->item_code }}" data-name="{{ $item->item_name }}" data-price="{{ $item->item_price }}">
                              + Add
                            </button></td>
                        </tr>
                        @endforeach
                      </tbody>
                      <tbody id="Content" class="searchdata"></tbody>
                    </table>
                    <div id="pagination-links">
                      {{ $items->links() }}
                    </div>
                    <div id="po-numbers-data" data-po-numbers="{{ json_encode($poNum) }}"></div>
                  </div>
                  <div class="modal-footer justify-content-flex-end">
                    <button type="button" class="btn custom-card-header" data-dismiss="modal" aria-label="Close">Next</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<style>
  .form-check-input {
    opacity: 0;
    margin-left: 1px;
    z-index: 2;
    width: 40px;
    background-color: pink;
    height: 20px;
    cursor: pointer;
  }

  .switch {
    position: relative;
    display: inline-block;
    width: 40px;
    height: 24px;
  }

  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: .4s;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 16px;
    width: 16px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    transition: .4s;
  }

  input:checked+.slider {
    background-color: #2196F3;
  }

  input:checked+.slider:before {
    transform: translateX(16px);
  }

  .slider.round {
    border-radius: 34px;
  }

  .slider.round:before {
    border-radius: 50%;
  }
</style>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'));

    document.querySelectorAll('.add-item-btn').forEach(button => {
      button.addEventListener('click', addItem);
    });

    var deleteButtons = document.querySelectorAll('.delete-item-btn');
    deleteButtons.forEach(function(button) {
      button.addEventListener('click', function() {
        deleteRow(this);
      });
    });

    // Fungsi untuk menghapus baris
    function deleteRow(button) {
      var row = button.closest('tr');
      row.remove();
    }

    //add item
    function addItem() {
      const itemData = {
        id: this.dataset.id,
        code: this.dataset.code,
        name: this.dataset.name,
        price: parseFloat(this.dataset.price)
      };

      const existingRow = document.querySelector(`#purchase-details-body tr[data-id="${itemData.id}"]`);
      if (existingRow) {
        const quantityInput = existingRow.querySelector('.item-quantity');
        const priceInput = existingRow.querySelector('.item-price');
        let quantity = parseInt(quantityInput.value);
        quantity += 1;
        quantityInput.value = quantity;
        updateSubtotal(existingRow, quantity, parseFloat(priceInput.value));
      } else {
        const newRow = createNewRow(itemData);
        document.getElementById('purchase-details-body').appendChild(newRow);
      }
      updateTotal();
    }

    //create row item
    function createNewRow(itemData) {
      const newRow = document.createElement('tr');
      newRow.setAttribute('data-id', itemData.id);
      newRow.innerHTML = `
        <td class="text-center item-code">${itemData.code}</td>
        <td class="text-center">${itemData.name}</td>
        <td class="text-center item-quantity-test">
          <input type="number" oninput="validity.valid||(value='');" class="form-control item-quantity" name="details[${itemData.id}][qty]" value="1" min="0" required>
        </td>
        <td class="text-center">
        <input type="number" oninput="validity.valid||(value='1');" class="form-control item-price" name="details[${itemData.id}][item_price]" value="${itemData.price}" min="1" required>
        </td>
        <td class="item-subtotal text-right">Rp ${numberFormat(itemData.price)}</td>
        <td class="text-center">
          <button type="button" class="btn btn-danger delete-item-btn"><i class="fas fa-times-circle"></i></button>
        </td>
        <input type="hidden" name="details[${itemData.id}][item_id]" value="${itemData.id}">
        <input type="hidden" name="details[${itemData.id}][subtotal]" class="item-subtotal-input" value="${itemData.price}">
      `;

      newRow.querySelector('.delete-item-btn').addEventListener('click', function() {
        deleteRow(this);
      });

      newRow.querySelector('.item-quantity').addEventListener('input', function() {
        updateSubtotal(newRow, parseInt(newRow.querySelector('.item-quantity').value), parseFloat(newRow.querySelector('.item-price').value));
        updateTotal();
      });
      newRow.querySelector('.item-price').addEventListener('input', function() {
        updateSubtotal(newRow, parseInt(newRow.querySelector('.item-quantity').value), parseFloat(newRow.querySelector('.item-price').value));
        updateTotal();
      });
      return newRow;
    }

    function addNewItem(itemData) {
      const newRow = createNewRow(itemData);
      document.getElementById('purchase-details-body').appendChild(newRow);
      updateSubtotal();
    }
    //update subtotal
    function updateSubtotal(row, quantity, price) {
      const subtotal = quantity * price;
      row.querySelector('.item-subtotal').textContent = `Rp ${numberFormat(subtotal)}`;
      row.querySelector('.item-subtotal-input').value = subtotal;
    }

    //delete item
    function deleteRow(button) {
      const row = button.closest('tr');
      row.remove();
      updateTotal();
    }

    document.getElementById('tax').addEventListener('change', function() {
      updateTotal();
    });
    //update total
    function updateTotal() {
      let total = 0;
      let ppn = 0;

      document.querySelectorAll('#purchase-details-body tr').forEach(row => {
        const subtotal = parseFloat(row.querySelector('.item-subtotal-input').value);
        total += subtotal;
      });
      let totalPPN = total;
      const applyTax = document.getElementById('tax').checked;
      if (applyTax) {
        ppn = total * 0.11;
        totalPPN = ppn + total;
      }

      document.getElementById('ppn').textContent = `Rp ${numberFormat(ppn)}`;
      document.getElementById('total-ppn').textContent = `Rp ${numberFormat(totalPPN)}`;
      document.getElementById('total-amount').textContent = `Rp ${numberFormat(total)}`;
      document.getElementById('total-hidden').value = total;
      document.getElementById('ppn-hidden').value = ppn;
      document.getElementById('totalPPN-hidden').value = totalPPN;
    }

    //format rupiah
    function numberFormat(x) {
      return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // Function to display purchased items on the review page
    function displayPurchasedItems() {
      const purchaseDetailsBody = document.getElementById('purchase-details-body'); // Original purchase details body
      const reviewPurchaseDetailsBody = document.getElementById('review-part').querySelector('#purchase-details-body'); // Review purchase details body

      // Clear previous items in review section
      reviewPurchaseDetailsBody.innerHTML = '';

      // Iterate through each purchased item in the original section
      purchaseDetailsBody.querySelectorAll('tr').forEach(item => {
        const clonedRow = item.cloneNode(true);
        clonedRow.querySelector('.delete-item-btn').remove();
        clonedRow.querySelector('.item-quantity').setAttribute('readonly', 'readonly');
        clonedRow.querySelector('.item-price').setAttribute('readonly', 'readonly');
        clonedRow.querySelector('.item-price').style.width = '100px';
        clonedRow.querySelector('.item-quantity').style.width = '100px';

        // Update quantity and price to input fields
        reviewPurchaseDetailsBody.appendChild(clonedRow);
      });
    }

    // Update the navigation function to properly call displayPurchasedItems
    window.navigateToReview = function(event) {
      event.preventDefault();
      const supplierSelect = document.getElementById('supplier');
      const selectedOption = supplierSelect.options[supplierSelect.selectedIndex];
      const details = {
        address: selectedOption.dataset.address,
        phone: selectedOption.dataset.phone,
        email: selectedOption.dataset.email,
        picName: selectedOption.dataset.picName,
        picPhone: selectedOption.dataset.picPhone,
        picAlias: selectedOption.dataset.alias
      };

      // Get PO Number and PO Date values
      const poNumber = document.getElementById('po-number').value;
      const poDate = document.getElementById('po-date').value;
      const totalAmount = document.getElementById('total-amount').textContent;
      const ppn = document.getElementById('ppn').textContent;
      const Totalppn = document.getElementById('total-ppn').textContent;

      // Update display fields in review-part
      document.getElementById('poNumberDisplay').textContent = "PO Number: " + poNumber;
      document.getElementById('poDateDisplay').textContent = "PO Date: " + poDate;
      document.getElementById('supplier-address-display').textContent = "Address: " + details.address;
      document.getElementById('supplier-phone-display').textContent = "Phone: " + details.phone;
      document.getElementById('supplier-email-display').textContent = "Email: " + details.email;
      document.getElementById('PIC-name-display').textContent = "PIC Name: " + details.picName;
      document.getElementById('PIC-phone-display').textContent = "PIC Phone: " + details.picPhone;
      document.getElementById('totalAmount').textContent = totalAmount;
      document.getElementById('ppn-review').textContent = ppn;
      document.getElementById('totalReview').textContent = Totalppn;

      // Display purchased items
      displayPurchasedItems();

      // Navigate to the review step
      window.stepper.next();
    }

    //validasi
    window.navigateToDetails = function(event) {
      event.preventDefault();
      const supplier = document.getElementById('supplier');
      const poDate = document.getElementById('po-date');
      const poNumberElement = document.getElementById('po-number');
      const poNumber = poNumberElement.value;
      const existingPONumbersElement = document.getElementById('po-numbers-data');
      const existingPONumbers = JSON.parse(existingPONumbersElement.getAttribute('data-po-numbers'));

      let isValid = true;

      // Validasi supplier
      if (supplier.value === "--select supplier--") {
        supplier.classList.add('is-invalid');
        poDate.classList.add('is-invalid');
        isValid = false;
      } else {
        supplier.classList.remove('is-invalid');
        poDate.classList.remove('is-invalid');
      }

      // Jika validasi berhasil, lanjutkan ke langkah berikutnya
      if (isValid) {
        window.stepper.next();
      }
    };

    //search item
    $('#search').on('keyup', function() {
      $value = $(this).val();
      if ($value) {
        $('.alldata').hide();
        $('.searchdata').show();
      } else {
        $('.alldata').show();
        $('.searchdata').hide();
      }
      $.ajax({
        type: 'get',
        url: `{{ route('search.item') }}`, // Correctly include the URL here
        data: {
          'search': $value
        },

        success: function(data) {
          console.log(data);
          let content = '';
          data.forEach(item => {
            content += `<tr>
                    <td class="text-center">${item.item_code}</td>
                    <td class="text-center">${item.item_name}</td>
                    <td class="text-center">Rp ${new Intl.NumberFormat().format(item.item_price)}</td>
                    <td class="text-center">
                        <button type="button" class="btn custom-card-header add-item-btn" 
                                data-id="${item.id}" data-code="${item.item_code}" 
                                data-name="${item.item_name}" data-price="${item.item_price}">
                            + Add
                        </button>
                    </td>
                </tr>`;
          });
          $('#Content').html(content);
          $('.add-item-btn').off('click').on('click', addItem);
        }
      })
    })

    //paginate item modal
    $(document).on('click', '#pagination-links a', function(event) {
      event.preventDefault();

      var url = $(this).attr('href');
      fetchData(url);
    });

    //fetch paginate data
    function fetchData(url) {
      $.ajax({
        url: url,
        method: 'GET',
        success: function(data) {
          $('.alldata').html($(data).find('.alldata').html());
          $('#pagination-links').html($(data).find('#pagination-links').html());
        },
        error: function(xhr) {
          console.log("ajax error")
        }
      });
      $(document).on('click', '.add-item-btn', function() {
        addItem.call(this);
      });
    }

    $('#purchase-detail-form').on('submit', function(event) {
      event.preventDefault();
      const poNumber = document.getElementById('po-number').value;
      document.getElementById('successPO').textContent = "Purchase Order " + poNumber + " Edited Successfully";
      document.getElementById('print-po-link').href = "/purchaseOrder/print/" + encodeURIComponent(encodeURIComponent(poNumber));
      document.getElementById('go-to-po').href = "/purchaseOrderList/" + encodeURIComponent(encodeURIComponent(poNumber));

      $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: $(this).serialize(),
        success: function(response) {
          console.log(response);
          stepper.next();
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText);
          alert('Form submission failed!');
        }
      });
    });
  });
</script>

@endsection