<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title')</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ asset('assets/img/logo.png') }}">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/modules/moment.min.js') }}"></script>
    <script src="{{ asset('assets/modules/cleave-js/dist/cleave.min.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/highcharts.js') }}"></script>
    <style>
        .fas, .far, .fab, .fal {
            font-size: 20px;
        }

        .form-group label {
            font-weight: bold;
        }
    </style>
    </head>

<body style="background-color: #f3f3f3;">
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
            <form class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                </ul>
            </form>
            <ul class="navbar-nav navbar-right">

                <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
                        <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->full_name }}</div></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-title">Logged in as <strong>{{ Auth::user()->username }}</strong></div>
                        <a href="features-profile.html" class="dropdown-item has-icon">
                            <i class="far fa-user"></i> PROFIL SAYA
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="dropdown-item has-icon text-danger">
                            <i class="fas fa-sign-out-alt"></i> KELUAR
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <div class="main-sidebar sidebar-style-2">
            <aside id="sidebar-wrapper">
                <div class="sidebar-brand">
                    <a href="index.html"><i class="fas fa-gem" style="font-size: 18px"></i> <span style="font-size: 17px;"> UANGKU </span><span style="font-size: 10px;">BETA</span></a>
                </div>
                <div class="sidebar-brand sidebar-brand-sm">
                    <a href="index.html"><i class="fa fa-gem"></i></a>
                </div>
                <ul class="sidebar-menu">
                    <li class="menu-header">MAIN MENU</li>
                    <li class="{{ setActive('account/dashboard') }}"><a class="nav-link" href="{{ route('account.dashboard.index') }}"><i class="fas fa-home"></i> <span>DASHBOARD</span></a></li>
                    <li class="dropdown {{ setActive('account/categories_debit'). setActive('account/debit') }}">
                        <a href="#" class="nav-link has-dropdown"><i class="fas fa-wallet"></i><span>UANG MASUK</span></a>
                        <ul class="dropdown-menu">
                            <li class="{{ setActive('account/categories_debit') }}"><a class="nav-link" href="{{ route('account.categories_debit.index') }}"><i class="fas fa-dice-d6"></i> KATEGORI</a></li>
                            <li class="{{ setActive('account/debit') }}"><a class="nav-link" href="{{ route('account.debit.index') }}"><i class="fas fa-money-check-alt"></i> UANG MASUK</a></li>
                        </ul>
                    </li>
                    <li class="dropdown {{ setActive('account/categories_credit'). setActive('account/credit') }}">
                        <a href="#" class="nav-link has-dropdown"><i class="fas fa-wallet"></i><span>UANG KELUAR</span></a>
                        <ul class="dropdown-menu">
                            <li class="{{ setActive('account/categories_credit') }}"><a class="nav-link" href="{{ route('account.categories_credit.index') }}"><i class="fas fa-dice-d6"></i> KATEGORI</a></li>
                            <li class="{{ setActive('account/credit') }}"><a class="nav-link" href="{{ route('account.credit.index') }}"><i class="fas fa-money-check-alt"></i> UANG KELUAR</a></li>
                        </ul>
                    </li>

                    <li class="dropdown {{ setActive('account/laporan_debit'). setActive('account/laporan_credit') }}">
                        <a href="#" class="nav-link has-dropdown"><i class="fas fa-chart-pie"></i><span>LAPORAN</span></a>
                        <ul class="dropdown-menu">
                            <li class="{{ setActive('account/laporan_debit') }}"><a class="nav-link" href="{{ route('account.laporan_debit.index') }}"><i class="fas fa-chart-line"></i> UANG MASUK</a></li>
                            <li class="{{ setActive('account/laporan_credit') }}"><a class="nav-link" href="{{ route('account.laporan_credit.index') }}"><i class="fas fa-chart-area"></i> UANG KELUAR</a></li>
                            <li><a class="nav-link" href="index-0.html"><i class="fas fa-chart-pie"></i> SEMUA</a></li>
                        </ul>
                    </li>
                </ul>

                <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                    <a href="" class="btn btn-primary btn-lg btn-block btn-icon-split">
                        <i class="fab fa-github"></i> GITHUB
                    </a>
                </div>        </aside>
        </div>

        <!-- Main Content -->
        @yield('content')



        <footer class="main-footer" style="border-top: 3px solid #6777ef;background-color: #ffffff;margin-bottom: -20px">
            <div class="footer-left">
                © <strong>UANGKU</strong> 2019. Hak Cipta Dilindungi.
            </div>
            <div class="footer-right">

            </div>
        </footer>
    </div>
</div>

<!-- General JS Scripts -->
<script src="{{ asset('assets/modules/popper.js') }}"></script>
<script src="{{ asset('assets/modules/tooltip.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>
<script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>

<!-- JS Libraies -->

<!-- Page Specific JS File -->

<!-- Template JS File -->
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
</body>
</html>
