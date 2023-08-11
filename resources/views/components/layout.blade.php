<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title') - Fouaille Manager</title>

    <!-- Custom fonts for this template-->
    <link href={{asset('vendor/fontawesome-free/css/all.min.css')}} rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href={{asset('css/sb-admin-2.min.css')}} rel="stylesheet">

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home')}}">
            <div class="sidebar-brand-icon">
                <i class="fas fa-box-open"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Fouaille Manager</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Nav Item - Fouaille -->
        <li class="nav-item {{ request()->is('fouaille*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('fouaille.index') }}">
                <i class="fas fa-fw fa-beer"></i>
                <span>Fouaille</span></a>
        </li>

        <!-- Nav Item - Marco -->
        <li class="nav-item {{ request()->is('marco*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('marco.index') }}">
                <i class="fas fa-fw fa-desktop"></i>
                <span>Marco</span></a>
        </li>

        <!-- Nav Item - Asso/Club -->
        <li class="nav-item {{ request()->is('asso*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('asso.index') }}">
                <i class="fas fa-fw fa-smile"></i>
                <span>Asso/Club</span></a>
        </li>

        <!-- Nav Item - Membre -->
        <li class="nav-item {{ request()->is('member*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('member.index') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>Membre</span></a>
        </li>


        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">


                    @if(cas()->isAuthenticated())
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ session()->get('cas_user') }}</span>
                                <i class="fas fa-user-circle fa-sm fa-fw mr-2 text-gray-400"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                 aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Déconnexion
                                </a>
                            </div>
                        </li>
                    @else
                        <!--- Nav Item - Login -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Login</span>
                                <i class="fas fa-sign-in-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            </a>
                        </li>
                    @endif
                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                {{ $slot }}
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Fouaille Manager 2023</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src={{asset('vendor/jquery/jquery.min.js')}}></script>
<script src={{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}></script>

<!-- Core plugin JavaScript-->
<script src={{asset("vendor/jquery-easing/jquery.easing.min.js")}}></script>

<!-- Custom scripts for all pages-->
<script src={{asset("js/sb-admin-2.min.js")}}></script>

<!-- Page level plugins -->
<script src={{asset("vendor/chart.js/Chart.min.js")}}></script>

<!-- Page level custom scripts -->
<script src={{asset("js/demo/chart-area-demo.js")}}></script>
<script src={{asset("js/demo/chart-pie-demo.js")}}></script>

</body>

</html>
