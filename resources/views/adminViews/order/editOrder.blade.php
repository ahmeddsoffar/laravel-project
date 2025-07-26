<!doctype html>
<html lang="en" data-bs-theme="light">


<!-- Mirrored from codervent.com/matoxi/demo/vertical-menu/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 08 Sep 2024 08:59:03 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ecomus | Order Details</title>
    <!--favicon-->
    <link rel="icon" href="{{ asset('adminFront/assets/images/favicon-32x32.png') }}" type="image/png">

    <!--plugins-->
    <link href="{{ asset('adminFront/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminFront/assets/plugins/metismenu/metisMenu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminFront/assets/plugins/metismenu/mm-vertical.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminFront/assets/plugins/simplebar/css/simplebar.css') }}">
    <!--bootstrap css-->
    <link href="{{ asset('adminFront/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
    <!--main css-->
    <link href="{{ asset('adminFront/assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="{{ asset('adminFront/sass/main.css') }}" rel="stylesheet">
    <link href="{{ asset('adminFront/sass/dark-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('adminFront/sass/semi-dark.css') }}" rel="stylesheet">
    <link href="{{ asset('adminFront/sass/bordered-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('adminFront/sass/responsive.css') }}" rel="stylesheet">

</head>

<body style="display: flex; flex-direction: column; min-height: 100vh;">

    <!--start header-->
    @include('adminViews.layouts.header')
    <!--end top header-->


    <!--start sidebar-->
    @include('adminViews.layouts.sidebar')
    <!--end sidebar-->


    <!--start main wrapper-->
    <main class="main-wrapper" style="flex: 1;">
        <div class="main-content" data-item-count="{{ count($order->items) }}">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Order Management</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('adminView') }}"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('order.list') }}">Orders</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Order #{{ $order->id }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <form action="{{ route('order.destroy', $order->id) }}" method="POST" class="d-inline" id="deleteOrderForm">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger" onclick="confirmDelete()">
                            <i class="material-icons-outlined">delete</i> Delete Order
                        </button>
                    </form>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header px-4 py-3 d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Edit Order #{{ $order->id }}</h5>
                            <span class="badge bg-{{ $order->status === 'pending' ? 'warning' : ($order->status === 'completed' ? 'success' : 'danger') }} fs-6">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                        <div class="card-body p-4">
                            @if(session('success'))
                            <div class="alert alert-success border-0 bg-light-success alert-dismissible fade show">
                                <div class="text-success">{{ session('success') }}</div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif

                            @if(session('error'))
                            <div class="alert alert-danger border-0 bg-light-danger alert-dismissible fade show">
                                <div class="text-danger">{{ session('error') }}</div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif

                            <form method="POST" action="{{ route('order.update', $order->id) }}" id="orderForm">
                                @csrf
                                @method('PUT')

                                <!-- Order Info Section -->
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="user_id" class="form-label">Customer</label>
                                        <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                                            <option value="">Choose a customer...</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}" {{ $order->user_id == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }} ({{ $user->email }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('user_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="status" class="form-label">Order Status</label>
                                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                            <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Order Items Section -->
                                <div class="card mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0">Order Items</h6>
                                        <button type="button" class="btn btn-primary btn-sm" id="addItemBtn">
                                            Add Item
                                        </button>
                                    </div>
                                    <div class="card-body" id="orderItemsContainer">
                                        @foreach($order->items as $index => $item)
                                        <div class="order-item mb-3">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <label class="form-label">Product</label>
                                                    <select class="form-select product-select" name="items[{{ $index }}][product_id]" required>
                                                        <option value="">Select a product...</option>
                                                        @foreach($products as $product)
                                                            <option value="{{ $product->id }}"
                                                                data-price="{{ $product->price }}"
                                                                data-quantity="{{ $product->quantity }}"
                                                                {{ $item->product_id == $product->id ? 'selected' : '' }}>
                                                                {{ $product->name }} - ${{ number_format($product->price, 2) }}
                                                                ({{ $product->quantity }} available)
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Quantity</label>
                                                    <input type="number" class="form-control quantity-input"
                                                        name="items[{{ $index }}][quantity]"
                                                        min="1"
                                                        value="{{ $item->quantity }}"
                                                        required>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Subtotal</label>
                                                    <input type="text" class="form-control item-subtotal" readonly>
                                                </div>
                                                <div class="col-md-1 d-flex align-items-end">
                                                    <button type="button" class="btn btn-danger btn-sm remove-item" {{ $index === 0 ? 'style=display:none' : '' }}>
                                                        <i class="material-icons-outlined">delete</i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Order Summary -->
                                <div class="row justify-content-end">
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h6 class="card-title">Order Summary</h6>
                                                <div class="d-flex justify-content-between mb-2">
                                                    <span>Total Items:</span>
                                                    <span id="totalItems">{{ $order->items->sum('quantity') }}</span>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <strong>Total Amount:</strong>
                                                    <strong id="totalAmount">${{ number_format($order->total_price, 2) }}</strong>
                                                </div>
                                                <input type="hidden" name="total_price" id="totalPriceInput" value="{{ $order->total_price }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary px-4">Update Order</button>
                                        <a href="{{ route('order.list') }}" class="btn btn-outline-secondary px-4">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--end main wrapper-->

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this order? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" onclick="document.getElementById('deleteOrderForm').submit()">Delete Order</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    @endpush


    <!--start overlay-->
    <div class="overlay btn-toggle"></div>
    <!--end overlay-->

    <!--start footer-->
    @include('adminViews.layouts.footer')
    <!--top footer-->

    <!--start cart-->
    @include('adminViews.layouts.cart')
    <!--end cart-->

    <!--start switcher-->
    @include('adminViews/layouts/switcher')
    <!--end switcher-->

    <!--bootstrap js-->
    <script src="{{ asset('adminFront/assets/js/bootstrap.bundle.min.js') }}"></script>

    <!--plugins-->
    <script src="{{ asset('adminFront/assets/js/jquery.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('adminFront/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('adminFront/assets/plugins/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('adminFront/assets/plugins/apexchart/apexcharts.min.js') }}"></script>
    <script src="{{ asset('adminFront/assets/js/index.js') }}"></script>
    <script src="{{ asset('adminFront/assets/plugins/peity/jquery.peity.min.js') }}"></script>
    <script>
        $(".data-attributes span").peity("donut")
    </script>
    <script src="{{ asset('adminFront/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('adminFront/assets/js/main.js') }}"></script>

    <script>
        // Safely get the initial item count from HTML
        const initialItemCount = parseInt(document.querySelector('.main-content').dataset.itemCount) || 0;

        document.addEventListener('DOMContentLoaded', function() {
            let itemCount = initialItemCount;

            // Initial calculation
            calculateTotals();

            // Add new item
            document.getElementById('addItemBtn').addEventListener('click', function(e) {
                e.preventDefault();

                const template = document.querySelector('.order-item');
                const newItem = template.cloneNode(true);

                // Update form elements
                const selects = newItem.querySelectorAll('select');
                const inputs = newItem.querySelectorAll('input');

                selects.forEach(select => {
                    select.name = select.name.replace(/\[\d+\]/, `[${itemCount}]`);
                    select.selectedIndex = 0;
                });

                inputs.forEach(input => {
                    input.name = input.name.replace(/\[\d+\]/, `[${itemCount}]`);
                    if (!input.readOnly) {
                        input.value = '1';
                    } else {
                        input.value = '';
                    }
                });

                // Show remove button
                const removeBtn = newItem.querySelector('.remove-item');
                if (removeBtn) {
                    removeBtn.style.display = 'block';
                }

                document.getElementById('orderItemsContainer').appendChild(newItem);
                itemCount++;

                attachEventListeners(newItem);
                calculateTotals();
            });

            // Remove item
            document.addEventListener('click', function(e) {
                const removeBtn = e.target.closest('.remove-item');
                if (removeBtn) {
                    const items = document.getElementsByClassName('order-item');
                    if (items.length > 1) {
                        removeBtn.closest('.order-item').remove();
                        calculateTotals();
                    }
                }
            });

            // Attach event listeners
            function attachEventListeners(item) {
                const productSelect = item.querySelector('.product-select');
                const quantityInput = item.querySelector('.quantity-input');

                if (productSelect && quantityInput) {
                    productSelect.addEventListener('change', function() {
                        const selectedOption = this.options[this.selectedIndex];
                        const maxQuantity = parseInt(selectedOption.dataset.quantity) || 0;

                        quantityInput.max = maxQuantity;
                        quantityInput.value = Math.min(parseInt(quantityInput.value) || 1, maxQuantity);

                        if (maxQuantity === 0) {
                            quantityInput.disabled = true;
                            quantityInput.value = 0;
                        } else {
                            quantityInput.disabled = false;
                            if (!quantityInput.value) quantityInput.value = 1;
                        }

                        calculateTotals();
                    });

                    quantityInput.addEventListener('input', function() {
                        const selectedOption = productSelect.options[productSelect.selectedIndex];
                        const maxQuantity = parseInt(selectedOption.dataset.quantity) || 0;

                        let value = parseInt(this.value) || 0;
                        if (value < 0) value = 0;
                        if (value > maxQuantity) value = maxQuantity;
                        this.value = value;

                        calculateTotals();
                    });
                }
            }

            // Initial event listeners
            document.querySelectorAll('.order-item').forEach(item => {
                attachEventListeners(item);
            });

            // Calculate totals
            function calculateTotals() {
                let totalAmount = 0;
                let totalItems = 0;

                document.querySelectorAll('.order-item').forEach(item => {
                    const productSelect = item.querySelector('.product-select');
                    const quantityInput = item.querySelector('.quantity-input');
                    const subtotalInput = item.querySelector('.item-subtotal');

                    if (productSelect && productSelect.value) {
                        const selectedOption = productSelect.options[productSelect.selectedIndex];
                        const price = parseFloat(selectedOption.dataset.price);
                        const quantity = parseInt(quantityInput.value) || 0;
                        const subtotal = price * quantity;

                        subtotalInput.value = '$' + subtotal.toFixed(2);
                        totalAmount += subtotal;
                        totalItems += quantity;
                    }
                });

                document.getElementById('totalItems').textContent = totalItems;
                document.getElementById('totalAmount').textContent = '$' + totalAmount.toFixed(2);
                document.getElementById('totalPriceInput').value = totalAmount.toFixed(2);
            }
        });
    </script>

    <script>
        function confirmDelete() {
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }
    </script>

</body>


<!-- Mirrored from codervent.com/matoxi/demo/vertical-menu/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 08 Sep 2024 08:59:56 GMT -->

</html>
