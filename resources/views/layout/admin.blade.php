<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{asset('home/img/logo/logo.png')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('admin/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{asset('admin/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('admin/css/icheck-bootstrap.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset('admin/css/jqvmap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admin/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('admin/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('admin/css/daterangepicker.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('admin/css/summernote-bs4.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
<body class="hold-transition sidebar-mini layout-fixed" style="font-family: Roboto, Helvetica, Arial, sans-serif">

<?php
$user = Auth::user();
$id_user = $user->id ?? null;
?>
@if(Auth::check())
    @if($user->is_admin)
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                class="fas fa-bars"></i></a>
                    </li>

                </ul>

                <!-- Right navbar links -->
                <div class="dropdown ml-auto">
                    <button class="btn" style="background: #103D8F" type="button" data-toggle="dropdown">
                        <i class="fas fa-user" style="color:white"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{url('logout')}}">Logout <i style="margin-left: 50%;"
                                                                                    class="fas fa-sign-out-alt"></i></a>
                    </div>
                </div>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="/admin/home" class="brand-link">
                    <img src="{{asset('home/img/logo/logo.png')}}" alt="AdminLTE Logo"
                         class="brand-image img-circle elevation-3"
                         style="opacity: .8;border-radius: 100%">
                    <span class="brand-text font-weight-light">Admin</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <li class="nav-item has-treeview">
                                <a href="/admin/home" class="nav-link">
                                    <i class="nav-icon fas fa-user-tie"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="/admin/history" class="nav-link">
                                    <i class="nav-icon fas fa-history"></i>
                                    <p>
                                        Lịch sử
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <section class="content">
                    @yield('content-admin')
                </section>
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <strong>Get OTP now</strong>
                <div class="float-right d-none d-sm-inline-block">
                    <b>
                    </b>
                </div>
            </footer>

        </div>
    @else
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <div class="dropdown ml-auto">
                <button class="btn" style="background: #103D8F" type="button" data-toggle="dropdown">
                    <i class="fas fa-user" style="color:white"></i>
                </button>
                <div class="dropdown-menu">
{{--                    <a class="dropdown-item" href="/password">Change Password</a>--}}
                    <a class="dropdown-item" href="{{url('logout')}}">Logout <i style="margin-left: 50%;"
                                                                                class="fas fa-sign-out-alt"></i></a>
                </div>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/admin/home" class="brand-link">
                <img src="{{asset('home/img/logo/logo.png')}}" alt="AdminLTE Logo"
                     class="brand-image img-circle elevation-3"
                     style="opacity: .8;border-radius: 100%">
                <span class="brand-text font-weight-light"><?php echo 'SOS OTP' ?></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item has-treeview">
                            <a href="/dashboard" class="nav-link">
                                <i class="nav-icon fas fa-user-tie"></i>
                                <p>Tổng quan</p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="/thueotp" class="nav-link">
                                <i class="nav-icon fas fa-history"></i>
                                <p>
                                    Thuê OTP
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="/document" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Tài liệu API
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="/transactions" class="nav-link">
                                <i class="nav-icon fas fa-history"></i>
                                <p>
                                    Lịch sử giao dịch
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="/naptien" class="nav-link">
                                <i class="nav-icon fas fa-dollar-sign"></i>
                                <p>
                                    Nạp tiền
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content">
                @yield('content-admin')
            </section>
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Get OTP now</strong>
            <div class="float-right d-none d-sm-inline-block">
                <b>
                </b>
            </div>
        </footer>

    </div>
    @endif
@endif

<!-- ./wrapper -->

<!-- jQuery -->

<script src="{{asset('admin/js/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('admin/js/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    text = $('#usngv').val();
    regex = /^[a-zA-Z]+$/; // Chỉ chấp nhận ký tự alphabet thường hoặc ký tự hoa
    if (regex.test(text)) { // true nếu text chỉ chứa ký tự alphabet thường hoặc hoa, false trong trường hợp còn lại.
    } else {
    }
</script>

<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
{{-- Quay lại --}}
<script>
    function quay_lai() {
        history.back();
    }
</script>

<!-- Bootstrap 4 -->
<script src="{{asset('admin/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('admin/js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('admin/js/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('admin/js/jquery.vmap.min.js')}}"></script>
<script src="{{asset('admin/js/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('admin/js/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('admin/js/moment.min.js')}}"></script>
<script src="{{asset('admin/js/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('admin/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('admin/js/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('admin/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('admin/js/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('admin/js/demo.js')}}"></script>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

</body>
</html>
