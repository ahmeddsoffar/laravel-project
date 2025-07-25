<!doctype html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Metoxi | Products List</title>
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
        <div class="main-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Product Management</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('adminView') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Products List</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header px-4 py-3 d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">All Products</h5>
                            <a href="{{ route('product.create') }}" class="btn btn-primary">
                                <i class="material-icons-outlined me-2">add</i>Add Product
                            </a>
                        </div>
                        <div class="card-body p-4">
                            @if(session('success'))
                            <div class="alert alert-success border-0 bg-light-success alert-dismissible fade show">
                                <div class="text-success">{{ session('success') }}</div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            @if(count($products) > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Price ($)</th>
                                            <th>Quantity</th>
                                            <th>Image</th>
                                            <th>Discount</th>
                                            <th>Category</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ number_format($product->price, 2) }}</td>
                                            <td>{{ $product->quantity }}</td>
                                            <td>
                                                @if($product->image)
                                                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image"
                                                    width="60">
                                                @else
                                                N/A
                                                @endif
                                            </td>
                                            <td>
                                                @if($product->discount)
                                                {{ $product->discount }}%
                                                @else
                                                0%
                                                @endif
                                            </td>
                                            <td>{{ $product->category ? $product->category->name : 'N/A' }}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="material-icons-outlined">edit</i>
                                                    </a>
                                                    <form action="{{ route('product.delete', $product->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this product?')">
                                                            <i class="material-icons-outlined">delete</i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <div class="text-center py-5">
                                <div class="mb-4">
                                    <i class="material-icons-outlined"
                                        style="font-size: 4rem; color: #6c757d;">inventory_2</i>
                                </div>
                                <h5 class="text-muted mb-3">No products found</h5>
                                <p class="text-muted mb-4">You haven't added any products yet. Create your first product to
                                    get started.</p>
                                <a href="{{ route('product.create') }}" class="btn btn-primary">
                                    <i class="material-icons-outlined me-2">add</i>Add First Product
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--end main wrapper-->
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
    @include('adminViews.layouts.switcher')
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
</body>

</html>
