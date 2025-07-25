<aside class="sidebar-wrapper">
    <div class="sidebar-header">
        <div class="logo-icon">
            <img src="{{ asset('adminFront/assets/images/logo-icon.png') }}   " class="logo-img" alt="">
        </div>
        <div class="logo-name flex-grow-1">
            <h5 class="mb-0">Metoxi</h5>
        </div>
        <div class="sidebar-close">
            <span class="material-icons-outlined">close</span>
        </div>
    </div>
    <div class="sidebar-nav" data-simplebar="true">

        <!--navigation-->
        <ul class="metismenu" id="sidenav">
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="material-icons-outlined">home</i>
                    </div>
                    <div class="menu-title">Dashboard</div>
                </a>
                <ul>
                    <li><a href="index.html"><i class="material-icons-outlined">arrow_right</i>eCommerce</a>
                    </li>
                    <li><a href="index2.html"><i class="material-icons-outlined">arrow_right</i>Alternate</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="material-icons-outlined">widgets</i>
                    </div>
                    <div class="menu-title">Widgets</div>
                </a>
                <ul>
                    <li><a href="widgets-data.html"><i class="material-icons-outlined">arrow_right</i>Data</a>
                    </li>
                    <li><a href="widgets-advance.html"><i class="material-icons-outlined">arrow_right</i>Advance</a>
                    </li>
                </ul>
            </li>
            <li class="menu-label">UI Elements</li>
            

           
            
            <!-- Category Management Section -->
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="material-icons-outlined">category</i>
                    </div>
                    <div class="menu-title">Category</div>
                </a>
                <ul>
                    <li><a href="{{ route('category.create') }}"><i class="material-icons-outlined">arrow_right</i>Create Category</a>
                    </li>
                    <li><a href="{{ route('category.list') }}"><i class="material-icons-outlined">arrow_right</i>Show All Categories</a>
                    </li>
                </ul>
            </li>
            
            <!-- Product Management Section -->
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="material-icons-outlined">inventory_2</i>
                    </div>
                    <div class="menu-title">Product</div>
                </a>
                <ul>
                    <li><a href="{{ route('product.create') }}"><i class="material-icons-outlined">arrow_right</i>Create Product</a>
                    </li>
                    <li><a href="{{ route('product.list') }}"><i class="material-icons-outlined">arrow_right</i>Show All Products</a>
                    </li>
                </ul>
            </li>
            
            <li class="menu-label">Forms & Tables</li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="material-icons-outlined">toc</i>
                    </div>
                    <div class="menu-title">Forms</div>
                </a>
                <ul>
                    <li><a href="form-elements.html"><i class="material-icons-outlined">arrow_right</i>Form Elements</a>
                    </li>
                    <li><a href="form-input-group.html"><i class="material-icons-outlined">arrow_right</i>Input Groups</a>
                    </li>
                    <li><a href="form-radios-and-checkboxes.html"><i class="material-icons-outlined">arrow_right</i>Radios &
                            Checkboxes</a>
                    </li>
                    <li><a href="form-layouts.html"><i class="material-icons-outlined">arrow_right</i>Forms Layouts</a>
                    </li>
                    <li><a href="form-validations.html"><i class="material-icons-outlined">arrow_right</i>Form Validation</a>
                    </li>
                    <li><a href="form-wizard.html"><i class="material-icons-outlined">arrow_right</i>Form Wizard</a>
                    </li>
                    <li><a href="form-file-upload.html"><i class="material-icons-outlined">arrow_right</i>File Upload</a>
                    </li>
                    <li><a href="form-date-time-pickes.html"><i class="material-icons-outlined">arrow_right</i>Date
                            Pickers</a>
                    </li>
                    <li><a href="form-select2.html"><i class="material-icons-outlined">arrow_right</i>Select2</a>
                    </li>
                    <li><a href="form-repeater.html"><i class="material-icons-outlined">arrow_right</i>Form Repeater</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="material-icons-outlined">api</i>
                    </div>
                    <div class="menu-title">Tables</div>
                </a>
                <ul>
                    <li><a href="table-basic-table.html"><i class="material-icons-outlined">arrow_right</i>Basic Table</a>
                    </li>
                    <li><a href="table-datatable.html"><i class="material-icons-outlined">arrow_right</i>Data Table</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="material-icons-outlined">apps</i>
                    </div>
                    <div class="menu-title">Apps</div>
                </a>
                <ul>
                    <li><a href="app-fullcalender.html"><i class="material-icons-outlined">arrow_right</i>Calendar</a>
                    </li>
                    <li><a href="app-to-do.html"><i class="material-icons-outlined">arrow_right</i>To do</a>
                    </li>
                    <li><a href="app-invoice.html"><i class="material-icons-outlined">arrow_right</i>Invoice</a>
                    </li>
                </ul>
            </li>
            <li class="menu-label">Pages</li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="material-icons-outlined">lock</i>
                    </div>
                    <div class="menu-title">Authentication</div>
                </a>
                <ul>
                    <li><a class="has-arrow" href="javascript:;"><i class="material-icons-outlined">arrow_right</i>Basic</a>
                        <ul>
                            <li><a href="auth-basic-login.html" target="_blank"><i class="material-icons-outlined">arrow_right</i>Login</a></li>
                            <li><a href="auth-basic-register.html" target="_blank"><i class="material-icons-outlined">arrow_right</i>Register</a></li>
                            <li><a href="auth-basic-forgot-password.html" target="_blank"><i class="material-icons-outlined">arrow_right</i>Forgot Password</a></li>
                            <li><a href="auth-basic-reset-password.html" target="_blank"><i class="material-icons-outlined">arrow_right</i>Reset Password</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:;"><i class="material-icons-outlined">arrow_right</i>Cover</a>
                        <ul>
                            <li><a href="auth-cover-login.html" target="_blank"><i class="material-icons-outlined">arrow_right</i>Login</a></li>
                            <li><a href="auth-cover-register.html" target="_blank"><i class="material-icons-outlined">arrow_right</i>Register</a></li>
                            <li><a href="auth-cover-forgot-password.html" target="_blank"><i class="material-icons-outlined">arrow_right</i>Forgot Password</a></li>
                            <li><a href="auth-cover-reset-password.html" target="_blank"><i class="material-icons-outlined">arrow_right</i>Reset Password</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:;"><i class="material-icons-outlined">arrow_right</i>Boxed</a>
                        <ul>
                            <li><a href="auth-boxed-login.html" target="_blank"><i class="material-icons-outlined">arrow_right</i>Login</a></li>
                            <li><a href="auth-boxed-register.html" target="_blank"><i class="material-icons-outlined">arrow_right</i>Register</a></li>
                            <li><a href="auth-boxed-forgot-password.html" target="_blank"><i class="material-icons-outlined">arrow_right</i>Forgot Password</a></li>
                            <li><a href="auth-boxed-reset-password.html" target="_blank"><i class="material-icons-outlined">arrow_right</i>Reset Password</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="user-profile.html">
                    <div class="parent-icon"><i class="material-icons-outlined">person</i>
                    </div>
                    <div class="menu-title">User Profile</div>
                </a>
            </li>
            <li>
                <a href="timeline.html">
                    <div class="parent-icon"><i class="material-icons-outlined">join_right</i>
                    </div>
                    <div class="menu-title">Timeline</div>
                </a>
            </li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="material-icons-outlined">report_problem</i>
                    </div>
                    <div class="menu-title">Pages</div>
                </a>
                <ul>
                    <li><a href="pages-error-404.html" target="_blank"><i class="material-icons-outlined">arrow_right</i>404
                            Error</a>
                    </li>
                    <li><a href="pages-error-505.html" target="_blank"><i class="material-icons-outlined">arrow_right</i>505
                            Error</a>
                    </li>
                    <li><a href="pages-coming-soon.html" target="_blank"><i
                                class="material-icons-outlined">arrow_right</i>Coming Soon</a>
                    </li>
                    <li><a href="pages-starter-page.html" target="_blank"><i
                                class="material-icons-outlined">arrow_right</i>Blank Page</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="faq.html">
                    <div class="parent-icon"><i class="material-icons-outlined">help_outline</i>
                    </div>
                    <div class="menu-title">FAQ</div>
                </a>
            </li>
            <li>
                <a href="pricing-table.html">
                    <div class="parent-icon"><i class="material-icons-outlined">sports_football</i>
                    </div>
                    <div class="menu-title">Pricing</div>
                </a>
            </li>
            <li class="menu-label">Charts & Maps</li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="material-icons-outlined">fitbit</i>
                    </div>
                    <div class="menu-title">Charts</div>
                </a>
                <ul>
                    <li><a href="charts-apex-chart.html"><i class="material-icons-outlined">arrow_right</i>Apex</a>
                    </li>
                    <li><a href="charts-chartjs.html"><i class="material-icons-outlined">arrow_right</i>Chartjs</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="material-icons-outlined">sports_football</i>
                    </div>
                    <div class="menu-title">Maps</div>
                </a>
                <ul>
                    <li><a href="map-google-maps.html"><i class="material-icons-outlined">arrow_right</i>Google Maps</a>
                    </li>
                    <li><a href="map-vector-maps.html"><i class="material-icons-outlined">arrow_right</i>Vector Maps</a>
                    </li>
                </ul>
            </li>
            <li class="menu-label">Others</li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="material-icons-outlined">face_5</i>
                    </div>
                    <div class="menu-title">Menu Levels</div>
                </a>
                <ul>
                    <li><a class="has-arrow" href="javascript:;"><i class="material-icons-outlined">arrow_right</i>Level
                            One</a>
                        <ul>
                            <li><a class="has-arrow" href="javascript:;"><i class="material-icons-outlined">arrow_right</i>Level
                                    Two</a>
                                <ul>
                                    <li><a href="javascript:;"><i class="material-icons-outlined">arrow_right</i>Level Three</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascrpt:;">
                    <div class="parent-icon"><i class="material-icons-outlined">description</i>
                    </div>
                    <div class="menu-title">Documentation</div>
                </a>
            </li>
            <li>
                <a href="javascrpt:;">
                    <div class="parent-icon"><i class="material-icons-outlined">support</i>
                    </div>
                    <div class="menu-title">Support</div>
                </a>
            </li>
        </ul>
        <!--end navigation-->
    </div>
    <div class="sidebar-bottom gap-4">
        <div class="dark-mode">
            <a href="javascript:;" class="footer-icon dark-mode-icon">
                <i class="material-icons-outlined">dark_mode</i>
            </a>
        </div>
        <div class="dropdown dropup-center dropup dropdown-laungauge">
            <a class="dropdown-toggle dropdown-toggle-nocaret footer-icon" href="avascript:;" data-bs-toggle="dropdown"><img src="{{ asset('adminFront/assets/images/county/02.png') }}  " width="22" alt="">
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="{{ asset('adminFront/assets/images/county/01.png') }}  " width="20" alt=""><span class="ms-2">English</span></a>
                </li>
                <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="{{ asset('adminFront/assets/images/county/02.png') }}  " width="20" alt=""><span class="ms-2">Catalan</span></a>
                </li>
                <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="{{ asset('adminFront/assets/images/county/03.png') }}  " width="20" alt=""><span class="ms-2">French</span></a>
                </li>
                <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="{{ asset('adminFront/assets/images/county/04.png') }}  " width="20" alt=""><span class="ms-2">Belize</span></a>
                </li>
                <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="{{ asset('adminFront/assets/images/county/05.png') }}  " width="20" alt=""><span class="ms-2">Colombia</span></a>
                </li>
                <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="{{ asset('adminFront/assets/images/county/06.png') }}  " width="20" alt=""><span class="ms-2">Spanish</span></a>
                </li>
                <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="{{ asset('adminFront/assets/images/county/07.png') }}  " width="20" alt=""><span class="ms-2">Georgian</span></a>
                </li>
                <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="{{ asset('adminFront/assets/images/county/08.png') }}     " width="20" alt=""><span class="ms-2">Hindi</span></a>
                </li>
            </ul>
        </div>
        <div class="dropdown dropup-center dropup dropdown-help">
            <a class="footer-icon  dropdown-toggle dropdown-toggle-nocaret option" href="javascript:;"
                data-bs-toggle="dropdown" aria-expanded="false">
                <span class="material-icons-outlined">
                    info
                </span>
            </a>
            <div class="dropdown-menu dropdown-option dropdown-menu-end shadow">
                <div><a class="dropdown-item d-flex align-items-center gap-2 py-2" href="javascript:;"><i
                            class="material-icons-outlined fs-6">inventory_2</i>Archive All</a></div>
                <div><a class="dropdown-item d-flex align-items-center gap-2 py-2" href="javascript:;"><i
                            class="material-icons-outlined fs-6">done_all</i>Mark all as read</a></div>
                <div><a class="dropdown-item d-flex align-items-center gap-2 py-2" href="javascript:;"><i
                            class="material-icons-outlined fs-6">mic_off</i>Disable Notifications</a></div>
                <div><a class="dropdown-item d-flex align-items-center gap-2 py-2" href="javascript:;"><i
                            class="material-icons-outlined fs-6">grade</i>What's new ?</a></div>
                <div>
                    <hr class="dropdown-divider">
                </div>
                <div><a class="dropdown-item d-flex align-items-center gap-2 py-2" href="javascript:;"><i
                            class="material-icons-outlined fs-6">leaderboard</i>Reports</a></div>
            </div>
        </div>

    </div>
</aside>
