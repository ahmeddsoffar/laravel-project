<!doctype html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Metoxi | Edit Category</title>
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
                <div class="breadcrumb-title pe-3">Category Management</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('adminView') }}"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('category.list') }}">Categories</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="row">
                <div class="col-12 col-lg-8 col-xl-6">
                    <div class="card">
                        <div class="card-header px-4 py-3">
                            <h5 class="mb-0">Edit Category</h5>
                        </div>
                        <div class="card-body p-4">
                            
                            @if(session('success'))
                                <div class="alert alert-success border-0 bg-light-success alert-dismissible fade show">
                                    <div class="text-success">{{ session('success') }}</div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('category.update', $category->id) }}">
                                @csrf
                                @method('PUT')
                                
                                <div class="row mb-3">
                                    <label for="category_name" class="col-sm-3 col-form-label">Category Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="category_name" name="name" value="{{ old('name', $category->name) }}" placeholder="Enter category name" required>
                                        @error('name')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <div class="d-md-flex d-grid align-items-center gap-3">
                                            <button type="submit" class="btn btn-primary px-4">Update Category</button>
                                            <a href="{{ route('category.list') }}" class="btn btn-outline-secondary px-4">Cancel</a>
                                        </div>
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